<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN (Latest v6.5.2) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Top Navbar -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white shadow-lg px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- Left: Title -->
        <div class="text-2xl font-extrabold text-white flex items-center space-x-3">
            <a href="{{ route('admin.Dashboard') }}" class="flex items-center space-x-2 hover:text-blue-200 transition-colors duration-300">
                <i class="fas fa-heartbeat text-blue-300 text-xl"></i>
                <span>Healing Touch</span>
            </a>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-3 focus:outline-none group">
                <img src="{{ asset('storage/' . Auth::user()->photo ) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-blue-300 shadow-md group-hover:scale-110 group-hover:border-blue-400 transition-transform duration-300" onerror="this.src='https://picsum.photos/40';">
                <span class="text-sm font-semibold text-blue-100 group-hover:text-white transition-colors duration-300">{{ Auth::user()->name }}</span>
                <svg class="w-5 h-5 text-blue-200 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-2xl py-2 z-50 border  border-gray-100">
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-user mr-2 text-blue-600"></i> Profile
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-cog mr-2 text-blue-600"></i> Settings
                </a>
                <a href="{{ route('auth.logout') }}" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-800 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt mr-2 text-red-600"></i> Logout
                </a>
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

    @yield('content')
</body>
</html>