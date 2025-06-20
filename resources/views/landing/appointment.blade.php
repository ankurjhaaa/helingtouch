@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')


    <div class="mt-24 p-2">
        <div class="max-w-6xl mx-auto rounded-md shadow-md bg-white overflow-hidden border border-gray-200">
            <!-- Header -->
            <div
                class="bg-gradient-to-r from-[#c9a27e] to-[#a77c52] px-4 sm:px-6 py-4 flex flex-col sm:flex-row justify-between sm:items-center text-white gap-3 sm:gap-0">

                <!-- Left Side -->
                <div class="text-left leading-tight">
                    <h2 class="text-sm sm:text-lg md:text-xl font-semibold tracking-wide">Book Your Appointment</h2>
                    <p class="text-xs sm:text-sm text-white/80">Schedule your visit with our specialists</p>
                </div>

                <!-- Right Side Link -->
                <a href="{{ route('manageappointments') }}"
                    class="flex items-center gap-1 text-xs sm:text-sm hover:underline text-white justify-start sm:justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Already have an appointment?
                </a>
            </div>

            <!-- Stepper -->
            <div class="flex justify-between items-center px-6 sm:px-10 py-4 bg-[#fdfaf6] text-xs sm:text-sm">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-7 h-7 flex items-center justify-center rounded-full bg-[#a77c52] text-white font-semibold shadow">
                        1
                    </div>
                    <span class="mt-2 font-medium text-gray-700">Doctor</span>
                </div>

                <!-- Line -->
                <div class="flex-auto border-t-2 border-[#d4b59c] mx-2 sm:mx-3"></div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-7 h-7 flex items-center justify-center rounded-full border-2 border-[#a77c52] text-[#a77c52] font-semibold">
                        2
                    </div>
                    <span class="mt-2 font-medium text-gray-700">Details</span>
                </div>

                <!-- Line -->
                <div class="flex-auto border-t-2 border-[#d4b59c] mx-2 sm:mx-3"></div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-7 h-7 flex items-center justify-center rounded-full border-2 border-[#a77c52] text-[#a77c52] font-semibold">
                        3
                    </div>
                    <span class="mt-2 font-medium text-gray-700">Review</span>
                </div>
            </div>
        </div>


        <div class="bg-white p-6 rounded-t-lg shadow-sm border-b border-gray-100 max-w-6xl mx-auto mt-6">
            <!-- Header -->
            <div class="flex items-center gap-3 mb-4">
                <!-- Icon Box -->
                <div class="bg-[#a77c52]/10 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a77c52]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>
                <!-- Title -->
                <div>
                    <h3 class="text-sm sm:text-base font-semibold text-gray-900">Choose Your Department</h3>
                    <p class="text-xs sm:text-sm text-gray-500">Browse from available specialties</p>
                </div>
            </div>

            <!-- Pill Style Toggle Buttons -->
            <div class="flex flex-wrap gap-2">
                <!-- Active -->
                <button
                    class="bg-white border border-[#a77c52] text-[#a77c52] font-semibold text-sm px-5 py-2 rounded-full shadow hover:bg-[#a77c52]/10 transition">
                    All Departments
                </button>

                <!-- Others -->
                @foreach ($departments as $department)
                    <a href=""
                        class="bg-[#f8f8f8] hover:bg-[#f0f0f0] text-gray-700 border border-gray-200 text-sm px-5 py-2 rounded-full transition">
                        {{ $department->name }}
                    </a>

                @endforeach


            </div>
        </div>


        <div class="bg-white p-6 rounded-b-lg shadow-md max-w-6xl mx-auto">
            <h2 class="text-xl font-bold mb-6 text-[#015551] flex items-center space-x-2">
                <svg class="w-5 h-5 text-[#9b714a]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a2 2 0 100-4 2 2 0 000 4zm0 2a7 7 0 00-7 7h2a5 5 0 0110 0h2a7 7 0 00-7-7z" />
                </svg>
                <span>Choose Your Doctor</span>
            </h2>

            @php
                use Carbon\Carbon;
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($doctors as $doctor)
                    @php
                        $availableDay = \App\Models\Doctor::where('user_id', $doctor->id)->first();
                    @endphp
                    <div class="bg-[#f8efe4] rounded-xl p-5 flex flex-col justify-between shadow-md hover:shadow-lg transition">
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-[#9b714a]">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('default/default-user.jpg') }}"
                                    alt="Doctor" class="w-full h-full object-cover" />

                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Dr. {{ $doctor->name }}</h3>
                                @php
                                    $departmentname = \App\Models\Department::where('id', $availableDay->department_id)->first();
                                @endphp
                                <p class="text-sm text-[#9b714a] font-medium">{{ $departmentname->name }}</p>
                            </div>
                        </div>
                        <div class="mt-4 space-x-1">
                            @if ($availableDay->monday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1">Mon</span>
                            @endif
                            @if ($availableDay->tuesday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1">Tue</span>
                            @endif
                            @if ($availableDay->wednesday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1">Wed</span>
                            @endif
                            @if ($availableDay->thursday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1">Thu</span>
                            @endif
                            @if ($availableDay->friday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1">Fri</span>
                            @endif
                            @if ($availableDay->saturday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1 mt-1">Sat</span>
                            @endif
                            @if ($availableDay->sunday == 1)
                                <span class="inline-block bg-[#e0c5a7] text-sm rounded-md px-3 py-1 mt-1">Sun</span>
                            @endif


                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            @php

                                $todayDay = strtolower(Carbon::now()->format('l')); // e.g., 'monday', 'sunday'
                                // Column se value nikalna (dynamic column name)
                                $isAvailableToday = $availableDay->$todayDay ?? 0;
                            @endphp
                            <span class="text-sm text-gray-700 font-semibold">₹{{ $availableDay->fee }}</span>
                            @if ($isAvailableToday == 1)
                                <a href="{{ route('bookAppointment', $doctor->id) }}"
                                    class="bg-[#9b714a] hover:bg-[#835f3d] text-white px-4 py-1.5 rounded-md text-sm">
                                    Select Doctor
                                </a>
                            @else
                                <button class="bg-[#9b714a] hover:bg-[#835f3d] text-white px-4 py-1.5 rounded-md text-sm">
                                    Select Doctor
                                </button>
                            @endif

                        </div>
                        @if ($isAvailableToday == 1)
                            <div class="mt-2 text-sm font-medium text-green-600">
                                Doctor available tomorrow
                            </div>
                        @else
                            <div class="mt-2 text-sm font-medium text-red-500">
                                Doctor absent tomorrow
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>


@endsection