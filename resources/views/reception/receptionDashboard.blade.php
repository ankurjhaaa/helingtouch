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
                <div class="text-2xl font-bold text-indigo-600">43</div>
                <div class="text-sm text-gray-600">Appointments Today</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-green-600">28</div>
                <div class="text-sm text-gray-600">Patients Checked In</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-blue-600">5</div>
                <div class="text-sm text-gray-600">Pending Payments</div>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-yellow-600">₹52,300</div>
                <div class="text-sm text-gray-600">Today’s Revenue</div>
            </div>
        </div>

        <!-- Appointment List -->
        <div>
            <h2 class="text-lg font-semibold mb-3">Upcoming Appointments</h2>
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Patient</th>
                            <th class="px-4 py-2">Doctor</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Ravi Sharma</td>
                            <td class="px-4 py-2">Dr. Neha</td>
                            <td class="px-4 py-2">11:00 AM</td>
                            <td class="px-4 py-2 text-green-600">Confirmed</td>
                            <td class="px-4 py-2"><button class="text-blue-600 hover:underline">Check-in</button>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2">Simran Kaur</td>
                            <td class="px-4 py-2">Dr. Ajay</td>
                            <td class="px-4 py-2">11:30 AM</td>
                            <td class="px-4 py-2 text-yellow-600">Pending</td>
                            <td class="px-4 py-2"><button class="text-blue-600 hover:underline">Confirm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h2 class="text-lg font-semibold mb-3">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button class="bg-indigo-600 text-white px-4 py-3 rounded shadow hover:bg-indigo-700">
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


@endsection