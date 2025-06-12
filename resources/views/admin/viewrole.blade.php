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
                                <label for="view{{ $user->id }}"
                                    class="text-blue-600 hover:underline cursor-pointer">View</label>
                                <!-- Edit Label to Trigger Modal -->
                                <!-- Edit Label to Trigger Modal -->
                                <!-- Edit Button to Trigger Modal -->
                                <button type="button"
                                    class="text-yellow-500 hover:text-yellow-600  font-medium  cursor-pointer transition-colors duration-200"
                                    onclick="openModal('edit-modal-{{ $user->id }}')">Edit</button>
                                <form action="{{ route('admin.deleteRole', $user->id) }}" method="post" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>



                            </td>
                        </tr>


                        <div>
                            <!-- Modal -->
                            <div id="edit-modal-{{ $user->id }}"
                                class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 p-4 transition-opacity duration-300">
                                <div
                                    class="bg-white p-5 rounded-2xl w-full max-w-md min-h-[450px] shadow-xl relative transform transition-all duration-300 scale-95 modal-open:scale-100">
                                    <h2 class="text-sm font-bold text-gray-900 mb-4">Edit {{ $user->name }}</h2>
                                    <form class="space-y-3" action="{{ route('admin.updateRole', $user->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <!-- File Input for Photo -->
                                        <div>
                                            <input type="file" name="photo" id="photo-{{ $user->id }}" accept="image/*"
                                                class="w-full border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                onchange="previewImage(event, 'preview-{{ $user->id }}')" />
                                        </div>
                                        <!-- Image Preview -->
                                        <div class="mt-2">
                                            @if ($user->photo)
                                                <img id="preview-{{ $user->id }}" src="{{ asset('storage/' . $user->photo) }}"
                                                    alt="Current Image"
                                                    class="w-20 h-20 rounded-md border border-gray-200 object-contain bg-gray-50" />
                                            @else
                                                <img id="preview-{{ $user->id }}"
                                                    class="w-20 h-20 rounded-md border border-gray-200 object-contain bg-gray-50 hidden"
                                                    alt="Image Preview" />
                                            @endif
                                        </div>

                                        <!-- Name Input -->
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="w-full border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            placeholder="Full Name" />

                                        <!-- Email Input -->
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="w-full border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            placeholder="Email Address" />

                                        <!-- Phone Input -->
                                        <input type="number" name="phone" value="{{ $user->phone }}"
                                            class="w-full border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            placeholder="Phone Number" />

                                        <!-- Role Select -->
                                        <select name="role"
                                            class="w-full border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="doctor" {{ $user->role === 'doctor' ? 'selected' : '' }}>Doctor
                                            </option>
                                            <option value="receptionist" {{ $user->role === 'receptionist' ? 'selected' : '' }}>
                                                Receptionist</option>
                                        </select>

                                        <!-- Form Actions -->
                                        <div class="flex justify-end space-x-2 mt-4">
                                            <button type="submit"
                                                class="bg-indigo-600 text-white px-3 py-1 rounded-md text-xs font-medium hover:bg-indigo-700 transition-colors duration-200">Save</button>
                                            <button type="button"
                                                class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-xs font-medium hover:bg-gray-200 transition-colors duration-200"
                                                onclick="closeModal('edit-modal-{{ $user->id }}')">Cancel</button>
                                        </div>
                                    </form>

                                    <!-- Close Modal Button -->
                                    <button type="button"
                                        class="absolute top-1 right-1 text-gray-400 hover:text-gray-600 text-lg font-bold transition-colors duration-200"
                                        onclick="closeModal('edit-modal-{{ $user->id }}')">×</button>
                                </div>
                            </div>
                        </div>


                        <!-- 🔳 View Modal - Aman -->
                        <div>
                            <input type="checkbox" id="view{{ $user->id }}" class="hidden peer/view" aria-hidden="true" />
                            <div
                                class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 transition-opacity duration-300 peer-checked/view:opacity-100 peer-checked/view:visible opacity-0 invisible">
                                <div
                                    class="bg-white p-8 rounded-2xl w-full max-w-md shadow-xl transform transition-all duration-300 scale-95 peer-checked/view:scale-100">
                                    <div class="flex items-center mb-6">
                                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default/default-user.jpg') }}"
                                            alt="{{ $user->name }}"
                                            class="w-16 h-16 rounded-full object-cover ring-2 ring-gray-300 mr-4">
                                        <h2 class="text-2xl font-bold text-gray-900">User Details</h2>
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


    <!-- 📌 Tip: Copy this structure for view2/edit2 and view3/edit3 -->

    <script src="{{ asset('js/modal.js') }}"></script>
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
@endsection