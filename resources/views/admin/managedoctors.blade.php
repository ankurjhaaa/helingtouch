@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
    <div class="container max-w-6xl mx-auto p-4 sm:p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Manage Doctor Profiles</h2>

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

        <!-- Add Doctor Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.addDoctor') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @csrf

                <!-- User Dropdown -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">User</label>
                    <select name="user_id" id="user_select"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="{{ old('user_id') }}">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                data-photo="{{ asset('storage/' . $user->photo) }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Department</label>
                    <select name="department_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                    <input type="text" name="qualification" value="{{ old('qualification') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('qualification')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Experience -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Experience</label>
                    <input type="text" name="experience" value="{{ old('experience') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('experience')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        <option value="">Select Status</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="sm:col-span-2">
                    <label class="block font-medium text-gray-700 mb-1">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ old('bio') }}</textarea>
                    @error('bio')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Working Days -->
                <div class="sm:col-span-2">
                    <label class="block font-medium text-gray-700 mb-2">Select Working Days <span
                            class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">
                        @php
                            $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                        @endphp
                        @foreach($days as $day)
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="{{ $day }}" value="1" {{ old($day) ? 'checked' : '' }}
                                    class="form-checkbox text-blue-600">
                                <span class="capitalize">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('days'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('days') }}</div>
                    @endif
                </div>

                <div class="sm:col-span-2">
                    <button type="submit"
                        class="mt-4 w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition duration-150">
                        Add Doctor
                    </button>
                </div>
            </form>
        </div>
    </div>




    <div class="container max-w-6xl mx-auto mt-10 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Doctor List</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Department</th>
                        <th class="px-4 py-3 text-left">Qualification</th>
                        <th class="px-4 py-3 text-left">Bio</th>
                        <th class="px-4 py-3 text-left">Experience</th>
                        <th class="px-4 py-3 text-left">Working Days</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($doctors as $index => $doctor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $doctor->user->name }}</td>
                            <td class="px-4 py-3">{{ $doctor->department->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $doctor->qualification }}</td>
                            <td class="px-4 py-3 max-w-xs truncate" title="{{ $doctor->bio }}">
                                {{ Str::limit($doctor->bio, 50) }}
                            </td>
                            <td class="px-4 py-3">{{ $doctor->experience }}</td>
                            <td class="px-4 py-3">
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
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.doctor.edit', $doctor) }}"
                                    class="inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.doctor.delete', $doctor->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($doctors->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-6">No doctors found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
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