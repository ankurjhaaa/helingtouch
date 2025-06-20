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

                <!-- Search Controls -->
                <div class="flex flex-col sm:flex-row sm:items-end gap-4 mb-6">


                    <div class="flex-grow relative">
                        <input type="text" id="searchInput"
                            class="w-full border border-[#d5bfa5] bg-[#fff8ee] text-[#5a3921] rounded-md py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-[#a77c52] placeholder-[#a78b6d]"
                            placeholder="Enter phone or email...">


                    </div>

                    <button
                        class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white px-5 py-2 rounded-md shadow hover:scale-105 transition-transform text-sm md:text-base">
                        Search
                    </button>
                </div>

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
                                        <button class="text-[#ff0404] hover:underline font-medium cursor-pointer transition"
                                            onclick="openModal('otp-modal-{{ $allappointment->id }}')">
                                            Cancel
                                        </button>

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


                                <!-- ---------------------------------- niche otp verify dikha raha hu appoinment me selcted appoint ment ka ----------------------------- -->
                                <div id="otp-modal-{{ $allappointment->id }}"
                                    class="fixed inset-0 z-50 items-center justify-center bg-black/30 backdrop-blur-sm p-2"
                                    style="display: none;">
                                    <div
                                        class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6 relative">

                                        <!-- Header -->
                                        <div class="text-center mb-6">
                                            <h2 class="text-xl font-semibold text-red-600">Cancel Appointment</h2>
                                            <p class="text-sm text-gray-500">Enter the OTP sent to your mobile to confirm
                                                cancellation.</p>
                                        </div>

                                        <!-- OTP Form -->
                                        <form>
                                            <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Enter
                                                OTP {{ $allappointment->id }}</label>
                                            <input type="text" id="otp" name="otp"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
                                                placeholder="6-digit OTP">

                                            <!-- Submit & Cancel -->
                                            <div class="mt-6 flex justify-end gap-3">
                                                <button type="button"
                                                    onclick="closeModal('otp-modal-{{ $allappointment->id }}')"
                                                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                    Close
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-500">
                                                    Confirm Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    function openModal(id) {
                                        const modal = document.getElementById(id);
                                        modal.style.display = 'flex';
                                    }

                                    function closeModal(id) {
                                        const modal = document.getElementById(id);
                                        modal.style.display = 'none';
                                    }
                                </script>




                                <!-- niche table me name se search kar raha hai all appointmnt ko  -->
                                <script>
                                    function filterTable() {
                                        const input = document.getElementById("searchInput").value.toLowerCase().trim();
                                        const rows = document.querySelectorAll("#appointmentBody tr");

                                        rows.forEach(row => {
                                            const phone = row.dataset.phone?.toLowerCase() || '';
                                            const email = row.dataset.email?.toLowerCase() || '';

                                            if (phone.includes(input) || email.includes(input)) {
                                                row.style.display = ""; // show matching row
                                            } else {
                                                row.style.display = "none"; // hide others
                                            }
                                        });
                                    }

                                    // Add real-time search on keyup
                                    document.getElementById("searchInput").addEventListener("keyup", filterTable);
                                </script>

                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection