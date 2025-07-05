@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')

    <!-- Sidebar -->
    <div class="flex h-screen mt-18 ">
        <div id="sidebar"
            class="bg-yellow-900 text-white w-72 space-y-6 py-7 px-4 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out ">
            <div class="flex justify-between items-center mb-6 mt-14 md:mt-0">
                <a href="{{ route('landing.dashboard') }}" onclick="showLoader()">
                    <h1 class="text-2xl font-bold ">🏥 Patient Panel</h1>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden focus:outline-none ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('landing.dashboard') }}" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Dashboard</a>
                <a href="{{ route('landing.myappointment') }}" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">My Appointments</a>
                <a href="{{ route('landing.userhistory') }}" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Medical
                    Records</a>
                <a href="#" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Prescriptions</a>
                <a href="#" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Messages</a>
                <a href="#" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Settings</a>
                <a href="{{ route('auth.logout') }}" class="px-4 py-2 hover:bg-yellow-800 rounded text-red-300">Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow p-4 flex justify-between items-center md:hidden">
                <button onclick="toggleSidebar()" class="text-yellow-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-yellow-900">Patient Dashboard</span>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <h2 class="text-2xl font-semibold text-yellow-900 mb-4">Welcome, Patient!</h2>
                <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 xl:col-span-2 border border-[#d5bfa5]">
                <h2 class="text-xl md:text-2xl font-bold text-[#5a3921] mb-6"> Your Appointment</h2>

                
                <!-- Appointment Table -->
                <div class="overflow-auto rounded-lg border border-[#d5bfa5] max-h-[650px]">
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


                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            </main>
        </div>
    </div>


@endsection