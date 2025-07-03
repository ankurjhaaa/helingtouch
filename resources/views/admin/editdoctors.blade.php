@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class=" ms-[350px] p-4 sm:p-6 overflow-x-hidden">
        <div class="max-w-full mx-auto">
            <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                <i class="fas fa-user-md text-blue-600"></i>
                <span>Edit - {{ $doctor->user->name }}</span>
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

            <!-- Edit Doctor Form -->
            <div class="bg-white rounded-xl shadow-xl p-6">
                <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6">
                    @csrf
                    @method('PUT')

                    <!-- User Dropdown -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                        <select name="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $doctor->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Department Dropdown -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select name="department_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $doctor->department_id == $department->id ? 'selected' : '' }}>
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
                        <input type="text" name="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('qualification')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                        <input type="text" name="experience" value="{{ old('experience', $doctor->experience) }}"
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
                            <option value="1" {{ $doctor->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $doctor->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Consultation Fee -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee</label>
                        <input type="number" name="fee" value="{{ old('fee', $doctor->fee) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('fee')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Specialist -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Specialist</label>
                        <input type="text" name="specialist" value="{{ old('specialist', $doctor->specialist) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">
                        @error('specialist')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200">{{ old('bio', $doctor->bio) }}</textarea>
                        @error('bio')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Working Days -->
                    @php
                        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    @endphp
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Working Days <span
                                class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($days as $day)
                                <label class="inline-flex items-center gap-2">
                                    <input type="checkbox" name="{{ $day }}" value="1" {{ $doctor->$day ? 'checked' : '' }}
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-300 transition duration-200">
                                    <span class="capitalize text-gray-700 text-sm">{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if ($errors->has('days'))
                            <div class="text-red-500 text-xs mt-1">{{ $errors->first('days') }}</div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="mt-4 w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-sm">
                            Update Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection