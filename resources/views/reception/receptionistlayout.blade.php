<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')|{{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN (Latest v6 as of now) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>
    <body class="bg-gray-100 min-h-screen">

          <!-- Top Navbar -->
    <nav class="bg-indigo-700 shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <!-- Left: Title -->
        <div class="text-xl font-bold text-white flex items-center space-x-2">
            <!-- <span>👨‍⚕️</span> -->
            <span> Dashboard</span>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                <!-- <img src="https://picsum.photos/32" alt="Profile" class="w-8 h-8 rounded-full object-cover border"> -->
                <span class="text-sm font-medium text-white">Dr. Rajeev Singh</span>
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="{{ route('auth.logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
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

        
    @section('content')

    @show

</body>

</html>