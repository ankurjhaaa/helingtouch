<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Top Navbar -->
    <nav class="bg-blue-800 text-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- Left: Title -->
        <div class="text-xl font-bold text-white flex items-center space-x-2">
            <!-- <span>👨‍⚕️</span> -->
            <span> Dashboard</span>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <!-- <img src="https://picsum.photos/32" alt="Profile" class="w-8 h-8 rounded-full object-cover border"> -->
                <span class="text-sm font-medium text-white">Admin Ankur</span>
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Script for Dropdown Toggle -->
    <script>
        const userBtn = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');

        document.addEventListener('click', (e) => {
            if (userBtn.contains(e.target)) {
                dropdown.classList.toggle('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    


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
                <button class="bg-blue-600 text-white py-3 rounded shadow hover:bg-blue-700 transition">➕ Add (Doctor,
                    Staff..)</button>
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
</body>

</html>