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
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Edit {{ $appointments->name }} Appointment</h2>


                <div
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mx-auto mt-10">


                    <form class="max-w-sm mx-auto" action="{{ route('admin.updateappointments', $appointments->id) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <div class="mb-5">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" id="" name="date"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                                value="{{ $appointments->date }}" />
                                @error('date')
                                  <small class="text-red-700 px-2 py-2 font-semibold">{{  $message  }}</small>
                                @enderror
                        </div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                            Doctor</label>
                        <select id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="doctor_id">
                            <option selected>Choose a Docotor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $appointments->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $doctor->name }}
                                </option>
                            @endforeach
                              @error('doctor_id')
                                  <small class="text-red-700 px-2 py-2 font-semibold">{{  $message  }}</small>
                                @enderror

                        </select>

                        <div class="mb-5">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                Status</label>
                            <select id=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="status">
                                <option value="pending" {{ $appointments->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ $appointments->status == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="cancelled" {{ $appointments->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                                <option value="rescheduled" {{ $appointments->status == 'rescheduled' ? 'selected' : '' }}>
                                    Rescheduled</option>

                            </select>
                              @error('status')
                                  <small class="text-red-700 px-2 py-2 font-semibold">{{  $message  }}</small>
                                @enderror
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                    </form>



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