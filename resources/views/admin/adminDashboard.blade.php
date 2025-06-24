@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
   <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-6 space-y-8">
        <!-- Overview Cards -->
        <section>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Overview</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-blue-700">25</div>
                    <div class="text-sm text-gray-600">Doctors</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-green-600">12</div>
                    <div class="text-sm text-gray-600">Receptionists</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-purple-600">18</div>
                    <div class="text-sm text-gray-600">Support Staff</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-yellow-600">102</div>
                    <div class="text-sm text-gray-600">Appointments Today</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-red-600">₹1.5L</div>
                    <div class="text-sm text-gray-600">Today's Revenue</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-indigo-600">7</div>
                    <div class="text-sm text-gray-600">Departments</div>
                </div>
            </div>
        </section>

        <!-- Chart Placeholder -->
        <section>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Monthly Revenue</h2>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center text-gray-400 italic">[ Chart will be placed here - use Chart.js or similar ]</div>
            </div>
        </section>

        <!-- Patients Stats -->
        <section>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Patient Statistics</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-green-700">458</div>
                    <div class="text-sm text-gray-600">Total Patients</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-orange-600">38</div>
                    <div class="text-sm text-gray-600">New Patients Today</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-blue-600">78%</div>
                    <div class="text-sm text-gray-600">Satisfaction Rate</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg text-center transform hover:scale-105 transition-transform">
                    <div class="text-3xl font-bold text-red-500">12</div>
                    <div class="text-sm text-gray-600">Critical Cases</div>
                </div>
            </div>
        </section>

        <!-- Recent Appointments Table -->
        <section>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Recent Appointments</h2>
            <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-blue-100 text-left text-blue-900">
                        <tr>
                            <th class="px-4 py-3 font-semibold">#</th>
                            <th class="px-4 py-3 font-semibold">Patient Name</th>
                            <th class="px-4 py-3 font-semibold">Doctor</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
                            <th class="px-4 py-3 font-semibold">Time</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3">Rahul Mehta</td>
                            <td class="px-4 py-3">Dr. Sinha</td>
                            <td class="px-4 py-3">11 June 2025</td>
                            <td class="px-4 py-3">10:00 AM</td>
                            <td class="px-4 py-3 text-green-600 font-medium">Confirmed</td>
                        </tr>
                        <tr class="border-t hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3">2</td>
                            <td class="px-4 py-3">Sneha Kumari</td>
                            <td class="px-4 py-3">Dr. Ajay</td>
                            <td class="px-4 py-3">11 June 2025</td>
                            <td class="px-4 py-3">11:30 AM</td>
                            <td class="px-4 py-3 text-yellow-600 font-medium">Pending</td>
                        </tr>
                        <tr class="border-t hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3">3</td>
                            <td class="px-4 py-3">Amit Kumar</td>
                            <td class="px-4 py-3">Dr. Verma</td>
                            <td class="px-4 py-3">11 June 2025</td>
                            <td class="px-4 py-3">12:00 PM</td>
                            <td class="px-4 py-3 text-red-600 font-medium">Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-10 text-center text-sm text-gray-500">
            © 2025 Healing Touch Hospital. All rights reserved.
        </footer>
    </main>
</div>
@endsection