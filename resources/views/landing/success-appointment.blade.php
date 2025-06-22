@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')




    @if(session('appointment'))
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
                            ✓
                        </div>
                        <span class="mt-2 font-medium text-gray-700">Doctor</span>
                    </div>

                    <!-- Line -->
                    <div class="flex-auto border-t-2 border-[#d4b59c] mx-2 sm:mx-3"></div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-[#a77c52] text-white font-semibold shadow">
                            ✓
                        </div>
                        <span class="mt-2 font-medium text-gray-700">Details</span>
                    </div>

                    <!-- Line -->
                    <div class="flex-auto border-t-2 border-[#d4b59c] mx-2 sm:mx-3"></div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-[#a77c52] text-white font-semibold shadow">
                            3
                        </div>
                        <span class="mt-2 font-medium text-gray-700">Review</span>
                    </div>
                </div>
            </div>


            <!-- ------------------------------------  yaha karo niche -------------------------------------- -->
            <div class="max-w-6xl mx-auto mt-10 ">
                <div class="bg-white border-[#e2c7a3] shadow-xl rounded-md overflow-hidden">
                    <div class="px-6 sm:px-10 py-10 text-center">

                        <!-- Animated Badge -->
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div class="absolute inset-0 animate-ping rounded-full bg-green-300 opacity-75"></div>
                                <div
                                    class="relative w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-700 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmation Text -->
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#4a2e1d] tracking-tight">You're All Set!</h1>
                        <p class="mt-2 text-[#715540] text-sm sm:text-base max-w-xl mx-auto">
                            Your appointment has been confirmed successfully. A confirmation email has been sent to your
                            registered ID.
                        </p>

                        <!-- Appointment Card -->
                        <div class="mt-8 bg-white rounded-2xl shadow-inner border border-[#ecdcc3] max-w-xl mx-auto text-left">
                            <div class="grid grid-cols-2 gap-4 p-6 text-sm sm:text-base">
                                <div class="text-[#a77c52] font-medium">Appointment ID</div>
                                <div class="text-[#5b3920] font-bold">#{{ session('appointment')->id }}</div>

                                <div class="text-[#a77c52] font-medium">Date</div>
                                <div class="text-[#5b3920] font-bold">{{ session('appointment')->date }}</div>

                                <div class="text-[#a77c52] font-medium">Time</div>
                                <div class="text-[#5b3920] font-bold">{{ session('appointment')->time }}</div>

                                <div class="text-[#a77c52] font-medium">Doctor</div>
                                <div class="text-[#5b3920] font-bold">Dr. {{ session('appointment')->name }}</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('receipt.download', session('appointment')->id) }}"
                                class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] hover:from-[#916538] hover:to-[#b98960] text-white px-6 py-2 rounded-md font-medium text-sm sm:text-base shadow-lg hover:scale-105 transition">
                                Download Receipt
                            </a>
                            {{-- Role-based Dashboard --}}
                            @if(auth()->user()->role === 'user')
                                <a href="{{ route('home') }}"
                                    class="border-2 border-[#a77c52] text-[#a77c52] hover:bg-[#a77c52] hover:text-white px-6 py-2 rounded-md font-medium text-sm sm:text-base transition shadow-lg">
                                    Back To Home
                                </a>
                            @elseif(auth()->user()->role === 'receptionist')
                                <a href="{{ route('receptionist.Dashboard') }}"
                                    class="border-2 border-[#a77c52] text-[#a77c52] hover:bg-[#a77c52] hover:text-white px-6 py-2 rounded-md font-medium text-sm sm:text-base transition shadow-lg">
                                    Back To Home
                                </a>
                            @else
                                <a href="{{ route('home') }}"
                                    class="border-2 border-[#a77c52] text-[#a77c52] hover:bg-[#a77c52] hover:text-white px-6 py-2 rounded-md font-medium text-sm sm:text-base transition shadow-lg">
                                    Back To Home
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div
            class="bg-orange-50  border-l-4 border-orange-400 text-orange-800 p-6 rounded-xl shadow-md max-w-2xl mx-auto text-center mt-40">
            <div class="flex justify-center mb-4">
                <svg class="h-10 w-10 text-orange-400 animate-bounce" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M21 12c0-4.97-4.03-9-9-9S3 7.03 3 12s4.03 9 9 9 9-4.03 9-9z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold mb-2">Oops! Caught you red-handed 😜</h2>
            <p class="text-sm sm:text-base text-gray-700">
                Lagta hai aap bina appointment book kiye confirmation page pe aagaye ho... <br>
                Time travel to abhi invent nahi hua hai bhai! ⏳😂
            </p>
            <a href="{{ route('home') }}"
                class="mt-5 inline-block px-5 py-2 bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white rounded-full shadow hover:scale-105 transition">
                Go Back Before the Nurse Finds Out 🏃‍♂️💨
            </a>
        </div>

    @endif




@endsection