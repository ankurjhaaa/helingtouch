<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'password' => 'required|string|min:6',
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

}
