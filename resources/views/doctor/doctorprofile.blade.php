@extends('doctor.doctorlayout')
@section('title')
    doctordashboard

@endsection
@section('content')

    <div class="p-2">
        <div class="max-w-5xl mx-auto mt-4 bg-white shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Doctor Profile</h2>
            </div>

            <!-- Form -->
            <form class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Profile Photo Upload -->
                <div class="col-span-full flex items-start gap-6">
                    <img src="https://via.placeholder.com/100x100" alt="Doctor Photo"
                        class="w-24 h-24 rounded-md border object-cover bg-gray-100">

                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" disabled
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500 bg-gray-100">
                </div>

                <!-- Email (readonly) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" disabled
                        class="mt-1 w-full border px-4 py-2 rounded bg-gray-100 text-gray-500">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" value="{{ Auth::user()->phone }}" disabled
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500 bg-gray-100">
                </div>


                <!-- Department Select -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Department</label>
                    <select name="department_id	"
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach

                    </select>
                </div>

                <!-- Qualification -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Qualification</label>
                    <input name="qualification" type="text" placeholder="MBBS, MD"
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Experience -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Experience (years)</label>
                    <input name="experience" type="number" placeholder="12"
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Bio -->
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea name="bio" rows="4" placeholder="Short introduction..."
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>

                <!-- Weekly Availability Checkboxes -->
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Weekly Availability</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="sunday" value="sunday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Sunday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="monday" value="monday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Monday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tuesday" value="tuesday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Tuesday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="wednesday" value="wednesday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Wednesday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="thursday" value="thursday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Thursday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="friday" value="friday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Friday</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="saturday" value="saturday" class="h-4 w-4 text-blue-600">
                            <span class="text-sm text-gray-700">Saturday</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-span-full text-right mt-4">
                    <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800 transition">Save
                        Changes</button>
                </div>
            </form>
        </div>

    </div>



@endsection