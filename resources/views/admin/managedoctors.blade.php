@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

 <!-- Main Content -->
    <main class="flex-1 p-2 sm:p-3 md:p-4 lg:ms-[350px] sm:w-[70%] overflow-x-hidden">
        <div class="w-full max-w-full sm:ml-64 lg:max-w-3xl lg:mx-auto">
            <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-3 sm:mb-4 flex items-center space-x-2">
                <i class="fas fa-user-md text-blue-600"></i>
                <span>Manage Doctor Profiles</span>
            </h2>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add Doctor Form -->
            <div class="bg-white rounded-xl shadow-xl p-3 sm:p-4 mb-4 sm:mb-6">
                <form action="{{ route('admin.addDoctor') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 gap-2 sm:grid-cols-2 sm:gap-4">
                    @csrf

                    <!-- User Dropdown -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">User</label>
                        <select name="user_id" id="user_select"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
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
                        <label class="block text-xs font-medium text-gray-700 mb-1">Department</label>
                        <select name="department_id"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
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
                        <label class="block text-xs font-medium text-gray-700 mb-1">Qualification</label>
                        <input type="text" name="qualification" value="{{ old('qualification') }}"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                        @error('qualification')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Experience</label>
                        <input type="text" name="experience" value="{{ old('experience') }}"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                        @error('experience')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
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
                        <label class="block text-xs font-medium text-gray-700 mb-1">Consultation Fee</label>
                        <input type="number" name="fee" value="{{ old('fee') }}"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                        @error('fee')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Specialist -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Specialist</label>
                        <input type="text" name="specialist" value="{{ old('specialist', $doctor->specialist ?? '') }}"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">
                        @error('specialist')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" rows="3"
                            class="w-full px-1 py-1 sm:px-2 sm:py-1 border @error('bio')  @enderror border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-xs transition duration-200">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Working Days -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Select Working Days <span
                                class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-1 sm:gap-2">
                            @php
                                $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                            @endphp
                            @foreach($days as $day)
                                <label class="inline-flex items-center gap-1">
                                    <input type="checkbox" name="{{ $day }}" value="1" {{ old($day) ? 'checked' : '' }}
                                        class="form-checkbox h-3 w-3 text-blue-600 rounded focus:ring-blue-300 transition duration-200">
                                    <span class="capitalize text-gray-700 text-xs">{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if ($errors->has('days'))
                            <div class="text-red-500 text-xs mt-1">{{ $errors->first('days') }}</div>
                        @endif
                    </div>

                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="mt-2 w-full sm:w-auto bg-blue-600 text-white px-3 py-1 sm:px-4 sm:py-1 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-xs sm:text-sm">
                            Add Doctor
                        </button>
                    </div>
                </form>
            </div>

            <!-- Doctor List -->
            <div class="mt-4 sm:mt-6">
                <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-3 flex items-center space-x-2">
                    <i class="fas fa-stethoscope text-blue-600"></i>
                    <span>Doctor List</span>
                </h2>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-2 py-1 sm:px-3 sm:py-2 rounded-lg shadow-md mb-3 sm:mb-4 transition-all duration-300 text-xs sm:text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto overflow-y-auto max-h-[400px] bg-white shadow-xl rounded-xl w-full max-w-full lg:max-w-3xl mx-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-blue-100 text-blue-900 sticky top-0 z-10">
                            <tr>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">#</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Name</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Department</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden md:table-cell">Specialist</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden lg:table-cell">Qualification</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Consultation Fee</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden xl:table-cell">Bio</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden lg:table-cell">Experience</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm hidden md:table-cell">Working Days</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-left font-semibold text-xs sm:text-sm">Status</th>
                                <th class="px-1 py-1 sm:px-2 sm:py-1 text-center font-semibold text-xs sm:text-sm ">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($doctors as $index => $doctor)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">{{ $index + 1 }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 font-medium text-gray-800 text-xs sm:text-sm">{{ $doctor->user->name }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">{{ $doctor->department->name ?? 'N/A' }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden md:table-cell">{{ $doctor->specialist }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden lg:table-cell">{{ $doctor->qualification }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">₹{{ $doctor->fee }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 max-w-[80px] sm:max-w-[120px] truncate text-xs sm:text-sm hidden xl:table-cell" title="{{ $doctor->bio }}">
                                        {{ Str::limit($doctor->bio, 10) }}
                                    </td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden lg:table-cell">{{ $doctor->experience }}</td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm hidden md:table-cell">
                                        <ul class="list-disc list-inside text-xs text-gray-600">
                                            @php
                                                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                            @endphp
                                            @foreach($days as $day)
                                                @php $dayKey = strtolower($day); @endphp
                                                @if($doctor->$dayKey)
                                                    <li>{{ $day }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-sm">
                                        <span class="{{ $doctor->status ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $doctor->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-1 py-1 mt-2 sm:px-2 sm:py-1 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                        <a href="{{ route('admin.doctor.edit', $doctor) }}"
                                            class= "bg-blue-600 text-white px-3 py-1 sm:px-3 sm:py-1.5 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md text-sm min-w-[60px] text-center">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.doctor.delete', $doctor->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class= "bg-red-600 text-white px-3 py-1 sm:px-3 sm:py-1.5 rounded-lg hover:bg-red-700 transition duration-200 shadow-md text-sm min-w-[60px] text-center">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($doctors->isEmpty())
                                <tr>
                                    <td colspan="11" class="text-center text-gray-500 py-3 sm:py-4 text-xs sm:text-sm">No doctors found.</td>
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