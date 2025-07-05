<nav class="bg-white shadow-md px-4 py-3 md:px-6 fixed top-0 left-0 w-full z-50">
    <div class="flex items-center justify-between">
        <!-- Left: Logo and Title -->
        <a href="{{ route('home') }}" onclick="showLoader()">
            <div class="flex items-center space-x-3">
                <!-- Square Image -->
                <img src="{{ asset('storage/logo/logo4.png') }}" alt="Logo"
                    class="w-10 h-10 rounded-3xl object-cover" />

                <!-- Text -->
                <div>
                    <!-- Mobile Short Text -->
                    <div class="font-semibold text-base md:hidden">Healing Touch</div>
                    <div class="text-xs text-gray-500 md:hidden">Purnea</div>

                    <!-- Desktop Full Text -->
                    <div class="hidden md:block">
                        <div class="font-bold text-lg">Healing Touch</div>
                        <div class="text-sm text-gray-500">Hospital (Purnea)</div>
                    </div>
                </div>
            </div>
        </a>


        <!-- Middle: Nav Links (Visible in Desktop) -->
        <ul class="hidden md:flex space-x-6 text-sm font-medium">
            <li><a href="{{ route('home') }}"
                    class="hover:text-yellow-600 {{ request()->routeIs('home') ? 'text-yellow-600 ' : '' }}"
                    onclick="showLoader()">Home</a></li>
            <li><a href="" class="hover:text-yellow-600" onclick="showLoader()">Services</a></li>
            <li><a href="{{ route('landing.our-doctor') }}"
                    class="hover:text-yellow-600 {{ request()->routeIs('landing.our-doctor') ? 'text-yellow-600 ' : '' }}"
                    onclick="showLoader()">Our
                    Doctors</a></li>
            <li><a href="" class="hover:text-yellow-600" onclick="showLoader()">About Us</a></li>
            <li><a href="{{ route('landing.gallery') }}"
                    class="hover:text-yellow-600 {{ request()->routeIs('landing.gallery') ? 'text-yellow-600 ' : '' }}"
                    onclick="showLoader()">Gallery</a></li>
            <li><a href="{{ route('landing.hospital-contact') }}"
                    class="hover:text-yellow-600 {{ request()->routeIs('landing.hospital-contact') ? 'text-yellow-600 ' : '' }}"
                    onclick="showLoader()">Contact</a></li>
            <li class="relative group">

                @auth
                    {{-- Role-based Dashboard --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.Dashboard') }}" class="hover:text-yellow-600 {{ request()->routeIs('admin.Dashboard') ? 'text-yellow-600 ' : '' }}">
                            Dashboard</a>
                    @elseif(auth()->user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" class="hover:text-yellow-600 {{ request()->routeIs('doctor.dashboard') ? 'text-yellow-600 ' : '' }}">
                            Dashboard</a>
                    @elseif(auth()->user()->role === 'user')
                        <a href="{{ route('landing.dashboard') }}" class="hover:text-yellow-600 {{ request()->routeIs('landing.dashboard') ? 'text-yellow-600 ' : '' }}" >
                            Dashboard</a>

                    @elseif(auth()->user()->role === 'receptionist')
                        <a href="{{ route('receptionist.Dashboard') }}" class="hover:text-yellow-600 {{ request()->routeIs('receptionist.Dashboard') ? 'text-yellow-600 ' : '' }}">
                            Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('home') }}/#login" class="hover:text-yellow-600 ">Login</a>
                @endauth

        </ul>
        </li>


        </ul>

        <!-- Right: Book Button + Hamburger Icon -->
        <div class="flex items-center space-x-3">
            <!-- Book Appointment Button (Always Visible) -->
            <a href="{{ route('appointment') }}" onclick="showLoader()"
                class="bg-yellow-700 text-white px-5 py-2 rounded shadow hover:bg-yellow-800 flex items-center space-x-2 text-sm md:text-base">
                <!-- Mobile Icon + Short Text -->
                <span class="md:hidden flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Appointment</span>
                </span>

                <!-- Desktop Full Text -->
                <span class="hidden md:inline">Book Appointment</span>
            </a>


            <!-- Hamburger/X Toggle Button (Mobile Only) -->
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                <svg id="menu-icon" class="w-6 h-6 transition duration-300 ease-in-out" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path id="menu-path" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu"
        class="absolute right-4 top-[64px] w-56 md:hidden bg-white shadow-lg rounded-md py-3 px-4 hidden transition-all duration-300 ease-out">
        <ul class="space-y-2 text-sm font-medium">
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">
                    @auth
                        {{-- Role-based Dashboard --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.Dashboard') }}" class="hover:text-yellow-600">
                                Dashboard</a>
                        @elseif(auth()->user()->role === 'doctor')
                            <a href="{{ route('doctor.dashboard') }}" class="hover:text-yellow-600">
                                Dashboard</a>
                        @elseif(auth()->user()->role === 'user')
                            <a href="{{ route('landing.dashboard') }}" class="hover:text-yellow-600">
                                Dashboard</a>

                        @elseif(auth()->user()->role === 'receptionist')
                            <a href="{{ route('receptionist.Dashboard') }}" class="hover:text-yellow-600">
                                Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('home') }}/#login" class="hover:text-yellow-600">Login</a>
                    @endauth
                </a></li>
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">Services</a></li>
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">Our Doctors</a></li>
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">About Us</a></li>
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">Gallery</a></li>
            <li><a href="#" class="block px-2 py-2 rounded hover:bg-yellow-50">Contact</a></li>

        </ul>
    </div>

    <!-- JavaScript for Toggle & Outside Click -->
    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const menuPath = document.getElementById('menu-path');

        let isOpen = false;

        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('hidden');
            isOpen = !isOpen;

            // Toggle between hamburger and X icon
            if (isOpen) {
                menuPath.setAttribute("d", "M6 18L18 6M6 6l12 12"); // X icon
            } else {
                menuPath.setAttribute("d", "M4 6h16M4 12h16M4 18h16"); // Hamburger icon
            }
        });

        document.addEventListener('click', (e) => {
            if (!menu.contains(e.target) && !toggleBtn.contains(e.target)) {
                menu.classList.add('hidden');
                if (isOpen) {
                    menuPath.setAttribute("d", "M4 6h16M4 12h16M4 18h16");
                    isOpen = false;
                }
            }
        });
    </script>
</nav>