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
                @foreach($doctors as $doctor)
                    <a href="{{ route('receptionist.addappointment', $doctor->id) }}"
                        class="flex items-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('default/default-user.jpg') }}"
                            alt="Doctor Image" class="w-10 h-10 rounded-full object-cover mr-3">
                        <div>
                            <p class="font-medium">{{ $doctor->name }}</p>
                            <p class="text-sm text-gray-600">ortho</p>
                        </div>
                    </a>
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