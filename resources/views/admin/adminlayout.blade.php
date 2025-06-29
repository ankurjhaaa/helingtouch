<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome CDN (Latest v6.5.2) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <!-- AOS Library CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

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
   <!-- Overlay for background -->
    <div class="fixed inset-0 bg-white bg-opacity-75 z-[-1]"></div>

   
     <!-- Top Navbar -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white shadow-lg px-4 py-3 flex justify-between items-center sticky top-0 z-50">
        <!-- Left: Toggle Button and Title -->
        <div class="flex items-center space-x-2">
            <!-- Sidebar Toggle Button (Mobile) -->
            <button id="sidebar-toggle" class="sm:hidden text-white bg-blue-600 p-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <!-- Title -->
            <div class="text-lg sm:text-xl font-extrabold flex items-center space-x-2">
                <a href="{{ route('admin.Dashboard') }}" class="flex items-center space-x-2 hover:text-blue-200 transition-colors duration-300">
                    <i class="fas fa-heartbeat text-blue-300 text-base sm:text-lg"></i>
                    <span>Healing Touch</span>
                </a>
            </div>
        </div>

        <!-- Right: Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none group">
                <img src="{{ Auth::check() && Auth::user()->photo && file_exists(storage_path('app/public/' . Auth::user()->photo)) ? asset('storage/' . Auth::user()->photo) : 'https://picsum.photos/40' }}"
                     alt="Profile" class="w-8 h-8 rounded-full object-cover border-2 border-blue-300 shadow-md group-hover:scale-110 transition-transform duration-300">
                <span class="text-xs sm:text-sm font-semibold text-blue-100 group-hover:text-white hidden sm:block">{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4 text-blue-200 group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-36 sm:w-40 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100">
                <a href="{{ route('admin.profile') }}" class="flex items-center px-3 py-2 text-xs sm:text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">
                    <i class="fas fa-user mr-2 text-blue-600"></i> Profile
                </a>
                <a href="#" class="flex items-center px-3 py-2 text-xs sm:text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">
                    <i class="fas fa-cog mr-2 text-blue-600"></i> Settings
                </a>
                <a href="{{ route('auth.logout') }}" class="flex items-center px-3 py-2 text-xs sm:text-sm text-red-600 hover:bg-red-50 hover:text-red-800">
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
    
        <!-- JavaScript -->
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebar-toggle');
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 640 && !sidebar.contains(e.target) && !toggleButton.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
            }
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

        // Counter Animation (for dashboard)
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
</body>
</html>