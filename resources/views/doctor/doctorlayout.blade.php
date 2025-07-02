<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800">
     <!-- --------------------------- loder wirl Here ---------------- -->
    <div id="loaderOverlay" class="fixed inset-0 bg-black/30 bg-opacity-40 hidden items-center justify-center z-50">
        <div class="loader border-4 border-white border-t-[#9b714a] rounded-full w-12 h-12 animate-spin"></div>
    </div>
    <script>
        function showLoader() {
            const overlay = document.getElementById('loaderOverlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
    </script>
    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-xl font-bold text-yellow-700 flex items-center gap-3">
            <!-- Sidebar toggle on mobile -->
            <button id="sidebarToggle" class="md:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <a href="{{ route('doctor.dashboard') }}" onclick="showLoader()">Dashboard</a>
        </div>

        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <span class="text-sm font-medium text-gray-700">Dr. {{ Auth::user()->name }}</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50">
                <a href="{{ route('doctor.profile') }}" onclick="showLoader()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="" onclick="showLoader()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="{{ route('auth.logout') }}" onclick="showLoader()" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Layout: Sidebar + Main -->
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-yellow-900 text-white w-64 space-y-6 py-7 px-4 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-40">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">👨‍⚕️ Panel</h1>
                <button onclick="closeSidebar()" class="md:hidden text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('doctor.dashboard') }}" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Dashboard</a>
                <a href="" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Appointments</a>
                <a href="" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Patients</a>
                <a href="{{ route('doctor.leave') }}" onclick="showLoader()" class="px-4 py-2 hover:bg-yellow-800 rounded">Leave</a>
                <a href="{{ route('auth.logout') }}" class="px-4 py-2 hover:bg-yellow-800 rounded text-red-300">Logout</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 min-h-screen p-6">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        const userBtn = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
        }

        document.addEventListener('click', function (e) {
            if (!userBtn.contains(e.target)) {
                dropdown.classList.add('hidden');
            } else {
                dropdown.classList.toggle('hidden');
            }
        });
    </script>
</body>

</html>
