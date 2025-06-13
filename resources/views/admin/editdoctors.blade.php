@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
    <div class="container mt-3 p-3">
        <h2 class="text-xl font-bold mb-4">Edit-{{ $doctor->user->name }}</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100
                                                             text-red-800 p-3 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif
        <!-- Edit Doctor Form -->
        <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">

                {{-- User Dropdown --}}
                <div>
                    <label>User</label>
                    <select name="user_id" class="form-input">
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

                {{-- Department Dropdown --}}
                <div>
                    <label>Department</label>
                    <select name="department_id" class="form-input">
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

                {{-- Qualification --}}
                <div>
                    <label>Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                        class="form-input">
                    @error('qualification')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Experience --}}
                <div>
                    <label>Experience</label>
                    <input type="text" name="experience" value="{{ old('experience', $doctor->experience) }}"
                        class="form-input">
                    @error('experience')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bio --}}
                <div class="col-span-2">
                    <label>Bio</label>
                    <textarea name="bio" rows="4" class="form-input border-2">{{ old('bio', $doctor->bio) }}</textarea>
                    @error('bio')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Working Days --}}
                @php
                    $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                @endphp
                <div class="col-span-2">
                    <label class="form-label">Select Working Days <span class="text-danger">*</span></label>
                    <div class="flex flex-wrap gap-3">
                        @foreach($days as $day)
                            <label class="flex items-center gap-1">
                                <input type="checkbox" name="{{ $day }}" value="1" {{ $doctor->$day ? 'checked' : '' }}>
                                {{ ucfirst($day) }}
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('days'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('days') }}</div>
                    @endif
                </div>

                {{-- Status --}}
                <div>
                    <label>Status</label>
                    <select name="status" class="form-input">
                        <option value="">Select Status</option>
                        <option value="1" {{ $doctor->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $doctor->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Update Doctor
            </button>
        </form>






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