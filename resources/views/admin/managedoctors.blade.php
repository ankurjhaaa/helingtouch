@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 overflow-x-hidden">
        <div class="max-w-[70%] ms-[350px]">
            <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                <i class="fas fa-user-md text-blue-600"></i>
                <span>Manage Doctor Profiles</span>
            </h2>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 transition-all duration-300">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-md mb-4 transition-all duration-300">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add Doctor Form -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-8">
                <form action="{{ route('admin.addDoctor') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6">
                    @csrf

                    <!-- User Dropdown -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                        <select name="user_id" id="user_select"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                            <option value="{{ old('user_id') }}">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                    data-photo="{{ asset('storage/' . $user->photo) }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select name="department_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Qualification -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
                        <input type="text" name="qualification" value="{{ old('qualification') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('qualification')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                        <input type="text" name="experience" value="{{ old('experience') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('experience')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                            <option value="">Select Status</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Consultation Fee -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee</label>
                        <input type="number" name="fee" value="{{ old('fee') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('fee')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Specialist -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Specialist</label>
                        <input type="text" name="specialist" value="{{ old('specialist', $doctor->specialist ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('specialist')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Working Days -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Working Days <span
                                class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-3">
                            @php
                                $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                            @endphp
                            @foreach($days as $day)
                                <label class="inline-flex items-center gap-2">
                                    <input type="checkbox" name="{{ $day }}" value="1" {{ old($day) ? 'checked' : '' }}
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-300 transition duration-200">
                                    <span class="capitalize text-gray-700 text-sm">{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if ($errors->has('days'))
                            <div class="text-red-500 text-xs mt-1">{{ $errors->first('days') }}</div>
                        @endif
                    </div>

                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="mt-4 w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-sm">
                            Add Doctor
                        </button>
                    </div>
                </form>
            </div>

            <!-- Doctor List -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-4 flex items-center space-x-2">
                    <i class="fas fa-stethoscope text-blue-600"></i>
                    <span>Doctor List</span>
                </h2>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 transition-all duration-300">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto bg-white shadow-xl rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-blue-100 text-blue-900">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-sm">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Name</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Department</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Specialist</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Qualification</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Consultation Fee</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Bio</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Experience</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Working Days</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Status</th>
                                <th class="px-4 py-3 text-center font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($doctors as $index => $doctor)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800 text-sm">{{ $doctor->user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $doctor->department->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $doctor->specialist }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $doctor->qualification }}</td>
                                    <td class="px-4 py-3 text-sm">₹{{ $doctor->fee }}</td>
                                    <td class="px-4 py-3 max-w-[200px] truncate text-sm" title="{{ $doctor->bio }}">
                                        {{ Str::limit($doctor->bio, 30) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $doctor->experience }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @php
                                            $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                        @endphp
                                        <ul class="list-disc list-inside text-xs text-gray-600">
                                            @foreach($days as $day)
                                                @php $dayKey = strtolower($day); @endphp
                                                @if($doctor->$dayKey)
                                                    <li>{{ $day }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="{{ $doctor->status ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $doctor->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 flex justify-center space-x-2">
                                        <a href="{{ route('admin.doctor.edit', $doctor) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.doctor.delete', $doctor->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition duration-200 shadow-md text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($doctors->isEmpty())
                                <tr>
                                    <td colspan="11" class="text-center text-gray-500 py-6 text-sm">No doctors found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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