@extends('admin.adminlayout')
@section('title', 'User Management')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                <i class="fas fa-users text-blue-600"></i>
                <span>User Management</span>
            </h1>

            <!-- Search + Role Filter -->
            <form method="GET" class="mb-6 flex flex-col md:flex-row md:items-end gap-4 bg-white p-6 rounded-xl shadow-lg">
                <!-- Search Input -->
                <div class="w-full md:w-1/2">
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200" />
                </div>

                <!-- Role Dropdown -->
                <div class="w-full md:w-1/4">
                    <label for="roleSelect" class="block text-sm font-medium text-gray-700 mb-1">Filter by Role</label>
                    <select id="roleSelect" name="role"
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200">
                        <option value="">All Roles</option>
                        <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="receptionist" {{ request('role') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg">
                        Filter
                    </button>
                </div>
            </form>

            <!-- User Table -->
            <div class="bg-white shadow-xl rounded-xl overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800" id="userTable">
                    <thead class="bg-blue-100 text-blue-900">
                        <tr class="text-left">
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
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default/default-user.jpg') }}"
                                        alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($user->role) }}</td>
                                <td class="px-6 py-4 text-center space-x-3">
                                    <label for="view{{ $user->id }}"
                                        class="text-blue-600 hover:text-blue-800 cursor-pointer font-medium transition-colors duration-200">View</label>
                                    <button type="button"
                                        class="text-yellow-600 hover:text-yellow-700 font-medium cursor-pointer transition-colors duration-200"
                                        onclick="openModal('edit-modal-{{ $user->id }}')">Edit</button>
                                    <form action="{{ route('admin.deleteRole', $user->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div id="edit-modal-{{ $user->id }}"
                                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 transition-opacity duration-300">
                                <div
                                    class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl relative transform transition-all duration-300 scale-95 modal-open:scale-100 border border-gray-100">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-5 border-b pb-2">Edit <span
                                            class="text-blue-600">{{ $user->name }}</span></h2>
                                    <form class="space-y-4 text-sm" action="{{ route('admin.updateRole', $user->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="photo-{{ $user->id }}"
                                                class="block mb-1 font-medium text-gray-700">Profile Image</label>
                                            <input type="file" name="photo" id="photo-{{ $user->id }}" accept="image/*"
                                                class="w-full file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500"
                                                onchange="previewImage(event, 'preview-{{ $user->id }}')" />
                                        </div>
                                        <div class="mt-2">
                                            @if ($user->photo)
                                                <img id="preview-{{ $user->id }}"
                                                    src="{{ asset('storage/' . $user->photo) }}"
                                                    alt="Current Image"
                                                    class="w-20 h-20 rounded-lg object-cover border border-gray-200" />
                                            @else
                                                <img id="preview-{{ $user->id }}"
                                                    class="w-20 h-20 rounded-lg object-cover border border-gray-200 hidden"
                                                    alt="Image Preview" />
                                            @endif
                                        </div>
                                        <div>
                                            <label class="block mb-1 font-medium text-gray-700">Full Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" />
                                        </div>
                                        <div>
                                            <label class="block mb-1 font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" />
                                        </div>
                                        <div>
                                            <label class="block mb-1 font-medium text-gray-700">Phone</label>
                                            <input type="number" name="phone" value="{{ $user->phone }}"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" />
                                        </div>
                                        <div>
                                            <label class="block mb-1 font-medium text-gray-700">Role</label>
                                            <select name="role"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="doctor" {{ $user->role === 'doctor' ? 'selected' : '' }}>Doctor</option>
                                                <option value="receptionist" {{ $user->role === 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end gap-3 pt-4 border-t mt-4">
                                            <button type="submit"
                                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-md">Save</button>
                                            <button type="button"
                                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition"
                                                onclick="closeModal('edit-modal-{{ $user->id }}')">Cancel</button>
                                        </div>
                                    </form>
                                    <button type="button"
                                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-xl font-bold transition"
                                        onclick="closeModal('edit-modal-{{ $user->id }}')">×</button>
                                </div>
                            </div>

                            <!-- View Modal -->
                            <div>
                                <input type="checkbox" id="view{{ $user->id }}" class="hidden peer/view" aria-hidden="true" />
                                <div
                                    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 transition-opacity duration-300 peer-checked/view:opacity-100 peer-checked/view:visible opacity-0 invisible">
                                    <div
                                        class="bg-white p-8 rounded-2xl w-full max-w-md shadow-xl transform transition-all duration-300 scale-95 peer-checked/view:scale-100">
                                        <div class="flex items-center mb-6">
                                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default/default-user.jpg') }}"
                                                alt="{{ $user->name }}"
                                                class="w-16 h-16 rounded-full object-cover ring-2 ring-blue-300 mr-4">
                                            <h2 class="text-2xl font-bold text-blue-900">User Details</h2>
                                        </div>
                                        <div class="space-y-4 text-gray-700 text-base">
                                            <div class="flex">
                                                <span class="font-semibold w-24">Name:</span>
                                                <span>{{ $user->name }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="font-semibold w-24">Email:</span>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="font-semibold w-24">Phone:</span>
                                                <span>{{ $user->phone }}</span>
                                            </div>
                                            <div class="flex">
                                                <span class="font-semibold w-24">Role:</span>
                                                <span class="capitalize">{{ $user->role }}</span>
                                            </div>
                                        </div>
                                        <label for="view{{ $user->id }}"
                                            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer text-2xl transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full w-10 h-10 flex items-center justify-center"
                                            aria-label="Close modal">
                                            ×
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- JS for Live Search -->
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

        <!-- JavaScript for Modal Toggle and Image Preview -->
        <script>
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            function previewImage(event, previewId) {
                const input = event.target;
                const preview = document.getElementById(previewId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </main>
</div>
@endsection