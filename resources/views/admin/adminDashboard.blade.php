@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

    <!-- Main Content -->
    <div class="p-6 space-y-8">

        <!-- Overview Cards -->
        <section>
            <h2 class="text-xl font-bold mb-4">Overview</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-blue-700">25</div>
                    <div class="text-sm text-gray-600">Doctors</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-green-600">12</div>
                    <div class="text-sm text-gray-600">Receptionists</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-purple-600">18</div>
                    <div class="text-sm text-gray-600">Support Staff</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-yellow-600">102</div>
                    <div class="text-sm text-gray-600">Appointments Today</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-red-600">₹1.5L</div>
                    <div class="text-sm text-gray-600">Today's Revenue</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-indigo-600">7</div>
                    <div class="text-sm text-gray-600">Departments</div>
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section>
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.applyForm') }}" class="bg-blue-600 text-center  text-white py-3 rounded shadow hover:bg-blue-700 transition">➕ Add (Doctor,
                    Staff..)</a>
                    
                <button class="bg-green-600 text-white py-3 rounded shadow hover:bg-green-700 transition">📁 View
                    Reports</button>
                <button class="bg-yellow-500 text-white py-3 rounded shadow hover:bg-yellow-600 transition">📅 Manage
                    Appointments</button>
                <button class="bg-red-600 text-white py-3 rounded shadow hover:bg-red-700 transition">⚙️ Admin
                    Settings</button>
            </div>
        </section>

        <!-- Chart Placeholder -->
        <section>
            <h2 class="text-xl font-bold mb-4">Monthly Revenue</h2>
            <div class="bg-white p-6 rounded shadow">
                <div class="text-center text-gray-400 italic">[ Chart will be placed here - use Chart.js or similar ]
                </div>
            </div>
        </section>

        <!-- Patients Stats -->
        <section>
            <h2 class="text-xl font-bold mb-4">Patient Statistics</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-green-700">458</div>
                    <div class="text-sm text-gray-600">Total Patients</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-orange-600">38</div>
                    <div class="text-sm text-gray-600">New Patients Today</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-blue-600">78%</div>
                    <div class="text-sm text-gray-600">Satisfaction Rate</div>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <div class="text-3xl font-bold text-red-500">12</div>
                    <div class="text-sm text-gray-600">Critical Cases</div>
                </div>
            </div>
        </section>

        <!-- Recent Appointments Table -->
        <section>
            <h2 class="text-xl font-bold mb-4">Recent Appointments</h2>
            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-200 text-left">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Patient Name</th>
                            <th class="px-4 py-2">Doctor</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Rahul Mehta</td>
                            <td class="px-4 py-2">Dr. Sinha</td>
                            <td class="px-4 py-2">11 June 2025</td>
                            <td class="px-4 py-2">10:00 AM</td>
                            <td class="px-4 py-2 text-green-600">Confirmed</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2">Sneha Kumari</td>
                            <td class="px-4 py-2">Dr. Ajay</td>
                            <td class="px-4 py-2">11 June 2025</td>
                            <td class="px-4 py-2">11:30 AM</td>
                            <td class="px-4 py-2 text-yellow-600">Pending</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">3</td>
                            <td class="px-4 py-2">Amit Kumar</td>
                            <td class="px-4 py-2">Dr. Verma</td>
                            <td class="px-4 py-2">11 June 2025</td>
                            <td class="px-4 py-2">12:00 PM</td>
                            <td class="px-4 py-2 text-red-600">Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-10 text-center text-sm text-gray-500">
            &copy; 2025 Healing Touch Hospital. All rights reserved.
        </footer>

    </div>
@endsection