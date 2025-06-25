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

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-8 ml-64 transition-all duration-500 animate-fade-in">
            <!-- Overview Cards -->
            <section data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Overview</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-3xl font-bold text-blue-700 count transition-all duration-1000 ease-out"
                            data-target="{{ $doctorCount }}">0</div>
                        <div class="text-sm text-gray-600">Doctors</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-3xl font-bold text-green-600 count" data-target="{{ $countReceptionst }}">0</div>
                        <div class="text-sm text-gray-600">Receptionists</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-3xl font-bold text-purple-600 count" data-target="{{ $totalUsers }}">0</div>
                        <div class="text-sm text-gray-600">Support Staff</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-3xl font-bold text-yellow-600 count" data-target="{{ $countApointments }}">0</div>
                        <div class="text-sm text-gray-600">Appointments Today</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="500">
                        <div class="text-3xl font-bold text-red-600 count" data-target="0">₹0</div>
                        <div class="text-sm text-gray-600">Today's Revenue</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="600">
                        <div class="text-3xl font-bold text-indigo-600 count" data-target="{{ $totalDepartments }}">0</div>
                        <div class="text-sm text-gray-600">Departments</div>
                    </div>
                </div>
            </section>

            <!-- Chart Placeholder -->
            <section data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Monthly Revenue</h2>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="text-center text-gray-400 italic">[ Chart will be placed here - use Chart.js or similar ]
                    </div>
                </div>
            </section>

            <!-- Patients Stats -->
            <section data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Patient Statistics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-3xl font-bold text-green-700">458</div>
                        <div class="text-sm text-gray-600">Total Patients</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-3xl font-bold text-orange-600">38</div>
                        <div class="text-sm text-gray-600">New Patients Today</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-3xl font-bold text-blue-600">78%</div>
                        <div class="text-sm text-gray-600">Satisfaction Rate</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-3xl font-bold text-red-500">12</div>
                        <div class="text-sm text-gray-600">Critical Cases</div>
                    </div>
                </div>
            </section>

            <!-- Recent Appointments Table -->
            <section data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Recent Appointments</h2>
                <div class="bg-white shadow-lg rounded-xl overflow-x-auto">
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
                            <tr class="border-t hover:bg-blue-50 hover:shadow-inner transition-all duration-200"
                                data-aos="fade-right" data-aos-delay="100">
                                <td class="px-4 py-3">1</td>
                                <td class="px-4 py-3">Rahul Mehta</td>
                                <td class="px-4 py-3">Dr. Sinha</td>
                                <td class="px-4 py-3">11 June 2025</td>
                                <td class="px-4 py-3">10:00 AM</td>
                                <td class="px-4 py-3 text-green-600 font-medium">Confirmed</td>
                            </tr>
                            <tr class="border-t hover:bg-blue-50 hover:shadow-inner transition-all duration-200"
                                data-aos="fade-right" data-aos-delay="200">
                                <td class="px-4 py-3">2</td>
                                <td class="px-4 py-3">Sneha Kumari</td>
                                <td class="px-4 py-3">Dr. Ajay</td>
                                <td class="px-4 py-3">11 June 2025</td>
                                <td class="px-4 py-3">11:30 AM</td>
                                <td class="px-4 py-3 text-yellow-600 font-medium">Pending</td>
                            </tr>
                            <tr class="border-t hover:bg-blue-50 hover:shadow-inner transition-all duration-200"
                                data-aos="fade-right" data-aos-delay="300">
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
            <footer class="mt-10 text-center text-sm text-gray-500" data-aos="fade-up" data-aos-duration="800">
                © 2025 Healing Touch Hospital. All rights reserved.
            </footer>
        </main>
    </div>
    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
        });

        // Counter Animation
        document.addEventListener("DOMContentLoaded", function () {
            const counters = document.querySelectorAll('.count');
            counters.forEach(counter => {
                const isRupee = counter.innerText.includes('₹');
                const targetAttr = counter.getAttribute('data-target');
                const target = targetAttr ? parseFloat(targetAttr) : 0;
                let count = 0;
                const duration = 2000; // Animation duration in ms
                const increment = target / (duration / 16); // 60 FPS

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

                // Start counter when element is in viewport
                const observer = new IntersectionObserver(entries => {
                    if (entries[0].isIntersecting) {
                        updateCount();
                        observer.disconnect();
                    }
                });
                observer.observe(counter);
            });

            // Hide loading overlay after page load
            window.addEventListener('load', () => {
                const overlay = document.getElementById('loading-overlay');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.remove(), 500);
            });
        });
    </script>

@endsection