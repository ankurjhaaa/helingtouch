@extends('admin.adminlayout')
@section('title', 'Manage Doctors')
@section('content')
    <div class="container mt-3 p-3">
        <h2 class="text-xl font-bold mb-4">Manage Doctor Profiles</h2>

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
        <!-- Add Doctor Form -->
        <form action="{{ route('admin.addDoctor') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">

                {{-- User Dropdown --}}
                <div>
                    <label>User</label>
                    <select name="user_id" id="user_select" class="form-input">
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
                <div>
                    <label for="">Department</label>
                    <select name="department_id" value="{{ old('department_id') }}" class="form-input">
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



                {{-- Qualification --}}
                <div>
                    <label>Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification') }}" class="form-input">
                    @error('qualification')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                @php
                    $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                @endphp

                <div class="mb-3">
                    <label class="form-label">Select Working Days <span class="text-danger">*</span></label>

                    <div class="flex flex-wrap gap-3">
                        @foreach($days as $day)
                            <label class="flex items-center gap-1">
                                <input type="checkbox" name="{{ $day }}" value="1" {{ old($day) ? 'checked' : '' }}>
                                {{ ucfirst($day) }}
                            </label>
                        @endforeach
                    </div>

                    {{-- Custom validation error message --}}
                    @if ($errors->has('days'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('days') }}</div>
                    @endif
                </div>




                {{-- Bio --}}
                <div>
                    <label value="{{ old('bio') }}">Bio</label>
                    <textarea name="bio" class="form-input border-2" rows="4"></textarea>
                    @error('bio')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Experience --}}
                <div>
                    <label value="{{ old('experiemce') }}">Experience</label>
                    <input type="text" name="experience" class="form-input">
                    @error('experience')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label value="{{ old('status') }}">Status</label>
                    <select name="status" class="form-input">
                        <option value="">Select Status</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>



               
            </div>

            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Add Doctor</button>
        </form>

        <!-- Doctor List -->
        <h3 class="text-lg font-semibold mt-8">Doctor List</h3>





    </div>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Doctor List</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Department</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Qualification</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Bio</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Experience</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Working Days</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($doctors as $index => $doctor)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $doctor->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $doctor->department->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $doctor->qualification }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $doctor->bio }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $doctor->experience }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                @php
                                    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                @endphp
                                <ul class="list-disc list-inside">
                                    @foreach($days as $day)
                                        @php $dayKey = strtolower($day); @endphp
                                        @if($doctor->$dayKey)
                                            <li>{{ $day }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <a href="{{ route('admin.doctor.edit', $doctor ) }}"
                                    class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Edit</a>
                                <form action="{{  route('admin.doctor.delete', $doctor->id)  }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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