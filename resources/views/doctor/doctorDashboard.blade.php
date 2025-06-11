<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Top Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- Left: Title -->
        <div class="text-xl font-bold text-yellow-700 flex items-center space-x-2">
            <!-- <span>👨‍⚕️</span> -->
            <span> Dashboard</span>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <!-- <img src="https://picsum.photos/32" alt="Profile" class="w-8 h-8 rounded-full object-cover border"> -->
                <span class="text-sm font-medium text-gray-700">Dr. Rajeev Singh</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
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


    <div class=" max-w-7xl mx-auto">

        <!-- Greeting -->
        <div class="mb-6 p-4">
            <h2 class="text-2xl font-semibold">Welcome back, Dr. Rajeev 👋</h2>
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

</body>

</html>