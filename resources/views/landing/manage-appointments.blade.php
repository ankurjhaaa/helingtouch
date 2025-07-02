@extends('landing.publiclayout')
@section('title', 'Our Doctors')

@section('content')

    <div class="mt-24 px-2 md:px-6 lg:px-10">
        <div class="max-w-8xl mx-auto py-5 ">
            <div class="bg-gradient-to-tr from-[#c9a27e] to-[#a77c52] px-6 sm:p-8 rounded-md shadow-xl text-white ">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <!-- Text Content -->
                    <div class="p-3">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-1 tracking-wide">Search Your Appointment Here</h2>
                        <p class="text-sm sm:text-base text-white/90">View, reschedule, or create appointments effortlessly
                        </p>
                    </div>



                </div>
            </div>
        </div>




        <div class="max-w-8xl mx-auto  grid grid-cols-1 xl:grid-cols-3 gap-6 font-sans ">

            <!-- Left Panel -->
            <div
                class="bg-white rounded-2xl shadow-md p-6 sm:p-8 xl:col-span-1 flex flex-col justify-between border border-[#d5bfa5]">
                <div class="space-y-6 text-center">
                    <div
                        class="mx-auto w-20 h-20 bg-gradient-to-br from-[#a77c52] to-[#c9a27e] rounded-full flex items-center justify-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10m-7 4h4m5-10H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-[#5a3921]">Schedule Your Visit</h2>
                    <p class="text-[#7d5a3d] text-sm">Plan your appointment with top specialists in just a few clicks.</p>
                    <button
                        class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white px-6 py-2 rounded-full shadow hover:scale-105 transition-transform text-sm md:text-base">
                        + Book Appointment
                        @if(session('successs'))
                            <p class="text-green-600">{{ session('successs') }}</p>
                        @endif

                        @if(session('error'))
                            <p class="text-red-600">{{ session('error') }}</p>
                        @endif
                    </button>
                </div>

                <div class="mt-10 bg-[#fffaf2] border border-[#e0c9aa] rounded-xl p-4 shadow-sm">
                    <h3 class="text-sm font-semibold text-[#5a3921] mb-2">Why Choose Us?</h3>
                    <ul class="space-y-2 text-sm text-[#7d5a3d] list-disc list-inside">
                        <li>Experienced & trusted doctors</li>
                        <li>Premium wooden-themed interface</li>
                        <li>Seamless online booking experience</li>
                    </ul>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 xl:col-span-2 border border-[#d5bfa5]">
                <h2 class="text-xl md:text-2xl font-bold text-[#5a3921] mb-6">Find Your Appointment</h2>

                <form action="" method="get" onsubmit="showLoader()">
                    <!-- Search Controls -->
                    <div class="flex flex-col sm:flex-row sm:items-end gap-4 mb-6">
                        <div class="flex-grow relative">
                            <input type="text" name="findappointment" value="{{ old('findappointment') }}"
                                class="w-full border border-[#d5bfa5] bg-[#fff8ee] text-[#5a3921] rounded-md py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-[#a77c52] placeholder-[#a78b6d]"
                                placeholder="Enter phone or email...">
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white px-5 py-2 rounded-md shadow hover:scale-105 transition-transform text-sm md:text-base">
                            Search
                        </button>
                    </div>
                </form>
                <!-- Appointment Table -->
                <div class="overflow-auto rounded-lg border border-[#d5bfa5] max-h-[350px]">
                    <table class="w-full min-w-[600px] text-sm text-left text-[#5a3921]">
                        <thead class="bg-[#f5e8d9] text-sm">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Ref ID</th>
                                <th class="px-4 py-3 font-semibold">Date & Time</th>
                                <th class="px-4 py-3 font-semibold">Doctor</th>
                                <th class="px-4 py-3 font-semibold">Status</th>
                                <th class="px-4 py-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody id="appointmentBody" class="bg-[#fffaf2] divide-y divide-[#ead6b9]">



                            <!-- Dummy rows -->
                            <!-- Row 1 -->
                            @forelse ($allappointments as $allappointment)
                                <tr data-phone="{{ $allappointment->phone }}" data-email="{{ $allappointment->email }}">

                                    <td hidden>{{ $allappointment->phone }}</td>
                                    <td hidden>{{ $allappointment->email }}</td>
                                    <td class="px-4 py-3">#{{ $allappointment->id }}</td>
                                    <td class="px-4 py-3">{{ $allappointment->date }}<br><span
                                            class="text-xs text-[#a78b6d]">{{ $allappointment->time }}</span></td>
                                    <td class="px-4 py-3">Dr. Charly Kumar Sinha<br><span
                                            class="text-xs text-[#a77c52]">Surgeon</span></td>
                                    <td class="px-4 py-3"><span
                                            class="bg-[#f3e4c9] text-[#a77c52] text-xs font-semibold px-3 py-1 rounded-full">{{ $allappointment->status }}</span>
                                    </td>
                                    <td class="px-4 py-3 space-x-3">

                                        <!-- Edit Button -->
                                        <button type="button"
                                            class="text-yellow-500 hover:text-yellow-600 hover:underline font-medium cursor-pointer transition-colors duration-200"
                                            onclick="openModal('openappointment-{{ $allappointment->id }}')">
                                            View
                                        </button>

                                        <a href="{{ route('receipt.download', $allappointment->id) }}"
                                            class="text-[#7d5a3d] hover:underline">Download</a>
                                        @if ($allappointment->status != 'cancelled')
                                            <form action="{{ route('landing.insertotp', $allappointment->id) }}" method="post"
                                                onsubmit="showLoader()">
                                                @csrf
                                                <button
                                                    class="text-[#ff0404] hover:underline font-medium cursor-pointer transition">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif


                                    </td>
                                </tr>



                                <!-- ---------------------------------- niche recipt view dikha raha hu appoinment me selcted appoint ment ka ----------------------------- -->
                                <!-- Modal -->
                                <div id="openappointment-{{ $allappointment->id }}"
                                    class="fixed inset-0 z-50 items-center justify-center bg-black/30 backdrop-blur-sm p-2"
                                    style="display: none;">
                                    <div
                                        class="bg-white rounded-xl shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 relative">

                                        <div class="text-center mb-4">
                                            <h2 class="text-xl font-semibold text-gray-800">HealingTouch Hospital

                                            </h2>
                                            <p class="text-sm text-gray-500">Excellence in Healthcare</p>
                                        </div>

                                        <!-- Status + Appointment ID -->
                                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg mb-4">
                                            <div>
                                                <p class="text-sm text-gray-500">Appointment ID</p>
                                                <p class="text-lg font-semibold text-gray-800">{{ $allappointment->id }}</p>
                                            </div>
                                            <span class="px-3 py-1 bg-red-100 text-red-600 text-sm font-medium rounded-full">
                                                {{ $allappointment->status }}
                                            </span>
                                        </div>

                                        <!-- Amount + Queue -->
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div class="bg-gray-50 p-3 rounded-lg text-center">
                                                <p class="text-sm text-gray-500">Amount Paid</p>
                                                <p class="text-lg font-bold text-green-600">₹0.00</p>
                                                <p class="text-xs text-gray-400">(Due)</p>
                                            </div>
                                            <div class="bg-gray-50 p-3 rounded-lg text-center">
                                                <p class="text-sm text-gray-500">Queue Number</p>
                                                <p class="text-lg font-bold text-yellow-600">#{{ $allappointment->id }}</p>
                                            </div>
                                        </div>

                                        <!-- Patient & Doctor Info -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                            <!-- Patient Info -->
                                            <div class="border rounded-lg p-3">
                                                <p class="text-sm font-semibold text-gray-700 mb-1">Patient Information
                                                </p>
                                                <p class="text-sm"><strong>Full Name:</strong> {{ $allappointment->name }}</p>
                                                <p class="text-sm"><strong>Patient ID:</strong> #{{ $allappointment->id }}</p>
                                                <p class="text-sm"><strong>Gender:</strong> {{ $allappointment->gender }}</p>
                                                <p class="text-sm"><strong>Contact:</strong> {{ $allappointment->phone }}</p>
                                            </div>
                                            <!-- Doctor Info -->
                                            <div class="border rounded-lg p-3">
                                                <p class="text-sm font-semibold text-gray-700 mb-1">Doctor Information
                                                </p>
                                                <p class="text-sm"><strong>Doctor Name:</strong> Dr. Ankur Jha
                                                </p>
                                                <p class="text-sm"><strong>Department:</strong> Surgeon</p>
                                                <p class="text-sm"><strong>Consultation Fee:</strong> ₹500.00</p>
                                            </div>
                                        </div>

                                        <!-- Appointment Schedule -->
                                        <div class="bg-yellow-50 p-4 rounded-lg mb-4">
                                            <p class="text-sm font-semibold text-gray-700 mb-1">Appointment Schedule</p>
                                            <div class="grid grid-cols-3 text-sm text-gray-700">
                                                <div><strong>Date:</strong><br>{{ $allappointment->date }}</div>
                                                <div><strong>Day:</strong><br>Friday</div>
                                                <div><strong>Reporting Time:</strong><br>{{ $allappointment->time }}</div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-2">
                                            <button onclick="closeModal('openappointment-{{ $allappointment->id }}')"
                                                class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                Close
                                            </button>
                                            <a href="{{ route('receipt.download', $allappointment->id) }}"
                                                class="px-4 py-2 rounded-md bg-yellow-800 text-white hover:bg-yellow-700 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Download Receipt
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function openModal(id) {
                                        document.getElementById(id).style.display = 'flex';
                                    }

                                    function closeModal(id) {
                                        document.getElementById(id).style.display = 'none';
                                    }
                                </script>

                            @empty

                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------------------- niche otp verify dikha raha hu appoinment me selcted appoint ment ka ----------------------------- -->
    @if(session('success'))
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
            <div class="bg-white/90 backdrop-blur-lg border border-gray-200 shadow-2xl rounded-2xl w-full max-w-sm p-6">

                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="bg-red-100 text-red-600 rounded-full p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 9v2m0 4v.01m0 0h.01M12 20.5a8.5 8.5 0 100-17 8.5 8.5 0 000 17z" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-bold text-center text-gray-800 mb-2">OTP Verification {{ session('success') }}</h2>
                <p class="text-sm text-center text-gray-600 mb-4">Enter the 6-digit OTP sent to your mobile number.</p>

                <!-- Error Message -->
                <p id="otp-error" class="text-red-500 text-center text-sm mb-3 hidden">Please enter all 4 digits</p>

                <!-- OTP Form -->
                <form action="{{ route('landing.verifyotp', session('success')) }}" method="POST"
                    onsubmit="return validateOTP()">
                    @csrf
                    <div class="flex justify-center gap-2 mb-4">
                        <input type="text" maxlength="1" name="otp1"
                            class="otp-input w-10 h-12 text-center border border-gray-500 rounded-lg text-lg focus:ring-2 focus:ring-red-400 focus:outline-none" />
                        <input type="text" maxlength="1" name="otp2"
                            class="otp-input w-10 h-12 text-center border border-gray-500 rounded-lg text-lg focus:ring-2 focus:ring-red-400 focus:outline-none" />
                        <input type="text" maxlength="1" name="otp3"
                            class="otp-input w-10 h-12 text-center border border-gray-500 rounded-lg text-lg focus:ring-2 focus:ring-red-400 focus:outline-none" />
                        <input type="text" maxlength="1" name="otp4"
                            class="otp-input w-10 h-12 text-center border border-gray-500 rounded-lg text-lg focus:ring-2 focus:ring-red-400 focus:outline-none" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center mt-6">
                        <button type="button" class="text-sm text-gray-500 hover:text-gray-700 transition">Resend OTP</button>
                        <button id="verify-btn" type="submit"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg font-medium shadow-md transition opacity-50 cursor-not-allowed"
                            disabled>
                            Verify
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const otpInputs = document.querySelectorAll('.otp-input');
            const verifyBtn = document.getElementById('verify-btn');
            const errorText = document.getElementById('otp-error');

            otpInputs.forEach((input, idx) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && idx < otpInputs.length - 1) {
                        otpInputs[idx + 1].focus();
                    }
                    checkOtpFilled();
                });
            });

            function checkOtpFilled() {
                let filled = 0;
                otpInputs.forEach(inp => {
                    if (inp.value.trim() !== '') filled++;
                });

                if (filled === 4) {
                    verifyBtn.disabled = false;
                    verifyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    errorText.classList.add('hidden');
                } else {
                    verifyBtn.disabled = true;
                    verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

            function validateOTP() {
                let complete = true;
                otpInputs.forEach(inp => {
                    if (inp.value.trim() === '') complete = false;
                });

                if (!complete) {
                    errorText.classList.remove('hidden');
                    return false;
                }

                return true;
            }
        </script>

    @endif

@endsection