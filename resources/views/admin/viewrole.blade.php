@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-6">User Management</h1>

        <!-- 🔍 Search + Role Filter -->
        <form method="GET" class="mb-6 flex flex-col md:flex-row md:items-center gap-4">

            <!-- Search Input -->
            <div class="w-full md:w-1/2">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name or email..."
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Role Dropdown -->
            <div class="w-full md:w-1/4">
                <label for="roleSelect" class="block text-sm font-medium text-gray-700 mb-1">Filter by Role</label>
                <select id="roleSelect" name="role"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Roles</option>
                    <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="receptionist" {{ request('role') == 'receptionist' ? 'selected' : '' }}>Receptionist
                    </option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="w-full md:w-auto pt-2 md:pt-6">
                <button type="submit"
                    class="w-full bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition duration-150 ease-in-out">
                    Filter
                </button>
            </div>

        </form>

        <!-- 📋 User Table -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800" id="userTable">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-700">
                        <th class="px-6 py-4 font-semibold">Image</th>
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Phone</th>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default/default-user.jpg') }}"
                                    alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($user->role) }}</td>

                            <td class="px-6 py-4 text-center space-x-2">
                                <label for="view1" class="text-blue-600 hover:underline cursor-pointer">View</label>
                                <label for="edit1" class="text-yellow-600 hover:underline cursor-pointer">Edit</label>
                                <button class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>


                    @endforeach




                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔍 JS for Live Search -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#userTable tbody tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>

    <!-- 🔳 View Modal - Aman -->
    <div>
        <input type="checkbox" id="view1" class="hidden peer/view1" />
        <div
            class="fixed inset-0 bg-black bg-opacity-40 hidden peer-checked/view1:flex items-center justify-center z-50 p-4">
            <div class="bg-white p-6 rounded-lg w-full max-w-md relative">
                <h2 class="text-lg font-semibold mb-4">View User - Aman Kumar</h2>
                <div class="space-y-2">
                    <p><strong>Name:</strong> Aman Kumar</p>
                    <p><strong>Email:</strong> aman@example.com</p>
                    <p><strong>Role:</strong> Admin</p>
                </div>
                <label for="view1" class="absolute top-2 right-3 text-gray-600 cursor-pointer text-2xl">&times;</label>
            </div>
        </div>
    </div>

    <!-- 🛠️ Edit Modal - Aman -->
    <div>
        <input type="checkbox" id="edit1" class="hidden peer/edit1" />
        <div
            class="fixed inset-0 bg-black bg-opacity-40 hidden peer-checked/edit1:flex items-center justify-center z-50 p-4">
            <div class="bg-white p-6 rounded-lg w-full max-w-md relative">
                <h2 class="text-lg font-semibold mb-4">Edit User - {{ $user->name }}</h2>
                <form class="space-y-3" action="{{ route('admin.updateRole', $user->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="photo" class="w-full border px-3 py-2 "/>
                    @if ($user->photo)
                        <div class="mt-3">

                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Current Image" width="100"
                                class="w-full h-50 border px-3 py-2 rounded">
                        </div>
                    @endif

                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />

                    <input type="email" name="email" value="{{ $user->email }}"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />

                    <input type="number" name="phone" value="{{ $user->phone }}"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />

                    <select name="role"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doctor" {{ $user->role === 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="receptionist" {{ $user->role === 'receptionist' ? 'selected' : '' }}>Receptionist
                        </option>
                    </select>

                    <div class="text-right">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-700">Save</button>
                    </div>
                </form>

                <!-- ❌ Close Modal -->
                <label for="edit{{ $user->id }}"
                    class="absolute top-2 right-3 text-gray-600 cursor-pointer text-2xl">&times;
                </label>


            </div>
        </div>
    </div>

    <!-- 📌 Tip: Copy this structure for view2/edit2 and view3/edit3 -->

@endsection