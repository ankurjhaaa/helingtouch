@extends('doctor.doctorlayout')
@section('title')
    doctordashboard

@endsection
@section('content')

    <div class="p-2">
        <div class="max-w-5xl mx-auto mt-10 bg-white shadow-xl  overflow-hidden">
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
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Upload Photo</label>
                        <input type="file"
                            class="mt-1 text-sm file:px-3 file:py-1 file:bg-blue-50 file:border file:border-gray-300 file:rounded file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" placeholder="Dr. A.K. Verma"
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Email (readonly) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" value="doctor@example.com" disabled
                        class="mt-1 w-full border px-4 py-2 rounded bg-gray-100 text-gray-500">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" placeholder="+91 9876543210"
                        class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="col-span-full text-right mt-4">
                    <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800 transition">Save
                        Changes</button>
                </div>
            </form>
        </div>










        <div class="max-w-5xl mx-auto mt-10 bg-white shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Doctor Profile</h2>
    </div>

    <!-- Form -->
    <form class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Department Select -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Department</label>
            <select class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Department --</option>
                <option value="1">Cardiology</option>
                <option value="2">Neurology</option>
                <option value="3">Orthopedics</option>
            </select>
        </div>

        <!-- Qualification -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Qualification</label>
            <input type="text" placeholder="MBBS, MD"
                class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Experience -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Experience (years)</label>
            <input type="number" placeholder="12"
                class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Bio -->
        <div class="col-span-full">
            <label class="block text-sm font-medium text-gray-700">Bio</label>
            <textarea rows="4" placeholder="Short introduction..."
                class="mt-1 w-full border px-4 py-2 rounded focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
        </div>

        <!-- Weekly Availability Checkboxes -->
        <div class="col-span-full">
            <label class="block text-sm font-medium text-gray-700 mb-2">Weekly Availability</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="sunday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Sunday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="monday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Monday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="tuesday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Tuesday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="wednesday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Wednesday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="thursday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Thursday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="friday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Friday</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="available_days[]" value="saturday" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Saturday</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-span-full text-right mt-4">
            <button type="submit"
                class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800 transition">Save
                Changes</button>
        </div>
    </form>
</div>

    </div>



@endsection