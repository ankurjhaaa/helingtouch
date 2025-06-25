@extends('admin.adminlayout')
@section('title', 'Gallery')
@section('content')
    
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar Component -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 overflow-x-hidden">
            <div class="max-w-full mx-auto">
                <!-- Upload to Gallery Form -->
                <div class="max-w-2xl ms-[400px] bg-white rounded-xl shadow-xl p-6 mb-8">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                        <i class="fas fa-image text-blue-600"></i>
                        <span>Upload to Gallery</span>
                    </h2>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 relative transition-all duration-300">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-0 right-0 px-4 py-3 text-xl font-bold text-green-700 hover:text-green-900">×</button>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div
                            class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-md mb-4 relative transition-all duration-300">
                            <strong class="font-bold">Oops!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-0 right-0 px-4 py-3 text-xl font-bold text-red-700 hover:text-red-900">×</button>
                        </div>
                    @endif

                    <!-- Upload Form -->
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title (optional)</label>
                            <input type="text" name="title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200"
                                value="{{ old('title') }}" />
                            @error('title')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select name="type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                                <option value="">Select Type</option>
                                <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('type')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                            <input type="file" name="file"
                                class="w-full text-sm border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200" />
                            @error('file')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-sm">
                            Upload
                        </button>
                    </form>
                </div>

                <!-- Gallery Table -->
                <div class="max-w-[60%] ms-[400px] bg-white rounded-xl shadow-xl p-6">
                    <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center space-x-2">
                        <i class="fas fa-images text-blue-600"></i>
                        <span>Gallery Items</span>
                    </h2>

                    @if($galleryItems->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-blue-100 text-blue-900">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">Type</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">Preview</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">Uploaded</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($galleryItems as $index => $item)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item->title ?? '-' }}</td>
                                            <td class="px-4 py-3 text-sm capitalize">{{ $item->type }}</td>
                                            <td class="px-4 py-3">
                                                @if($item->type == 'image')
                                                    <img src="{{ asset('storage/' . $item->file) }}"
                                                        class="w-20 h-16 object-cover rounded border border-gray-200" />
                                                @elseif($item->type == 'video')
                                                    <video width="120" height="68" controls class="rounded border border-gray-200">
                                                        <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-3 flex items-center content-center space-x-2">
                                                <a href="{{ route('admin.gallery.edit', $item->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.gallery.delete', $item->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 hover:cursor-pointer font-medium text-sm transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No gallery items uploaded yet.</p>
                    @endif
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