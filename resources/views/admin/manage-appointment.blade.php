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
                <div id="root"></div>
               <div class="flex justify-between px-2 py-2 bg-pink-100 rounded-2xl shadow-2xs border-pink-200 ">
                    <form action="" method="get" class="flex flex-wrap gap-4 mb-4">
                        <select name="doctor_id" id="" class="border p-2 rounded">
                            <option value="">All Doctors</option>
                            @foreach ($doctors as $doc)
                                <option value="{{ $doc->id }}" {{ request('doctor_id') == $doc->id ? 'selected' : '' }}>
                                    Dr. {{ $doc->user->name }}
                                </option>
                            @endforeach

                        </select>

                        <select name="status" class="border p-2 rounded">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        <input type="date" name="date" value="{{ request('date') }}" class="border p-2 rounded">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
                    </form>
                </div>

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
                                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-green-600 font-medium">
                                        @if ($a->status == 'approved')
                                            <span
                                                class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Confirmed</span>
                                        @elseif ($a->status == 'pending')
                                            <span
                                                class="bg-yellow-100 text-tellow-600 px-2 py-1 rounded-full text-xs">Pending</span>
                                        @elseif ($a->status == 'cancelled')
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs">Cancelled</span>
                                        @elseif ($a->status == 'rescheduled')
                                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">Reschedule</span>



                                        @endif





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

@endsection