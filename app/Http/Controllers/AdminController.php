<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Leave;
use App\Models\Seeting;
use App\Models\Staff;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class AdminController extends Controller
{
    public function showform()
    {
        return view('admin.addrole');
    }
    public function adminprofile()
    {
        return view('admin.adminprofile');
    }
    public function adddepartment()
    {
        $departments = Department::latest()->paginate(10); // latest first + pagination
        return view('admin.adddepartment', compact('departments'));
    }
    public function storedepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:1,0',  // validation

        ]);
        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.department')->with('masg', 'Department added successfully');
    }
    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully!');
    }
    public function editDepartment($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.editdepartment', compact('department'));
    }
    // Update Department Logic
    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->description = $request->description;
        $department->status = $request->status == 'active' ? 1 : 0;

        $department->save();

        return redirect()->route('admin.department')->with('success', 'Department updated successfully!');
    }
    public function viewrole(Request $request)
    {

        $role = $request->get('role');
        $search = $request->get('search');

        $users = User::query()
            ->when($role && in_array($role, ['doctor', 'receptionist']), function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('admin.viewrole', compact('users'));
    }

    public function submitform(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role' => 'required|in:admin,doctor,receptionist',
            'phone' => 'required|digits_between:10,15',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imagePath = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imagePath = $image->store('dp', 'public');
        }

        // Create User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'phone' => $request->phone,
            'photo' => $imagePath,

        ]);
        return redirect()->route('admin.viewrole')->with('success', 'User registered successfully!');

    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|numeric',
            'role' => 'required|in:admin,doctor,receptionist',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        //photo logic
        if ($request->hasFile('photo')) {
            //old image delete
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            //save new photo
            $photoPath = $request->file('photo')->store('dp', 'public');
            $user->photo = $photoPath;
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = strtolower($request->role);
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully!');

    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        //delete the user 
        // 🧹 Delete photo from storage
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');

    }
    public function adminDashboard()
    {
        $doctorCount = Doctor::count();
        $countReceptionst = User::where('role', 'receptionist')->count();
        $totalUsers = User::whereIn('role', ['admin', 'doctor', 'receptionist'])->count();
        $countApointments = Appointment::whereDate('created_at', Carbon::today())->count();
        $totalDepartments = Department::count();
        $appointments = Appointment::with('doctor.user')->latest()->take(20)->get();

        return view('admin.adminDashboard', compact('doctorCount', 'countReceptionst', 'totalUsers', 'countApointments', 'totalDepartments', 'appointments'));
    }
    //doctor manage logic 
    public function manageDoctor()
    {
        $doctors = Doctor::with(['user', 'department'])->latest()->paginate(10); // latest first + pagination
        $departments = Department::whereDoesntHave('doctors')->get();

        $users = User::where('role', 'doctor') // sirf doctor role wale
            ->whereDoesntHave('doctor') // jo abhi doctor table me assign nahi hue
            ->get();

        return view('admin.managedoctors', compact('users', 'departments', 'doctors'));
    }

    public function storeDoctor(Request $request, )
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'bio' => 'required|string',
            'status' => 'required|boolean',
            // Days can be optionally checked
            'sunday' => 'nullable|in:1',
            'monday' => 'nullable|in:1',
            'tuesday' => 'nullable|in:1',
            'wednesday' => 'nullable|in:1',
            'thursday' => 'nullable|in:1',
            'friday' => 'nullable|in:1',
            'saturday' => 'nullable|in:1',
            'fee' => 'required|numeric|min:100',
            'specialist' => 'nullable|string|max:255',

        ]);

        // Custom check: At least one day should be selected
        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $selected = collect($days)->filter(fn($day) => $request->has($day));
        if ($selected->isEmpty()) {
            return back()->withErrors(['days' => 'At least one working day must be selected'])->withInput();
        }

        // Add day values to data
        $data = $request->only(['user_id', 'department_id', 'qualification', 'experience', 'bio', 'status', 'fee', 'specialist']);
        foreach ($days as $day) {
            $data[$day] = $request->has($day) ? 1 : 0;
        }
        Doctor::create($data);

        return redirect()->back()->with('success', 'Doctor added successfully!');

    }
    public function deleteDoctor(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->back()->with('success', 'Doctor deleted successfully!');
    }
    public function edit(Doctor $doctor)
    {
        $users = User::where('role', 'doctor')->get();
        $departments = Department::all();
        return view('admin.editdoctors', compact('doctor', 'users', 'departments'));

    }
    public function updateDoctor(Request $request, Doctor $doctor)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',

            'qualification' => 'required|string',
            'experience' => 'required|string',
            'bio' => 'nullable|string',
            'status' => 'required|boolean',
            'fee' => 'required|numeric|min:100',
            'specialist' => 'nullable|string|max:255', // Add validation for specialization
        ]);

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        $data = $request->only(['user_id', 'department_id', 'specialization', 'qualification', 'experience', 'bio', 'status', 'fee', 'specialist']);

        foreach ($days as $day) {
            $data[$day] = $request->has($day);
        }

        $doctor->update($data);
        return redirect()->route('admin.manageDoctor')->with('success', 'Doctor updated successfully!');
    }

    public function gallery()
    {
        $galleryItems = Gallery::latest()->get();
        return view('admin.gallery', compact('galleryItems'));
    }

    public function storeGallery(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:image,video',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:63775', // max:51200 = 50MB
        ]);

        $file = $request->file('file')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'type' => $request->type,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'Gallery item added successfully!');
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        // Delete the file from storage
        if (Storage::disk('public')->exists($gallery->file)) {
            Storage::disk('public')->delete($gallery->file);
        }

        // Delete the gallery item from the database
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery item deleted successfully!');
    }
    public function editGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.edit-gallery', compact('gallery'));
    }
    public function updateGallery(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:image,video',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:51200', // 50MB
        ]);
        $gallery = Gallery::findOrFail($id);
        $gallery->title = $request->title;
        $gallery->type = $request->type;
        // If a new file is uploaded, store it and update the file path
        if ($request->hasFile('file')) {
            if ($gallery->file && Storage::disk('public')->exists($gallery->file)) {
                Storage::disk('public')->delete($gallery->file);
            }

            // Store new file
            $filePath = $request->file('file')->store('gallery', 'public');
            $gallery->file = $filePath;

        }
        $gallery->save();
        return redirect()->route('admin.gallery')->with('success', 'Gallery item updated successfully!');



    }
    public function seetings()
    {
        return view('admin.seeting');
    }
    public function saveSeetings(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);
        $seeting = Seeting::first();
        if ($seeting) {
            //if exits
            $seeting->update([
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        } else {
            //if not exits
            Seeting::create([
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }
        return back()->with('success', 'Location saved successfully!');


    }
    public function information(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',

            'visiting_hours' => 'nullable|string',
            'emergency_available' => 'required|boolean',
        ]);
        $information = Information::first();
        if ($information) {
            $information->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'visiting_hours' => $request->visiting_hours,
                'emergency_available' => $request->emergency_available,

            ]);
        } else {
            //if not exits
            Information::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'visiting_hours' => $request->visiting_hours,
                'emergency_available' => $request->emergency_available,

            ]);
        }
        return back()->with('success', 'Information saved successfully!');
    }

    public function viewLeave()
    {
        $leaves = Leave::with('doctor.user')->latest()->get();
        return view('admin.view-leaves', compact('leaves'));
    }

    public function updateLeaveStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);
        $leave->status = $request->status;
        $leave->save();
        return redirect()->back()->with('success', 'Leave status updated successfully!');
    }

    //admin profile work 
    public function viewAdminProfile()
    {
        return view('admin.admin-profile');


    }

    //admin manage appointment work
    public function manageAppointment(Request $request)
    {

        $doctors = Doctor::with('user')->get();

        $appointments = Appointment::query()
            ->when($request->doctor_id, function ($query) use ($request) {
                $query->where('doctor_id', $request->doctor_id);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })
            ->with(['doctor.user'])
            ->latest()
            ->paginate(15);





        return view('admin.manage-appointment', compact('doctors', 'appointments'));
    }
    //update appointment status 
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,pending,confirmed,cancelled',
        ]);
        $appointments = Appointment::findOrFail($id);
        $appointments->status = $request->status;
        $appointments->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public function editAppointments($id)
    {
        $appointments = Appointment::findOrFail($id);
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.editappointments', compact('appointments', 'doctors'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'doctor_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,cancelled,rescheduled'

        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'date' => $request->date,
            'doctor_id' => $request->doctor_id,
            'status' => $request->status
        ]);
        return redirect()->route('admin.manageappointments')->with('success', 'Appointment updated successfully!');
    }

    public function destroyAppointments($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('admin.manageappointments')->with('success', 'Appointment Delete Successfully');
    }
    public function generateRecipt($id)
    {
        $appoinments = Appointment::with('doctor')->findOrFail($id);
        $pdf = Pdf::loadView('admin.appointment-receipt', compact('appoinments'));
        return $pdf->download('Appointment_Receipt_' . $appoinments->id . '.pdf');
    }

    public function staffIndex()
    {
        $staffs = Staff::latest()->paginate(15);
        return view('admin.staff-list', compact('staffs'));
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Only letters and spaces
            ],
            'position' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'in:Male,Female,Other',
            ],
            'phone' => [
                'required',
                'regex:/^[0-9]{10,15}$/',
                'unique:staff,phone', // optional: ensure no duplicate phones
            ],
            'joining_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
        ]);

        Staff::create($request->all());
        return redirect()->back()->with('success', 'Staff added successfully!');


    }

    public function destroyStaff($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->back()->with('success', 'Staff Delete Successfully');

    }

    public function editStaff($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.edit-staff', compact('staff'));
    }
    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/', // Only letters and spaces
            ],
            'position' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'in:Male,Female,Other',
            ],
            'phone' => [
                'required',
                'regex:/^[0-9]{10,15}$/',
                'unique:staff,phone,' . $staff->id, // Ignore current ID
            ],
            'joining_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
        ]);

        $staff->update($request->all());
        return redirect()->route('admin.stafflist')->with('success', 'Staff Update Successfully');
    }


}
