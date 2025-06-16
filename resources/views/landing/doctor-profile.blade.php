@extends('landing.publiclayout')
@section('title', 'Doctor Profile')
@section('content')
    <div class="max-w-6xl mx-auto px-4 py-12 mt-20 bg-gradient-to-br from-yellow-50 to-teal-100 rounded-xl shadow-lg">
        <!-- Doctor Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-teal-900 tracking-tight">Dr. {{ $doctor->user->name }}</h1>
            <p class="text-lg text-teal-600 mt-2">{{ $doctor->qualification ?? 'N/A' }}</p>
        </div>

        <!-- Doctor Info and Appointment Section -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 mb-12">
            <div class="flex items-center space-x-6">
                <img src="{{ $doctor->user->photo ? asset('storage/' . $doctor->user->photo) : asset('default/default-user.jpg') }}"
                    alt="{{ $doctor->user->name }}" class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-teal-500 shadow-lg object-cover">
                <div class="text-left">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Dr. {{ $doctor->user->name }}</h2>
                    <p class="text-sm md:text-base text-teal-600 font-medium">{{ $doctor->departments?->pluck('name')->join(', ') ?? 'Not Assigned' }}</p>
                    <p class="text-sm md:text-base text-gray-600 mt-1">Experience: {{ $doctor->experience ?? 'N/A' }}</p>
                    <p class="text-sm md:text-base text-gray-600">Fees: {{ $doctor->fee ? '$' . $doctor->fee : 'Not Specified' }}</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                    class="bg-teal-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-teal-700 transition-all duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-semibold">Book Appointment</span>
                </a>
            </div>
        </div>

        <!-- Doctor Details Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Bio and Status -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-teal-900 mb-4">About Dr. {{ $doctor->user->name }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ $doctor->bio ?? 'No bio available.' }}</p>
                <p class="mt-4 text-sm text-gray-500">Status: 
                    <span class="font-medium {{ $doctor->status ? 'text-green-600' : 'text-red-600' }}">
                        {{ $doctor->status ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p class="text-sm text-gray-500 mt-2">Joining Date: {{ $doctor->created_at?->format('M d, Y') ?? 'N/A' }}</p>
                <p class="text-sm text-gray-500">Last Updated: {{ $doctor->updated_at?->format('M d, Y') ?? 'N/A' }}</p>
            </div>

            <!-- Availability Schedule -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-teal-900 mb-4">Availability</h3>
                <ul class="space-y-2">
                    <li class="flex justify-between text-gray-600">
                        <span>Sunday:</span>
                        <span class="font-medium {{ $doctor->sunday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->sunday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Monday:</span>
                        <span class="font-medium {{ $doctor->monday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->monday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Tuesday:</span>
                        <span class="font-medium {{ $doctor->tuesday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->tuesday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Wednesday:</span>
                        <span class="font-medium {{ $doctor->wednesday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->wednesday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Thursday:</span>
                        <span class="font-medium {{ $doctor->thursday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->thursday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Friday:</span>
                        <span class="font-medium {{ $doctor->friday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->friday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                    <li class="flex justify-between text-gray-600">
                        <span>Saturday:</span>
                        <span class="font-medium {{ $doctor->saturday ? 'text-green-600' : 'text-red-600' }}">
                            {{ $doctor->saturday ? 'Available' : 'Unavailable' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection