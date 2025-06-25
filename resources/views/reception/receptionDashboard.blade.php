@extends('reception.receptionistlayout')
@section('title')
    receptionist-dashboard

@endsection
@section('content')

    <!-- Main Content -->
    <div class="p-6 space-y-10">

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-indigo-600">{{ $todaypatient }}</div>
                <div class="text-sm text-gray-600">Appointments Today</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-green-600">{{ $completedappointment }}</div>
                <div class="text-sm text-gray-600">Patients Checked In</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $unpaidToday }}</div>
                <div class="text-sm text-gray-600">Pending Payments</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-yellow-600">₹52,300</div>
                <div class="text-sm text-gray-600">Today’s Revenue</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h2 class="text-lg font-semibold mb-3">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button onclick="toggleDoctorModal(true)"
                    class="bg-indigo-600 text-white px-4 py-3 rounded shadow hover:bg-indigo-700 transition duration-200">
                    + New Appointment
                </button>

                <button class="bg-green-600 text-white px-4 py-3 rounded shadow hover:bg-green-700">
                    Add New Patient
                </button>
                <button class="bg-red-600 text-white px-4 py-3 rounded shadow hover:bg-red-700">
                    View Cancelled Appointments
                </button>
            </div>
        </div>
@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mt-2">
        {{ session('success') }}
    </div>
@endif

        <!-- Appointment List -->
<div class="w-full mx-auto ">

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" id="searchAppointment"
            onkeyup="filterAppointmentTable()"
            placeholder="Search by Patient Name or ID..."
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#015551] text-sm"
        />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <h2 class="text-lg font-semibold p-4 border-b">Upcoming Appointments</h2>

        <div class="max-h-[500px] overflow-y-auto">
            <table class="min-w-full text-sm" id="appointmentTable">
                <thead class="bg-gray-100 text-left sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap">#</th>
                        <th class="px-4 py-3 whitespace-nowrap">Patient</th>
                        <th class="px-4 py-3 whitespace-nowrap">Doctor</th>
                        <th class="px-4 py-3 whitespace-nowrap">Time</th>
                        <th class="px-4 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr class="border-t appointment-row"
                            data-id="{{ $appointment->id }}"
                            data-name="{{ strtolower($appointment->name) }}">
                            <td class="px-4 py-2">{{ $appointment->id }}</td>
                            <td class="px-4 py-2">{{ $appointment->name }}</td>
                            <td class="px-4 py-2">Dr. Neha</td>
                            <td class="px-4 py-2">{{ $appointment->time }}</td>
                            @php
                                $status = $appointment->status;
                                $paidstatus = $appointment->ispaid;
                            @endphp

@if($status === 'pending')
    <td class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
    <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this appointment?')">
        @csrf
        <button type="submit" class="text-blue-600 hover:underline">To -  Approve</button>
    </form>
</td>

@elseif($status === 'approved')
    <td class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                @if($paidstatus === 0)
<form action="{{ route('appointments.pay', $appointment->id) }}" method="POST" onsubmit="return confirm('Confirm payment?')">
    @csrf
    <button type="submit" class="text-blue-600 hover:underline">Make Payment</button>
</form>

                                @else

<form action="{{ route('appointments.in_progress', $appointment->id) }}" method="POST" onsubmit="return confirm('Mark this appointment as In Progress?')">
        @csrf
        <button type="submit" class="text-blue-600 hover:underline">To - In Progress</button>
    </form>
                                @endif
    
</td>

@elseif($status === 'completed')
    <td class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                <h2 class="text-blue-600 ">Ab Kuchh Nahi Karna</h2>
                            </td>
@elseif($status === 'cancelled')
    <td class="px-2 py-1 text-xs rounded bg-red-100 text-red-700 ">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">Check-in</button>
                            </td>
@elseif($status === 'rescheduled')
    <td class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">Check-in</button>
                            </td>
@elseif($status === 'in_progress')
    <td class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
    <form action="{{ route('appointments.checkin', $appointment->id) }}" method="POST" onsubmit="return confirm('Mark as checked-in?')">
        @csrf
        <button type="submit" class="text-blue-600 hover:underline">Check-in</button>
    </form>
</td>

