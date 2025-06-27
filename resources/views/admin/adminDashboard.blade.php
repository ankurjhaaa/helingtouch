@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')
    <!-- Loading Overlay -->
    <div id="loading-overlay"
        class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="loader border-t-4 border-blue-600 rounded-full w-12 h-12 animate-spin"></div>
    </div>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Sidebar Toggle Button (Mobile) -->
        <button id="sidebar-toggle" class="sm:hidden fixed top-4 left-4 z-50 text-white bg-blue-600 p-2 rounded-md">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 space-y-8 ml-0 sm:ml-64 transition-all duration-300">
            <!-- Overview Cards -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Overview</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-700 count" data-target="{{ $doctorCount }}">0
                        </div>
                        <div class="text-xs sm:text-sm text-gray-600">Doctors</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-green-600 count"
                            data-target="{{ $countReceptionst }}">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Receptionists</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-purple-600 count" data-target="{{ $totalUsers }}">0
                        </div>
                        <div class="text-xs sm:text-sm text-gray-600">Support Staff</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-yellow-600 count"
                            data-target="{{ $countApointments }}">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Appointments Today</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-red-600 count" data-target="0">₹0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Today's Revenue</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-indigo-600 count"
                            data-target="{{ $totalDepartments }}">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Departments</div>
                    </div>
                </div>
            </section>

            <!-- Chart Placeholder -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Monthly Revenue</h2>
                <div class="bg-white p-4 sm:p-6 rounded-xl shadow-lg">
                    <div class="text-center text-gray-400 italic">[ Chart will be placed here - use Chart.js or similar ]
                    </div>
                </div>
            </section>

            <!-- Patient Statistics -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Patient Statistics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-green-700">458</div>
                        <div class="text-xs sm:text-sm text-gray-600">Total Patients</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-orange-600">38</div>
                        <div class="text-xs sm:text-sm text-gray-600">New Patients Today</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-blue-600">78%</div>
                        <div class="text-xs sm:text-sm text-gray-600">Satisfaction Rate</div>
                    </div>
                    <div
                        class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-2xl sm:text-3xl font-bold text-red-500">12</div>
                        <div class="text-xs sm:text-sm text-gray-600">Critical Cases</div>
                    </div>
                </div>
            </section>

            <!-- Recent Appointments Table -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Recent Appointments</h2>
                <div class="bg-white shadow-lg rounded-xl overflow-x-auto">
                    <table class="min-w-full text-xs sm:text-sm">
                        <thead class="bg-blue-100 text-left text-blue-900">
                            <tr>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">#</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Patient Name</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Doctor</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Date</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Time</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $index => $appointment)
                                <tr class="border-t hover:bg-blue-50 transition-all duration-200">
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $index + 1 }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $appointment->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $appointment->doctor->user->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        {{ \carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-green-600 font-medium">
                                        @if ($appointment->status == 'approved')
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Confirmed</span>
                                        @elseif ($appointment->status == 'pending')
                                            <span
                                                class="bg-yellow-100 text-tellow-600 px-2 py-1 rounded-full text-xs">Pending</span>
                                        @elseif ($appointment->status == 'cancelled')
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs">Cancelled</span>
                                        @elseif ($appointment->status == 'rescheduled')
                                            <span  class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">Reschedule</span>



                                        @endif




                                    </td>
                                </tr>

                            @endforeach




                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Footer -->
            <footer class="mt-8 text-center text-xs sm:text-sm text-gray-500">
                © 2025 Healing Touch Hospital. All rights reserved.
            </footer>
        </main>
    </div>
    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- JavaScript -->
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebar-toggle');
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Dropdown Toggle
        const userBtn = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');
        document.addEventListener('click', (e) => {
            if (userBtn.contains(e.target)) {
                dropdown.classList.toggle('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        });

        // Counter Animation
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.count');
            counters.forEach(counter => {
                const isRupee = counter.innerText.includes('₹');
                const targetAttr = counter.getAttribute('data-target');
                const target = targetAttr ? parseFloat(targetAttr) : 0;
                let count = 0;
                const duration = 2000;
                const increment = target / (duration / 16);

                const updateCount = () => {
                    if (count < target) {
                        count += increment;
                        counter.innerText = isRupee
                            ? `₹${Math.ceil(count)}`
                            : Math.ceil(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = isRupee
                            ? `₹${target.toFixed(0)}`
                            : target.toFixed(0);
                    }
                };

                const observer = new IntersectionObserver(entries => {
                    if (entries[0].isIntersecting) {
                        updateCount();
                        observer.disconnect();
                    }
                });
                observer.observe(counter);
            });

            // Hide loading overlay
            window.addEventListener('load', () => {
                const overlay = document.getElementById('loading-overlay');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.remove(), 500);
            });
        });
    </script>

@endsection