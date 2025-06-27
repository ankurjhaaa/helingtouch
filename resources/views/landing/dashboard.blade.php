@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')

    <!-- Sidebar -->
    <div class="flex h-screen mt-18 ">
        <div id="sidebar"
            class="bg-yellow-900 text-white w-72 space-y-6 py-7 px-4 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out ">
            <div class="flex justify-between items-center mb-6 mt-14 md:mt-0">
                <a href="{{ route('landing.dashboard') }}">
                    <h1 class="text-2xl font-bold ">🏥 Patient Panel</h1>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden focus:outline-none ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('landing.dashboard') }}" class="px-4 py-2 hover:bg-yellow-800 rounded">Dashboard</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">My Appointments</a>
                <a href="{{ route('landing.userhistory') }}" class="px-4 py-2 hover:bg-yellow-800 rounded">Medical
                    Records</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Prescriptions</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Messages</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Settings</a>
                <a href="{{ route('auth.logout') }}" class="px-4 py-2 hover:bg-yellow-800 rounded text-red-300">Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow p-4 flex justify-between items-center md:hidden">
                <button onclick="toggleSidebar()" class="text-yellow-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-yellow-900">Patient Dashboard</span>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <h2 class="text-2xl font-semibold text-yellow-900 mb-4">Welcome, Patient!</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow border border-yellow-100">
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Upcoming Appointment</h3>
                        <p class="text-gray-700 text-sm">Next appointment with Dr. Sharma on 28 June at 10:00 AM.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow border border-yellow-100">
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Medical History</h3>
                        <p class="text-gray-700 text-sm">View your past checkups and test reports in one place.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow border border-yellow-100">
                        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Prescriptions</h3>
                        <p class="text-gray-700 text-sm">Download or print the latest prescriptions shared by your doctor.
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>


@endsection