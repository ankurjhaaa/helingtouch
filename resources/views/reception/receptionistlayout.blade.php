<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Top Navbar -->
    <nav class="bg-indigo-700 shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- Left -->
        <div class="text-xl font-bold text-white flex items-center space-x-3">
            <button id="sidebarToggle" class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <a href="{{ route('receptionist.Dashboard') }}">Dashboard</a>
        </div>

        <!-- Right -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <span class="text-sm font-medium text-white">{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div id="user-dropdown"
                class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="{{ route('auth.logout') }}"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-indigo-800 text-white w-64 space-y-6 py-6 px-4 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-40">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold">Receptionist</h1>
                <button onclick="closeSidebar()" class="md:hidden text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('receptionist.Dashboard') }}"
                    class="px-4 py-2 hover:bg-indigo-700 rounded">Dashboard</a>
                <a href="#" class="px-4 py-2 hover:bg-indigo-700 rounded">Appointments</a>
                <a href="#" class="px-4 py-2 hover:bg-indigo-700 rounded">Patients</a>
                <a href="#" class="px-4 py-2 hover:bg-indigo-700 rounded">Messages</a>
                <a href="{{ route('auth.logout') }}"
                    class="px-4 py-2 hover:bg-red-700 text-red-300 rounded">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        const userBtn = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');

        // Sidebar toggle
        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
        }

        // User dropdown
        document.addEventListener('click', (e) => {
            if (!userBtn.contains(e.target)) {
                dropdown.classList.add('hidden');
            } else {
                dropdown.classList.toggle('hidden');
            }
        });
    </script>
</body>

</html>
