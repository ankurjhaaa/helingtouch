@extends('reception.receptionistlayout')
@section('title')
    receptionist-dashboard

@endsection
@section('content')

    <!-- Main Content -->
    <div class="p-1">
        <div class=" p-1">
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start bg-indigo-100 p-6 rounded-lg">
                    <!-- Doctor Image & Name -->
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 rounded-xl border-4 border-[#9b714a] overflow-hidden shadow-md">
                            <img src="{{ $doctorprofile->photo ? asset('storage/' . $doctorprofile->photo) : asset('default/default-user.jpg') }}"
                                alt="Doctor Image" class="w-full h-full object-cover" />
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
                                <p class="font-medium text-green-700">{{ $doctor->fee }}</p>
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
                        @php
                            use Carbon\Carbon;
                            $todayDay = strtolower(Carbon::now()->format('l')); // e.g., 'monday', 'sunday'
                            // Column se value nikalna (dynamic column name)
                            $isAvailableToday = $doctor->$todayDay ?? 0;

                            $availableDay = \App\Models\Doctor::where('user_id', $doctor->user_id)->first();
                            $todayabs = Carbon::today()->toDateString();
                            $onLeavetomorrow = \App\Models\Leave::where('doctor_id', $availableDay->id)->where('leave_date', $todayabs)->where('status', 'approved')->exists();
                        @endphp

                        @if ($isAvailableToday && !$onLeavetomorrow)
                            <span>Appointments for: <span class="text-[#9b714a]">{{ Carbon::today()->format('j F') }}
                                    (Today)</span></span>
                        @else
                            <span>Doctor is Absent Tomorrow <span class="text-[#9b714a]">
                                    | Change Doctor</span></span>
                        @endif


                    </div>
                    <button class="text-sm text-[#9b714a] hover:underline">Change Doctor</button>
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



                <form method="post" action="{{ route('recption.insertAppointment') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Time Selection -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Select Appointment Time (अपॉइंटमेंट का समय चुनें)
                            </label>

                            <button type="button" onclick="document.getElementById('timeModal').classList.remove('hidden')"
                                id="selectedTime"
                                class="group relative w-full px-6 py-3 bg-gradient-to-r from-[#015551] to-[#027a6e] text-white font-semibold text-md rounded-md shadow-md hover:from-[#027a6e] hover:to-[#015551] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#015551] transition-all duration-200">

                                <div class="flex items-center justify-center gap-2">
                                    <!-- Clock Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 text-white group-hover:rotate-6 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <span>Click to select time</span>
                                </div>
                            </button>
                        </div>

                        <input type="hidden" name="time" id="timeInput">
                        <input type="hidden" name="doctor_id" value="{{ $doctor->user_id }}">
                        <input type="hidden" name="date" value="{{ Carbon::today()->format('Y-m-d') }}">
                        <input type="hidden" name="fee" value="{{ $doctor->fee }}">

                        <!-- Form Inputs (same as previous) -->
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Full Name (पूरा नाम)</label>
                            <input type="text" name="name"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Email Address (ईमेल) <span
                                    class="text-sm text-gray-500">(optional) (वैकल्पिक)</span></label>
                            <input type="email" name="email"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('email') }}" required />
                            @error('email')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Phone Number (फ़ोन नंबर)</label>
                            <input type="tel" name="phone"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('phone') }}" maxlength="10" pattern="[6-9]{1}[0-9]{9}" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                placeholder="Enter 10-digit phone number" required />

                            @error('phone')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Select Gender </label>
                            <select name="gender"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551] "
                                value="{{ old('gender') }}">
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
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('age') }}" min="1" max="120" oninput="if(this.value > 120) this.value = 120;"
                                placeholder="Enter age (1–120)" required />

                            @error('age')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-medium text-gray-700 mb-1">Address (पता)</label>
                            <input type="text" name="address"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('address') }}" />
                            @error('address')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">PIN Code (पिन कोड)</label>
                            <input type="text" name="pincode"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('pincode') }}" maxlength="6" pattern="[1-9]{1}[0-9]{5}" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);"
                                placeholder="Enter 6-digit PIN code" required />

                            @error('pincode')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">City (शहर)</label>
                            <input type="text" name="city"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('city') }}" />
                            @error('city')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">State (राज्य)</label>
                            <input type="text" name="state"
                                class="w-full border  rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('state') }}" />
                            @error('state')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Is Paid </label>
                            <select name="ispaid"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551] "
                                value="{{ old('ispaid') }}">
                                <option value="">Is Paid</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>

                            </select>
                            @error('ispaid')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-medium text-gray-700 mb-1">Notes for Doctor (डॉक्टर के लिए नोट्स) <span
                                    class="text-sm text-gray-500">(Optional) (वैकल्पिक)</span></label>
                            <textarea rows="4" name="message"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#015551]"
                                value="{{ old('message') }}"></textarea>
                            @error('message')
                                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('receptionist.Dashboard') }}"
                            class="border border-gray-300 px-6 py-2 rounded flex items-center space-x-1 text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Back</span>
                        </a>

                        @if ($isAvailableToday && !$onLeavetomorrow)
                            <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-700 text-white px-6 py-2 rounded flex items-center space-x-1">
                                <span>Next</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('appointment') }}"
                                class="bg-[#9b714a] hover:bg-[#825c3e] text-white px-6 py-2 rounded flex items-center space-x-1">
                                <span>Change Doctor</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif

                    </div>
                </form>
            </div>

            <!-- Time Selection Modal -->
            <div id="timeModal" class=" hidden fixed inset-0 backdrop-blur-xs bg-white/10  p-5  z-50">
                <div class="flex justify-center items-center mt-20 md:mt-15 lg:my-10">
                    <div class="bg-white p-6 rounded-md shadow-xl w-full max-w-md">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">Select Appointment Time</h2>

                        @php

                            use App\Models\Appointment;

                            $tomorrow = Carbon::today()->toDateString();

                            // Define all time slots
                            $timeSlots = [
                                '10:00 AM',
                                '10:30 AM',
                                '11:00 AM',
                                '11:30 AM',
                                '12:00 PM',
                                '12:30 PM',
                                '01:00 PM',
                                '01:30 PM',
                                '02:00 PM',
                                '02:30 PM',
                                '03:00 PM',
                                '03:30 PM',
                                '04:00 PM',
                                '04:30 PM',
                                '05:00 PM',
                                '05:30 PM',
                            ];

                            // Count how many bookings per slot
                            $slotCounts = [];
                            foreach ($timeSlots as $slot) {
                                $slotCounts[$slot] = Appointment::where('doctor_id', $doctor->user_id)
                                    ->whereDate('date', $tomorrow)
                                    ->where('time', $slot)
                                    ->count();
                            }

                            // Group time slots by time of day
                            $morningSlots = array_slice($timeSlots, 0, 4); // till 11:30 AM
                            $afternoonSlots = array_slice($timeSlots, 4, 8); // 12:00 PM to 03:30 PM
                            $eveningSlots = array_slice($timeSlots, 12); // 04:00 PM onward

                            function renderSlots($slots, $slotCounts)
                            {
                                foreach ($slots as $slot) {
                                    $count = $slotCounts[$slot];
                                    $disabled = $count >= 4;

                                    // Define button colors
                                    $colorClass = match ($count) {
                                        0 => 'bg-[#93cde6] text-[#015551]',
                                        1 => 'bg-yellow-200 text-yellow-900',
                                        2 => 'bg-orange-300 text-orange-900',
                                        3 => 'bg-red-400 text-white',
                                        default => 'bg-gray-300 text-gray-500 cursor-not-allowed',
                                    };

                                    if (!$disabled) {
                                        echo "<button onclick=\"selectTime('{$slot}')\" class=\"time-slot {$colorClass} py-2 px-1 rounded-md transition duration-200\">{$slot} </button>";
                                    } else {
                                        echo "<button disabled class=\"{$colorClass} py-2 px-1 rounded-md cursor-not-allowed\">{$slot}</button>";
                                    }
                                }
                            }
                        @endphp

                        <!-- Morning Section -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                                🌅 <span class="ml-2">Morning (Before 12 PM)</span>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                @php renderSlots($morningSlots, $slotCounts); @endphp
                            </div>
                        </div>

                        <!-- Afternoon Section -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                                ☀️ <span class="ml-2">Afternoon (12 PM – 4 PM)</span>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                @php renderSlots($afternoonSlots, $slotCounts); @endphp
                            </div>
                        </div>

                        <!-- Evening Section -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2 text-sm font-medium text-[#015551]">
                                🌇 <span class="ml-2">Evening (After 4 PM)</span>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                @php renderSlots($eveningSlots, $slotCounts); @endphp
                            </div>
                        </div>

                        <div class="mt-6 text-right">
                            <div class="mb-4 text-sm text-gray-700 text-left">
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block w-4 h-4 rounded bg-[#93cde6] border border-gray-300"></span>
                                        Available
                                    </div>
                                    <span class="hidden sm:inline">-</span>

                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block w-4 h-4 rounded bg-yellow-200 border border-gray-300"></span>
                                        Available (3-4 slots)
                                    </div>
                                    <span class="hidden sm:inline">-</span>

                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block w-4 h-4 rounded bg-orange-300 border border-gray-300"></span>
                                        Filling Up (2 slots)
                                    </div>
                                    <span class="hidden sm:inline">-</span>

                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-4 h-4 rounded bg-red-400 border border-gray-300"></span>
                                        Almost Full (1 slot)

                                    </div>
                                    <span class="hidden sm:inline">-</span>

                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block w-4 h-4 rounded bg-gray-300 border border-gray-300"></span>
                                        Full (0 slots)

                                    </div>
                                </div>
                            </div>

                            <button onclick="document.getElementById('timeModal').classList.add('hidden')"
                                class="text-sm text-gray-600 hover:text-red-500 transition">
                                Cancel
                            </button>
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

    </div>


@endsection