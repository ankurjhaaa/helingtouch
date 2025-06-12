@extends('doctor.doctorlayout')
@section('title')
   doctordashboard

@endsection
@section('content')

  
    <div class=" max-w-7xl mx-auto">

        <!-- Greeting -->
        <div class="mb-6 p-4">
            <h2 class="text-2xl font-semibold">Welcome back, Dr. {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-600">Here's a quick overview of your activity today.</p>
        </div>

        <div class="p-6 space-y-6">
            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="text-sm font-medium text-gray-500">Today Appointments</h3>
                    <p class="text-2xl font-bold text-yellow-700">12</p>
                </div>
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="text-sm font-medium text-gray-500">Total Patients</h3>
                    <p class="text-2xl font-bold text-yellow-700">278</p>
                </div>
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="text-sm font-medium text-gray-500">New Messages</h3>
                    <p class="text-2xl font-bold text-yellow-700">5</p>
                </div>
                <div class="bg-white p-4 shadow rounded text-center">
                    <h3 class="text-sm font-medium text-gray-500">Upcoming Appointments</h3>
                    <p class="text-2xl font-bold text-yellow-700">6</p>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left: Appointments List -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Today's Appointments</h3>
                    <ul class="divide-y">
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Ritika Sharma</div>
                                <div class="text-sm text-gray-500">10:00 AM • Fever & Weakness</div>
                            </div>
                            <button class="text-blue-600 text-sm hover:underline">View</button>
                        </li>
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Arjun Mehta</div>
                                <div class="text-sm text-gray-500">11:15 AM • Diabetes Followup</div>
                            </div>
                            <button class="text-blue-600 text-sm hover:underline">View</button>
                        </li>
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Sneha Patel</div>
                                <div class="text-sm text-gray-500">12:30 PM • Headache</div>
                            </div>
                            <button class="text-blue-600 text-sm hover:underline">View</button>
                        </li>
                    </ul>
                    <div class="mt-4 text-right">
                        <a href="#" class="text-sm text-yellow-700 hover:underline">View All Appointments →</a>
                    </div>
                </div>

                <!-- Right: Quick Actions -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button
                            class="w-full bg-yellow-600 text-white py-2 px-4 rounded hover:bg-yellow-700 transition">➕
                            Add Prescription</button>
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">📄
                            Add Patient Note</button>
                        <button class="w-full bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-800 transition">📁
                            Upload Report</button>
                    </div>
                </div>

            </div>

            <!-- Calendar or Log Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Calendar/Slots -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Your Schedule</h3>
                    <p class="text-sm text-gray-600">Coming soon: integrated calendar and booking slots.</p>
                    <div class="mt-4 border border-dashed p-4 rounded text-center text-gray-400">
                        📅 Calendar Placeholder
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Recent Activity</h3>
                    <ul class="text-sm space-y-2 text-gray-600">
                        <li>✅ Completed appointment with Ramesh Yadav (Yesterday)</li>
                        <li>📤 Sent report to Sneha Patel</li>
                        <li>📝 Added note for diabetic patient</li>
                        <li>📥 Uploaded test report for Priya Singh</li>
                    </ul>
                </div>

            </div>
        </div>


@endsection