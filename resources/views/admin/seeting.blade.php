@extends('admin.adminlayout')
@section('title', 'Admin Settings')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="max-w-2xl ms-[350px] space-y-8">
            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg shadow-md transition-all duration-300">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg shadow-md transition-all duration-300">
                    <strong class="font-semibold">Oops! Something went wrong:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Location Settings Card -->
            <div class="bg-white rounded-xl shadow-xl p-8">
                <h1 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                    <span>Location Settings</span>
                </h1>
                <form action="{{ route('admin.seeting.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" id="address" placeholder="Enter Address"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                            value="{{ $setting->address ?? '' }}">
                        @error('address')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                            <input type="text" name="latitude" id="latitude" placeholder="Enter Latitude"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                                value="{{ $setting->latitude ?? '' }}">
                            @error('latitude')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                            <input type="text" name="longitude" id="longitude" placeholder="Enter Longitude"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                                value="{{ $setting->longitude ?? '' }}">
                            @error('longitude')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow-md hover:shadow-lg">
                        Save Location
                    </button>
                </form>
            </div>

            <!-- General Information Card -->
            <div class="bg-white rounded-xl shadow-xl p-8">
                <h1 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                    <i class="fas fa-info-circle text-blue-600"></i>
                    <span>General Information</span>
                </h1>
                <form action="{{ route('admin.seeting.information') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                            value="{{ old('name', $setting->name ?? '') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" id="address" placeholder="Enter Address"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 h-24 resize-y transition duration-200">{{ old('address', $setting->address ?? '') }}</textarea>
                        @error('address')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" id="phone" placeholder="Enter Phone Number"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                                value="{{ old('phone', $setting->phone ?? '') }}">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                                value="{{ old('email', $setting->email ?? '') }}">
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="visiting_hours" class="block text-sm font-medium text-gray-700 mb-2">Visiting Hours</label>
                        <input type="text" name="visiting_hours" id="visiting_hours" placeholder="Enter Visiting Hours"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200"
                            value="{{ old('visiting_hours', $setting->visiting_hours ?? '') }}">
                        @error('visiting_hours')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="emergency_available" class="block text-sm font-medium text-gray-700 mb-2">Emergency Available</label>
                        <select name="emergency_available" id="emergency_available"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 transition duration-200">
                            <option value="1" {{ old('emergency_available', $setting->emergency_available ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('emergency_available', $setting->emergency_available ?? '') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('emergency_available')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow-md hover:shadow-lg">
                        Save Information
                    </button>
                </form>
            </div>
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

        // File Preview
        document.getElementById('fileUpload').addEventListener('change', function(event) {
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
                reader.onload = function(e) {
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
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
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