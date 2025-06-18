@extends('admin.adminlayout')
@section('title', 'Admin Settings')
@section('content')
<div class="min-h-screen bg-gray-100 flex justify-center items-start py-10 px-4">
    <div class="w-full max-w-2xl space-y-8">
        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-lg shadow-sm">
                <strong class="font-semibold">Oops! Something went wrong:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Location Settings Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Location Settings</h1>
            <form action="{{ route('admin.seeting.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-600 mb-2">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Address" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                           value="{{ $setting->address ?? '' }}">
                    @error('address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-600 mb-2">Latitude</label>
                        <input type="text" name="latitude" id="latitude" placeholder="Enter Latitude" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                               value="{{ $setting->latitude ?? '' }}">
                        @error('latitude')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-600 mb-2">Longitude</label>
                        <input type="text" name="longitude" id="longitude" placeholder="Enter Longitude" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                               value="{{ $setting->longitude ?? '' }}">
                        @error('longitude')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300 font-medium">
                    Save Location
                </button>
            </form>
        </div>

        <!-- General Information Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">General Information</h1>
            <form action="{{ route('admin.seeting.information') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-2">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                           value="{{ old('name', $setting->name ?? '') }}">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-600 mb-2">Address</label>
                    <textarea name="address" id="address" placeholder="Enter Address" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700 h-24 resize-y">{{ old('address', $setting->address ?? '') }}</textarea>
                    @error('address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-600 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter Phone Number" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                               value="{{ old('phone', $setting->phone ?? '') }}">
                        @error('phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                               value="{{ old('email', $setting->email ?? '') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="visiting_hours" class="block text-sm font-medium text-gray-600 mb-2">Visiting Hours</label>
                    <input type="text" name="visiting_hours" id="visiting_hours" placeholder="Enter Visiting Hours" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700" 
                           value="{{ old('visiting_hours', $setting->visiting_hours ?? '') }}">
                    @error('visiting_hours')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="emergency_available" class="block text-sm font-medium text-gray-600 mb-2">Emergency Available</label>
                    <select name="emergency_available" id="emergency_available" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-gray-50 text-gray-700">
                        <option value="1" {{ old('emergency_available', $setting->emergency_available ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('emergency_available', $setting->emergency_available ?? '') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('emergency_available')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300 font-medium">
                    Save Information
                </button>
            </form>
        </div>
    </div>
</div>
@endsection