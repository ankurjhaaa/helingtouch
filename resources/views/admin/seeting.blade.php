@extends('admin.adminlayout')
@section('title', 'Admin Settings')
@section('content')
<div class="max-w-lg mx-auto p-6 mt-7 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Settings</h1>
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4">
            <strong class="font-bold">Oops!</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.seeting.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" name="address" id="address" placeholder="Address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $setting->address ?? '' }}">
            @error('address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $setting->latitude ?? '' }}">
            @error('latitude')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $setting->longitude ?? '' }}">
            @error('longitude')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">Save</button>
    </form>
</div>


@endsection