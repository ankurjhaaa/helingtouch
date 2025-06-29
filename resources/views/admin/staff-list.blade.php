@extends('admin.adminlayout')
@section('title', 'Staff List')
@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar Component -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-2  sm:p-3 md:p-4 lg:ms-[350px] sm:w-[70%] overflow-x-hidden">
            <div class="w-full max-w-full sm:ml-64 lg:max-w-3xl lg:mx-auto">
                <h2 class="text-lg mt-7   sm:text-xl font-bold text-blue-900 mb-3 sm:mb-4 flex items-center space-x-2">





                    <i class="fas fa-users text-white-600 text-lg"></i>
                    <span> Add Staff </span>


                </h2>
               




             <!-- Success Message -->
@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        x-transition
        class="bg-green-50 border border-green-200 text-green-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm relative"
    >
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="absolute top-1 right-2 text-green-700 hover:text-red-500 text-sm">
            &times;
        </button>
    </div>
@endif

<!-- Error Message -->
@if (session('error'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        x-transition
        class="bg-red-50 border border-red-200 text-red-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm relative"
    >
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="absolute top-1 right-2 text-red-700 hover:text-red-900 text-sm">
            &times;
        </button>
    </div>
@endif


                <!-- Add Doctor Form -->
                <div class="bg-white rounded-xl shadow-xl p-3 sm:p-4 mb-4 sm:mb-6">
                    <form action="{{ route('admin.storestaff') }}" method="POST"
                        class="grid grid-cols-1 gap-2 sm:grid-cols-2 sm:gap-4">
                        @csrf




                        <!-- Qualification -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200"
                                placeholder="enter staff name">
                            @error('name')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Position</label>
                            <input type="text" name="position" value="{{ old('position') }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200"
                                placeholder="enter position name">
                            @error('position')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Select Gender</label>
                            <select name="gender"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('Other') == 'Other' ? 'selected' : '' }}>Other</option>

                            </select>
                            @error('gender')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Consultation Fee -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200"
                                placeholder="eg:- 9999999999">
                            @error('phone')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Specialist -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Joining Date</label>
                            <input type="date" name="joining_date" value="{{ old('joining_date') }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                            @error('joining_date')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>





                        <div class="sm:col-span-2">
                            <button type="submit"
                                class="mt-2 w-full sm:w-auto bg-blue-600 text-white px-3 py-1 sm:px-4 sm:py-1 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-xs sm:text-sm">
                                Add Staff
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Doctor List -->
                <div class="mt-4 sm:mt-6">
                    <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-3 flex items-center space-x-2">
                        <i class="fas fa-users text-white-600 text-lg"></i>
                        <span>Staff List</span>
                    </h2>
                     <div class="w-full p-2 text-center bg-pink-100 border border-pink-300 rounded-lg  sm:p-4 dark:bg-gray-800 dark:border-gray-700 mb-3 shadow-sm">
                    <form method="GET" class="max-w-3xl mx-auto">
                        <div class="flex flex-wrap sm:flex-nowrap w-full items-center justify-center">
                            <!-- Dropdown -->
                            <select name="position"
                                class="text-center flex align-center justify-center w-40 py-2.5 px-4 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500 ">
                                <option value="" class="text-center">All Positions</option>
                                @foreach ( $position as $pos )
                                 <option value="{{ $pos }} {{ $filter == $pos ? 'selected' : '' }}"  class="text-center">{{ ucfirst($pos) }}</option>
                                
                                @endforeach
                               
                               
                               
                               
                            </select>

                            <!-- Search Input -->
                            <input type="text" name="search" placeholder="Search by name"
                                class="block p-2.5 w-full sm:w-80 text-sm text-gray-900 bg-gray-50 border-t border-b border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"  value="{{ $search }}" />

                            <!-- Search Button -->
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-4 py-2 border border-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Search
                            </button>

                            <!-- Reset Button -->
                            <a href="{{ route('admin.stafflist') }}"
                                class="text-gray-800 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium text-sm px-4 py-2 rounded-e-lg border border-gray-300 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 dark:focus:ring-gray-500">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                           @if(session('success'))
                                <div 
                                    x-data="{ show: true }" 
                                    x-init="setTimeout(() => show = false, 4000)" 
                                    x-show="show"
                                    x-transition
                                    class="bg-green-50 border border-green-200 text-green-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg                             shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm relative"
                                >
                                    <span>{{ session('success') }}</span>
                                    
                                    <!-- Dismiss Button -->
                                    <button @click="show = false" class="absolute top-1 right-2 text-green-700 hover:text-red-500                             text-sm">
                                        &times;
                                    </button>
                                </div>
                           @endif


                    <div
                        class="overflow-x-auto overflow-y-auto max-h-[400px] bg-white shadow-xl rounded-xl w-full max-w-full lg:max-w-3xl mx-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-xs">
                            <thead class="bg-blue-100 text-blue-900 sticky top-0 z-10">
                                <tr>
                                    <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">#</th>
                                    <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Name
                                    </th>
                                    <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">
                                        Position</th>
                                    <th
                                        class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden md:table-cell">
                                        Gender</th>
                                    <th
                                        class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden lg:table-cell">
                                        Phone Number</th>
                                    <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Joining
                                        Date</th>

                                    <th class="px-1 py-1 sm:px-2 sm:py-1 text-center font-semibold text-xs sm:text-sm ">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($staffs as $index => $staff)
                                    <tr class="hover:bg-blue-50 transition-colors duration-200">
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">{{ $index + 1  }}</td>
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 font-medium text-gray-800 text-xs sm:text-sm">
                                            {{ $staff->name }}
                                        </td>
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">{{ $staff->position }}</td>
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden md:table-cell">
                                            {{ $staff->gender }}
                                        </td>
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden lg:table-cell">
                                            {{ $staff->phone }}
                                        </td>
                                        <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">
                                            {{ $staff->joining_date ? \Carbon\Carbon::parse($staff->joining_date)->format('d M Y') : 'N/A' }}
                                        </td>




                                        <td
                                            class="px-1 py-1 mt-2 sm:px-2 sm:py-1 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.edit-staff', $staff->id) }}"
                                                class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition duration-200 shadow text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.staff-delete', $staff->id) }}" method="POST"
                                                class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 sm:px-3 sm:py-1.5 rounded-lg hover:bg-red-700 transition duration-200 shadow-md text-sm min-w-[60px] text-center hover:cursor-pointer">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                                    @empty
                                     <tr>
                                         <td colspan="7" class="text-center py-4 text-gray-500 text-sm">
                                             <i class="fas fa-user-slash text-red-500 mr-2"></i> No staff found.
                                         </td>
                                     </tr>

                                @endforelse

                              



                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $staffs->links() }}
                        </div>




                    </div>
                </div>
            </div>

            <!-- JavaScript for User Selection -->
            <script>
                document.getElementById('user_select').addEventListener('change', function () {
                    const selected = this.options[this.selectedIndex];
                    const name = selected.getAttribute('data-name');
                    const photo = selected.getAttribute('data-photo');

                    const nameInput = document.getElementById('user_name');
                    const photoImg = document.getElementById('user_photo');
                    if (nameInput && photoImg) {
                        nameInput.value = name;
                        photoImg.src = photo;
                    }
                });
            </script>
        </main>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
        });

        // File Preview
        document.getElementById('fileUpload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const filePreview = document.getElementById('filePreview');
            const imagePreview = document.getElementById('imagePreview');
            const videoPreview = document.getElementById('videoPreview');
            const videoSource = document.getElementById('videoSource');

            // Reset previews
            imagePreview.classList.add('hidden');
            videoPreview.classList.add('hidden');
            filePreview.classList.add('hidden');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (file.type.startsWith('image/')) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        filePreview.classList.remove('hidden');
                    } else if (file.type === 'video/mp4') {
                        videoSource.src = e.target.result;
                        videoPreview.load();
                        videoPreview.classList.remove('hidden');
                        filePreview.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Form Submission (Client-side demo)
        document.getElementById('galleryForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const spinner = submitButton.querySelector('.fa-spinner');
            submitButton.disabled = true;
            spinner.classList.remove('hidden');

            // Simulate form submission
            setTimeout(() => {
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                alert('Gallery updated successfully! (Demo)');
            }, 1500);
        });

        // Hide loading overlay after page load
        window.addEventListener('load', () => {
            const overlay = document.getElementById('loading-overlay');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.remove(), 500);
        });
    </script>
@endsection