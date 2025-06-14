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
                <a href="#"
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
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#015551] flex items-center space-x-2">
                    <svg class="w-5 h-5 text-[#9b714a]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 10a2 2 0 100-4 2 2 0 000 4zm0 2a7 7 0 00-7 7h2a5 5 0 0110 0h2a7 7 0 00-7-7z" />
                    </svg>
                    <span>Selected Doctor</span>
                </h2>
                <button class="text-[#9b714a] font-medium hover:underline flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span><a href="{{ route('appointment') }}">Change Doctor</a></span>
                </button>
            </div>

            <!-- Content Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start bg-[#f8efe4] p-6 rounded-lg">
                <!-- Doctor Image & Name -->
                <div class="flex flex-col items-center">
                    <div class="w-36 h-36 rounded-xl border-4 border-[#9b714a] overflow-hidden shadow-md">
                        <img src="{{ $doctorprofile->photo ? asset('storage/' . $doctorprofile->photo) : asset('default/default-user.jpg') }}" alt="Doctor Image" class="w-full h-full object-cover" />
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-gray-800">Dr. {{ $doctorprofile->name }}</h3>
                    @php
                        $deptName = \App\Models\Department::find($doctor->department_id)->name ?? 'N/A';
                    @endphp



                    <p class="text-sm text-[#9b714a] font-medium">{{ $deptName }}</p>
                </div>

                <!-- Doctor Info -->
                <div class="col-span-2 space-y-4 text-sm text-gray-800">
                    <div class="flex flex-wrap gap-6">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Qualification</p>
                            <p class="font-medium">{{ $doctor->qualification }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Department</p>
                            <p class="font-medium">{{ $deptName }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Consultation Fee</p>
                            <p class="font-medium text-green-700">₹500</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Available Days</p>
                            <p class="font-medium">
                                @if ($doctor->sunday == 1)
                                    {{ 'Sun,' }}
                                @endif
                                @if ($doctor->monday == 1)
                                    {{ 'Mon,' }}
                                @endif
                                @if ($doctor->tuesday == 1)
                                    {{ 'Tue,' }}
                                @endif
                                @if ($doctor->wednesday == 1)
                                    {{ 'Wed,' }}
                                @endif
                                @if ($doctor->thursday == 1)
                                    {{ 'Thu,' }}
                                @endif
                                @if ($doctor->friday == 1)
                                    {{ 'Fri,' }}
                                @endif
                                @if ($doctor->saturday == 1)
                                    {{ 'Sat,' }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white p-4 rounded-md shadow-sm border border-[#d9c3a9]">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $doctor->bio }}
                        </p>
                    </div>
                </div>
            </div>
        </div>






        <div class="bg-white p-6 rounded-b-lg shadow max-w-6xl mx-auto">
            <!-- Date Selector -->
            <div class="mb-6 flex items-center justify-between border-b pb-4">
                <div class="flex items-center gap-2 text-[#015551] font-semibold text-lg">
                    <svg class="w-5 h-5 text-[#9b714a]" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M6 2a1 1 0 000 2h1v1a1 1 0 002 0V4h2v1a1 1 0 002 0V4h1a1 1 0 100-2H6zM3 7a2 2 0 012-2h10a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm2 0v9h10V7H5z" />
                    </svg>
                    <span>Appointments for: <span class="text-[#9b714a]">14 June (Tomorrow)</span></span>
                </div>
                <button class="text-sm text-[#9b714a] hover:underline">Change Date</button>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('insertAppointment') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Time Selection -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700 mb-1">Select Appointment Time (अपॉइंटमेंट का समय
                            चुनें)</label>
                        <button type="button" onclick="document.getElementById('timeModal').classList.remove('hidden')"
                            class="w-full text-left border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551] bg-gray-50"
                            id="selectedTime">Click to select time</button>
                    </div>
                    <input type="hidden" name="time" id="timeInput">
                    <input type="hidden" name="doctor_id" value="{{ $doctor->user_id }}">
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="fee" value="500">

                    <!-- Form Inputs (same as previous) -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Full Name (पूरा नाम)</label>
                        <input type="text" name="name"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('name')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Email Address (ईमेल) <span
                                class="text-sm text-gray-500">(optional) (वैकल्पिक)</span></label>
                        <input type="email" name="email"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('email')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Phone Number (फ़ोन नंबर)</label>
                        <input type="text" name="phone"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('phone')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Select Gender </label>
                        <select name="gender"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551] ">
                            <option value="">Select Gender (लिंग चुनें)</option>
                            <option value="Male">Male (पुरुष)</option>
                            <option value="Female">Female (महिला)</option>
                            <option value="Other">Other (अन्य)</option>
                        </select>
                        @error('gender')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror

                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Age (उम्र)</label>
                        <input type="number" name="age"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('age')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700 mb-1">Address (पता)</label>
                        <input type="text" name="address"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('address')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">PIN Code (पिन कोड)</label>
                        <input type="text" name="pincode"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('pincode')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">City (शहर)</label>
                        <input type="text" name="city"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('city')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">State (राज्य)</label>
                        <input type="text" name="state"
                            class="w-full border  rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]" />
                        @error('state')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700 mb-1">Notes for Doctor (डॉक्टर के लिए नोट्स) <span
                                class="text-sm text-gray-500">(Optional) (वैकल्पिक)</span></label>
                        <textarea rows="4" name="message"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"></textarea>
                        @error('message')
                            <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('appointment') }}"
                        class="border border-gray-300 px-6 py-2 rounded flex items-center space-x-1 text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                    <button type="submit"
                        class="bg-[#9b714a] hover:bg-[#825c3e] text-white px-6 py-2 rounded flex items-center space-x-1">
                        <span>Next</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Time Selection Modal -->
        <div id="timeModal" class=" hidden fixed inset-0 bg-black bg-opacity-50  p-5  z-50">
            <div class="flex justify-center items-center mt-40">
                <div class="bg-white p-6 rounded-md shadow-xl w-full max-w-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Select Appointment Time</h2>

                    <!-- Morning Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                            🌅 <span class="ml-2">Morning (Before 12 PM)</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <button onclick="selectTime('10:00 AM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">10:00 AM</button>
                            <button onclick="selectTime('10:30 AM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">10:30 AM</button>
                            <button onclick="selectTime('11:00 AM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">11:00 AM</button>
                            <button onclick="selectTime('11:30 AM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">11:30 AM</button>
                        </div>
                    </div>

                    <!-- Afternoon Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                            🌞 <span class="ml-2">Afternoon (12 PM - 4 PM)</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <button onclick="selectTime('12:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">12:00 PM</button>
                            <button onclick="selectTime('12:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">12:30 PM</button>
                            <button onclick="selectTime('1:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">1:00 PM</button>
                            <button onclick="selectTime('1:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">1:30 PM</button>
                            <button onclick="selectTime('2:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">2:00 PM</button>
                            <button onclick="selectTime('2:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">2:30 PM</button>
                            <button onclick="selectTime('3:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">3:00 PM</button>
                            <button onclick="selectTime('3:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">3:30 PM</button>
                        </div>
                    </div>

                    <!-- Evening Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                            🌙 <span class="ml-2">Evening (After 4 PM)</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <button onclick="selectTime('4:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">4:00 PM</button>
                            <button onclick="selectTime('4:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">4:30 PM</button>
                            <button onclick="selectTime('5:00 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">5:00 PM</button>
                            <button onclick="selectTime('5:30 PM')"
                                class="time-slot bg-[#93cde6] text-[#015551] py-1 rounded-md">5:30 PM</button>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button onclick="document.getElementById('timeModal').classList.add('hidden')"
                            class="text-sm text-gray-600 hover:text-red-500 transition">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function selectTime(t) {
                document.getElementById('selectedTime').innerText = t;
                document.getElementById('timeInput').value = t;  // now "appointTime" field set ho jayega
                document.getElementById('timeModal').classList.add('hidden');
            }

        </script>


    </div>


@endsection