<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Seeting;
use App\Models\User;
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
        return view('admin.adminDashboard');
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


}
