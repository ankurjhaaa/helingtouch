@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-6">User Management</h1>

        <!-- 🔍 Search Input -->
        <div class="mb-4">
            <input id="searchInput" type="text" placeholder="Search by name or email..."
                class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- 📋 User Table -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800" id="userTable">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-700">
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                    <!-- User 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">Aman Kumar</td>
                        <td class="px-6 py-4 whitespace-nowrap">aman@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Admin</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <label for="view1" class="text-blue-600 hover:underline cursor-pointer">View</label>
                            <label for="edit1" class="text-yellow-600 hover:underline cursor-pointer">Edit</label>
                            <button class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>

                    <!-- User 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">Priya Sharma</td>
                        <td class="px-6 py-4 whitespace-nowrap">priya@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Doctor</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <label for="view2" class="text-blue-600 hover:underline cursor-pointer">View</label>
                            <label for="edit2" class="text-yellow-600 hover:underline cursor-pointer">Edit</label>
                            <button class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>

                    <!-- User 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">Ravi Patel</td>
                        <td class="px-6 py-4 whitespace-nowrap">ravi@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Receptionist</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <label for="view3" class="text-blue-600 hover:underline cursor-pointer">View</label>
                            <label for="edit3" class="text-yellow-600 hover:underline cursor-pointer">Edit</label>
                            <button class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>

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
                <h2 class="text-lg font-semibold mb-4">Edit User - Aman Kumar</h2>
                <form class="space-y-3">
                    <input type="text" value="Aman Kumar"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />
                    <input type="email" value="aman@example.com"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />
                    <input type="text" value="Admin"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" />
                    <div class="text-right">
                        <label for="edit1" class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer">Save</label>
                    </div>
                </form>
                <label for="edit1" class="absolute top-2 right-3 text-gray-600 cursor-pointer text-2xl">&times;</label>
            </div>
        </div>
    </div>

    <!-- 📌 Tip: Copy this structure for view2/edit2 and view3/edit3 -->

@endsection