@elseif($status === 'checked_in')
    <td class="px-2 py-1 text-xs rounded bg-teal-100 text-teal-700 ">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
    <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST" onsubmit="return confirm('Mark this appointment as completed?')">
        @csrf
        <button type="submit" class="text-blue-600 hover:underline">Complete</button>
    </form>
</td>

@elseif($status === 'no_show')
    <td class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-700 ">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">Check-in</button>
                            </td>
@elseif($status === 'rejected')
    <td class="px-2 py-1 text-xs rounded bg-rose-100 text-rose-700">{{ $appointment->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:underline">Check-in</button>
                            </td>
@else
    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600 capitalize">{{ $status }}</span>
@endif

                            
                        </tr>
                    @endforeach
                       
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function filterAppointmentTable() {
        const input = document.getElementById("searchAppointment").value.toLowerCase();
        const rows = document.querySelectorAll(".appointment-row");

        rows.forEach(row => {
            const name = row.dataset.name;
            const id = row.dataset.id;

            if (name.includes(input) || id.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>

    
   


        <!-- Notifications -->
        <div>
            <h2 class="text-lg font-semibold mb-3">Notifications</h2>
            <ul class="bg-white p-4 rounded shadow space-y-2 text-sm text-gray-700">
                <li>🔔 Patient Ravi Sharma checked in at 11:00 AM</li>
                <li>💬 Payment pending for Simran Kaur</li>
                <li>📅 New appointment created for Dr. Neha</li>
            </ul>
        </div>
    </div>















    <!-- Modal Backdrop -->
<div id="doctorModal" class="fixed inset-0 z-50 bg-black/30 bg-opacity-50 items-center justify-center hidden">
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-6 relative">

        <!-- Close Button -->
        <button onclick="toggleDoctorModal(false)"
            class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>

        <h2 class="text-xl font-semibold mb-4">Select Doctor</h2>

        <!-- Search Input -->
        <input type="text" id="doctorSearch" onkeyup="filterDoctors()" placeholder="Search doctors..."
            class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />

        <!-- Doctor List -->
        <div id="doctorList" class="space-y-3 max-h-[300px] overflow-y-auto">

            @php 
                use Carbon\Carbon;
            @endphp

            @foreach($doctors as $doctor)
                @php
                    $availableDay = \App\Models\Doctor::where('user_id', $doctor->id)->first();
                    $todayDay = strtolower(Carbon::today()->format('l')); // e.g., 'monday', 'sunday'
                    $isAvailableToday = $availableDay->$todayDay ?? 0;

                    $todayabs = Carbon::today()->toDateString();
                    $onLeavetomorrow = \App\Models\Leave::where('doctor_id', $availableDay->id)->where('leave_date', $todayabs)->where('status', 'approved')->exists();
                @endphp

                @if ($isAvailableToday && !$onLeavetomorrow)
                    <a href="{{ route('receptionist.addappointment', $doctor->id) }}" class="flex items-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('default/default-user.jpg') }}"
                            alt="Doctor Image" class="w-10 h-10 rounded-full object-cover mr-3">
                        <div>
                            <p class="font-medium">{{ $doctor->name }}</p>
                            <p class="text-sm text-gray-600">ortho</p>
                        </div>
                    </a>
                @else
                    <a href="#"
                        class="flex items-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('default/default-user.jpg') }}"
                            alt="Doctor Image" class="w-10 h-10 rounded-full object-cover mr-3">
                        <div>
                            <p class="font-medium">{{ $doctor->name }}</p>
                            <p class="text-sm text-gray-600">ortho</p>
                            <p class="text-sm text-red-500">Doctor Absent Today</p>
                        </div>
                    </a>
                @endif

            @endforeach
        </div>
    </div>
</div>

<script>
    function toggleDoctorModal(show) {
        const modal = document.getElementById('doctorModal');
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }

    function filterDoctors() {
        const input = document.getElementById('doctorSearch');
        const filter = input.value.toLowerCase();
        const doctorList = document.getElementById('doctorList');
        const items = doctorList.getElementsByTagName('a');

        for (let i = 0; i < items.length; i++) {
            const text = items[i].textContent.toLowerCase();
            items[i].style.display = text.includes(filter) ? '' : 'none';
        }
    }
</script>

@endsection