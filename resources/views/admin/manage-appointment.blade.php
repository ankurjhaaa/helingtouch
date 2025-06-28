@extends('admin.adminlayout')
@section('title', 'manageappointments')
@section('content')
    <!-- Loading Overlay -->
    <div id="loading-overlay"
        class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="loader border-t-4 border-blue-600 rounded-full w-12 h-12 animate-spin"></div>
    </div>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Sidebar Toggle Button (Mobile) -->
        <button id="sidebar-toggle" class="sm:hidden fixed top-4 left-4 z-50 text-white bg-blue-600 p-2 rounded-md">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 space-y-8 ml-0 sm:ml-64 transition-all duration-300">

            <!-- Recent Appointments Table -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Manage Appointments</h2>

                <div
                    class="flex flex-wrap items-center justify-center gap-4 p-4 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-2xl shadow  ">
                    <form action="{{  route('admin.manageappointments')  }}" method="get"
                        class="flex justify-between align-center gap-4 ">
                        <select name="doctor_id" id="doctor_id"
                            class="border border-gray-300 p-2 rounded-md shadow-sm bg-white text-gray-700 text-sm focus:ring-2 focus:ring-blue-400">
                            <option value="">All Doctors</option>
                            @foreach ($doctors as $doc)
                                <option value="{{ $doc->id }}" {{ request('doctor_id') == $doc->id ? 'selected' : '' }}>
                                    Dr. {{ $doc->user->name }}
                                </option>
                            @endforeach

                        </select>

                        <select name="status"
                            class="border border-gray-300 p-2 rounded-md shadow-sm bg-white text-gray-700 text-sm focus:ring-2 focus:ring-blue-400">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                            <option value="rescheduled" {{ request('status') == 'rescheduled' ? 'selected' : '' }}>Rescheduled
                            </option>

                        </select>
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="border border-gray-300 p-2 rounded-md shadow-sm bg-white text-gray-700 text-sm focus:ring-2 focus:ring-blue-400">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow text-sm font-medium transition-all duration-200">Filter</button>
                    </form>
                </div>
                @if(session('success') || session('error'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="fixed top-5 right-5 z-50 mt-10 max-w-sm w-full shadow-lg rounded-md
                               {{ session('success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                               border border-opacity-50 border-green-300 px-4 py-3 mt-10">
                        <div class="flex justify-between items-start space-x-2">
                            <div class="text-sm font-medium">
                                {{ session('success') ?? session('error') }}
                            </div>
                            <button @click="show = false" class="text-lg font-bold leading-none">&times;</button>
                        </div>
                    </div>
                @endif

                <div class="bg-white shadow-lg rounded-xl overflow-x-auto mt-4">
                    <table class="min-w-full text-xs sm:text-sm">
                        <thead class="bg-blue-100 text-left text-blue-900">
                            <tr>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">#</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Patient Name</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Doctor</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Date</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Time</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Status</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $index => $a)

                                <tr class="border-t hover:bg-blue-50 transition-all duration-200">
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $appointments->firstItem() + $index }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $a->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $a->doctor->user->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        {{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}
                                    </td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        {{ \Carbon\Carbon::parse($a->time)->format('h:i A') }}
                                    </td>
                                    @php
                                        $statusClass = match ($a->status) {
                                            'approved' => 'bg-green-100 text-green-600',
                                            'pending' => 'bg-yellow-100 text-yellow-600',
                                            'cancelled' => 'bg-red-100 text-red-600',
                                            'rescheduled' => 'bg-blue-100 text-blue-600',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        <form method="POST" action="{{ route('admin.updatestatus', $a->id) }}">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs px-2 py-1 rounded-full font-medium {{ $statusClass }}">
                                                <option value="approved" {{ $a->status == 'approved' ? 'selected' : '' }}>
                                                    Confirmed</option>
                                                <option value="pending" {{ $a->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="cancelled" {{ $a->status == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled</option>
                                                <option value="rescheduled" {{ $a->status == 'rescheduled' ? 'selected' : '' }}>
                                                    Reschedule</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        <div class="flex gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.editappointments', $a->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded hover:bg-yellow-200 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg> Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.deleteappointments', $a->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded hover:bg-red-200 hover:cursor-pointer transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z" />
                                                    </svg> Delete
                                                </button>
                                            </form>
                                             <a href="{{ route('admin.appointments-receipt', $a->id) }}" target="_blank"
                                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded hover:bg-blue-700 transition">
                                            PDF Receipt
                                        </a>
                                        </div>
                                       


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-1xl font-semibold text-center" colspan="6"> <svg
                                            xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400 mb-4"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-4 4l4 4m0-4l-4 4M5 5h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                        </svg> <span class="font-semibold text-gray-500">No appointments found.</span> </td>
                                </tr>
                            @endforelse






                        </tbody>
                    </table>
                </div>
                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $appointments->appends(request()->query())->links() }}
                </div>
            </section>


            <!-- Footer -->
            <footer class="mt-8 text-center text-xs sm:text-sm text-gray-500">
                © 2025 Healing Touch Hospital. All rights reserved.
            </footer>
        </main>
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

        // Counter Animation
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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


@endsection