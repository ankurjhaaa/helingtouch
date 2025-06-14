@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
    <div class="container max-w-6xl mx-auto p-4 sm:p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit - {{ $doctor->user->name }}</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Edit Doctor Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @csrf
                @method('PUT')

                <!-- User Dropdown -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">User</label>
                    <select name="user_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $doctor->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Department Dropdown -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Department</label>
                    <select name="department_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $doctor->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Qualification -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('qualification')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Experience -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Experience</label>
                    <input type="text" name="experience" value="{{ old('experience', $doctor->experience) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('experience')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="sm:col-span-2">
                    <label class="block font-medium text-gray-700 mb-1">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ old('bio', $doctor->bio) }}</textarea>
                    @error('bio')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Working Days -->
                @php
                    $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                @endphp
                <div class="sm:col-span-2">
                    <label class="block font-medium text-gray-700 mb-2">Select Working Days <span
                            class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">
                        @foreach($days as $day)
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="{{ $day }}" value="1" {{ $doctor->$day ? 'checked' : '' }}
                                    class="form-checkbox text-blue-600">
                                <span class="capitalize">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('days'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('days') }}</div>
                    @endif
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="">Select Status</option>
                        <option value="1" {{ $doctor->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $doctor->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- fee -->
                  <div>
                    <label class="block font-medium text-gray-700 mb-1">Consultation Fee</label>
                    <input type="number" name="fee" value="{{ $doctor->fee }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('fee')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="sm:col-span-2">
                    <button type="submit"
                        class="mt-4 w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition duration-150">
                        Update Doctor
                    </button>
                </div>
            </form>
        </div>
    </div>




    <script>
        document.getElementById('user_select').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const name = selected.getAttribute('data-name');
            const photo = selected.getAttribute('data-photo');

            document.getElementById('user_name').value = name;
            document.getElementById('user_photo').src = photo;
        });
    </script>


@endsection