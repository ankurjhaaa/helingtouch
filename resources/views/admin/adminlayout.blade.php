<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN (Latest v6.5.2) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <!-- AOS Library CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom Scrollbar */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #1e40af;
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background-color: #dbeafe;
        }

        /* Fade-in Animation */
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }

        /* Loader Animation */
        .loader {
            border-top-color: #2563eb;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Body Background */
        body {
            background: linear-gradient(to bottom, #e5e7eb, #e0f2fe);
            background-image: url('https://images.unsplash.com/photo-1622253692010-333f2b7c2f7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.75); /* Semi-transparent overlay */
            z-index: -1;
        }
    </style>
</head>
<body class="text-gray-800">
    <!-- Top Navbar -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white shadow-lg px-6 py-4 flex justify-between items-center sticky top-0 z-50" data-aos="fade-down" data-aos-duration="800">
        <!-- Left: Title -->
        <div class="text-2xl font-extrabold text-white flex items-center space-x-3">
            <a href="{{ route('admin.Dashboard') }}" class="flex items-center space-x-2 hover:text-blue-200 transition-colors duration-300">
                <i class="fas fa-heartbeat text-blue-300 text-xl"></i>
                <span>Healing Touch</span>
            </a>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative" data-aos="fade-down" data-aos-delay="200">
            <button id="user-menu-button" class="flex items-center space-x-3 focus:outline-none group">
                <img src="{{ Auth::check() && Auth::user()->photo && file_exists(storage_path('app/public/' . Auth::user()->photo)) ? asset('storage/' . Auth::user()->photo) : 'https://picsum.photos/40' }}"
                     alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-blue-300 shadow-md group-hover:scale-110 group-hover:border-blue-400 transition-transform duration-300">
                <span class="text-sm font-semibold text-blue-100 group-hover:text-white transition-colors duration-300">{{ Auth::user()->name }}</span>
                <svg class="w-5 h-5 text-blue-200 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-2xl py-2 z-50 border border-gray-100">
                <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors duration-200">
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

    <!-- Content -->
    <div class="relative z-10 animate-fade-in">
        @yield('content')
    </div>

    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
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
    </script>
</body>
</html>