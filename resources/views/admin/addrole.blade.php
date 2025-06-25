@extends('admin.adminlayout')
@section('title', 'Apply for Role')
@section('content')
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AOS Library CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="loader border-t-4 border-blue-600 rounded-full w-12 h-12 animate-spin"></div>
    </div>

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
         <x-admin-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-6 flex items-center justify-center ml-64">
            <div class="w-full max-w-md bg-white border border-gray-200 rounded-xl shadow-2xl p-8" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2" data-aos="fade-down" data-aos-delay="100">
                    <i class="fas fa-file-alt text-blue-600"></i>
                    <span>Apply for Role</span>
                </h2>

                <!-- Flash Message -->
                @if(session('success'))
                    <div class="text-sm text-green-700 bg-green-50 border border-green-200 px-4 py-3 rounded-lg mb-4 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="text-sm text-red-700 bg-red-50 border border-red-200 px-4 py-3 rounded-lg mb-4 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <ul class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-4 list-disc list-inside transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('admin.applySubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="applyForm">
                    @csrf

                    <div data-aos="fade-right" data-aos-delay="300">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                               placeholder="Enter full name">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-right" data-aos-delay="400">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                               placeholder="Enter email address">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-right" data-aos-delay="500">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password"
                               class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                               placeholder="Enter password">
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-right" data-aos-delay="600">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role"
                                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200">
                            <option value="">Select Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="receptionist" {{ old('role') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-right" data-aos-delay="700">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                               placeholder="Enter phone number">
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-right" data-aos-delay="800">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        <div class="relative">
                            <input type="file" name="photo" id="photoUpload"
                                   class="w-full text-sm border border-gray-300 rounded-lg bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200"
                                   accept="image/*">
                            <img id="photoPreview" class="hidden w-24 h-24 rounded-md border object-cover bg-gray-100 mt-2" alt="Photo Preview">
                        </div>
                        @error('photo')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-up" data-aos-delay="900">
                        <button type="submit" id="submitButton"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Submit Application</span>
                            <i class="fas fa-spinner fa-spin hidden"></i>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
        });

        // Photo Preview
        document.getElementById('photoUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form Submission (Client-side demo)
        document.getElementById('applyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const spinner = submitButton.querySelector('.fa-spinner');
            submitButton.disabled = true;
            spinner.classList.remove('hidden');

            // Simulate form submission
            setTimeout(() => {
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                alert('Application submitted successfully! (Demo)');
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