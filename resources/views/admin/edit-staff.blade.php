@extends('admin.adminlayout')
@section('title', 'Staff List')
@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar Component -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-2 sm:p-3 md:p-4 lg:ms-[350px] sm:w-[70%] overflow-x-hidden">
            <div class="w-full max-w-full sm:ml-64 lg:max-w-3xl lg:mx-auto">
                <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-3 sm:mb-4 flex items-center space-x-2">
                    <i class="fas fa-users text-white-600 text-lg"></i>
                    <span> Edit {{ $staff->name }} Data </span>
                </h2>

                <!-- Success and Error Messages -->
                @if (session('success'))
                    <div
                        class="bg-green-50 border border-green-200 text-green-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="bg-red-50 border border-red-200 text-red-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Add Doctor Form -->
                <div class="bg-white rounded-xl shadow-xl p-3 sm:p-4 mb-4 sm:mb-6">
                    <form action="{{ route('admin.staff-update', $staff->id) }}" method="POST"
                        class="grid grid-cols-1 gap-2 sm:grid-cols-2 sm:gap-4">
                        @csrf
                        @method('PUT')




                        <!-- Qualification -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" value="{{ $staff->name }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200"
                                placeholder="enter staff name">
                            @error('name')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Position</label>
                            <input type="text" name="position" value="{{ $staff->position }}"
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
                                <option value="Male" {{ old('gender', $staff->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $staff->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('Other', $staff->gender) == 'Other' ? 'selected' : '' }}>Other</option>

                            </select>
                            @error('gender')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Consultation Fee -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="phone" name="phone" value="{{ $staff->phone }}"
                                class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200"
                                placeholder="eg:- 9999999999">
                            @error('phone')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Specialist -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Joining Date</label>
                            <input type="date" name="joining_date" value="{{ $staff->joining_date }}"
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