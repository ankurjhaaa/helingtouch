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
            <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Manage Staff</h2>
            @if(session('success') || session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="fixed top-5 right-5 z-50 mt-10 max-w-sm w-full shadow-lg rounded-md {{ session('success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}  border border-opacity-50 border-green-300 px-4 py-3 mt-10">
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
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Staff Name</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Position</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Gender</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Phone</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Salary</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        use App\Models\Revenue;
                        use Illuminate\Support\Carbon;
                        @endphp
                        @forelse($Allstaffs as $Allstaff)
                        @php
                        $year = Carbon::now()->year;
                        $month = Carbon::now()->month;

                        $isPresent = Revenue::where('description', 'staffpaymentid' . $Allstaff->id)
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->exists();
                        @endphp
                        <tr class="border-t hover:bg-blue-50 transition-all duration-200">
                            <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $Allstaff->id }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $Allstaff->name }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $Allstaff->position }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">
                                {{ $Allstaff->gender }}
                            </td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">
                                {{ $Allstaff->phone }}
                            </td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">
                                {{ $Allstaff->fee }}
                            </td>


                            <td class="px-2 sm:px-4 py-2 sm:py-3">
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.insertgivesalary') }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to Pay Salary?');">
                                        @csrf
                                        <input type="hidden" name="description"
                                            value="{{ 'staffpaymentid'.$Allstaff->id }}">
                                        <input type="hidden" name="amount" value="{{ $Allstaff->fee }}">
                                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                        @if ($isPresent)
                                        <div
                                            class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-red-700 text-xs font-semibold rounded hover:bg-red-200 hover:cursor-pointer transition">
                                            Pay Salary
                                        </div>
                                        @else
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded hover:bg-red-200 hover:cursor-pointer transition">
                                            Already Paid
                                        </button>
                                        @endif
                                    </form>

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
        </section>
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