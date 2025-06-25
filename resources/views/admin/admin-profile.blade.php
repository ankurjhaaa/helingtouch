@extends('admin.adminlayout')
@section('title', 'Admin Profile')
@section('content')
  <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="loader border-t-4 border-blue-600 rounded-full w-12 h-12 animate-spin"></div>
    </div>
    <x-admin-sidebar />

    <div class="min-h-screen bg-gray-100 p-6 ml-64">
        <div class="max-w-5xl mx-auto mt-4 bg-white shadow-2xl rounded-xl overflow-hidden" data-aos="fade-up" data-aos-duration="800">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-2xl font-semibold">Doctor Profile</h2>
                <i class="fas fa-user-md text-blue-200 text-xl"></i>
            </div>

            <!-- Form -->
            <form class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data" id="profileForm">
                <!-- Profile Photo Upload -->
                <div class="col-span-full flex items-start gap-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="relative group">
                        <img id="profilePhotoPreview" 
                             src="{{ Auth::check() && Auth::user()->photo && file_exists(storage_path('app/public/' . Auth::user()->photo)) ? asset('storage/' . Auth::user()->photo) : asset('default/default-user.jpg') }}"
                             alt="Doctor Photo" 
                             class="w-32 h-32 rounded-md border-2 border-gray-200 object-cover bg-gray-100 shadow-md">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-md">
                            <label for="photoUpload" class="cursor-pointer text-white text-sm flex items-center gap-2">
                                <i class="fas fa-camera"></i> Change Photo
                            </label>
                            <input type="file" id="photoUpload" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(event)">
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div data-aos="fade-right" data-aos-delay="200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" disabled
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                <!-- Email -->
                <div data-aos="fade-left" data-aos-delay="200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" disabled
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                <!-- Phone -->
                <div data-aos="fade-right" data-aos-delay="300">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" value="{{ Auth::user()->phone }}" disabled
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>

                <!-- Submit Button -->
                <div class="col-span-full text-right mt-4" data-aos="fade-up" data-aos-delay="400">
                    <button type="submit" id="submitButton" class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center gap-2">
                        <span>Save Changes</span>
                        <i class="fas fa-spinner fa-spin hidden"></i>
                    </button>
                </div>
            </form>
        </div>
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
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePhotoPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Form Submission (Client-side demo)
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const spinner = submitButton.querySelector('.fa-spinner');
            submitButton.disabled = true;
            spinner.classList.remove('hidden');

            // Simulate form submission
            setTimeout(() => {
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                alert('Profile updated successfully! (Demo)');
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