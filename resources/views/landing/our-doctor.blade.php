@extends('landing.publiclayout')
@section('title', 'Our Doctors')

@section('content')

    <div class="max-w-6xl mx-auto px-4 py-12 mt-20">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#015551]">Meet Our Expert</h1>
            <p class="mt-3 text-gray-600 text-lg">Browse and consult with highly qualified medical professionals</p>
        </div>

        <!-- Search -->
        <div class="flex justify-center mb-10 mt-10">
            <input type="text" id="searchInput" onkeyup="filterDoctors()"
                class="w-full max-w-4xl sm:w-2/3 lg:w-1/2 border border-gray-300 rounded-md px-6 py-3 shadow-md focus:ring-2 focus:ring-[#015551] focus:outline-none"
                placeholder="Search by name, department, or availability..." />
        </div>

        <!-- Doctor Grid -->
        <div id="doctorList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @forelse ($doctors as $doctor)
                @php
                    $availability = collect(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'])
                        ->filter(fn($day) => $doctor->$day)
                        ->map(fn($d) => ucfirst($d))
                        ->implode(', ');

                    $departmentNames = $doctor->departments?->pluck('name')->join(', ') ?? 'Not Assigned';
                @endphp

                <div class="doctorCard bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 p-6 group"
                    data-name="{{ $doctor->user->name }}" data-department="{{ $departmentNames }}"
                    data-days="{{ $availability }}">
                    <a href="{{  route('landing.doctor', $doctor->id)  }}">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative">
                                <img src="{{ $doctor->user->photo ? asset('storage/' . $doctor->user->photo) : asset('default/default-user.jpg') }}"
                                    alt="{{ $doctor->user->name }}"
                                    class="w-24 h-24 rounded-full border-4 border-[#015551] shadow group-hover:scale-105 transition-transform duration-300">
                                <span
                                    class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>

                            <h3 class="mt-4 text-lg font-bold text-gray-800 group-hover:text-[#015551] transition-colors">
                                Dr. {{ $doctor->user->name }}
                            </h3>

                            <p class="text-sm text-[#015551] font-medium mt-1">{{ $departmentNames }}</p>
                            <p class="text-sm text-gray-500">{{ $doctor->specialization }}</p>

                            <div class="mt-3 bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">
                                Available: {{ $availability }}
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                    <!-- When no doctors available -->
                    <div class="col-span-3 text-center">
                        <div class="inline-block bg-white border border-red-200 rounded-xl p-6 shadow-sm">
                            <div class="text-4xl mb-2 text-red-500">😕</div>
                            <h3 class="text-lg font-semibold text-red-600">No doctors available</h3>
                            <p class="text-sm text-gray-500 mt-1">Please check back later.</p>
                        </div>
                    </div>
                </div>
            @endforelse

        <!-- Not Found Message -->
        <div id="noResults" class="hidden text-center mt-16">
            <div class="inline-block bg-white border border-red-200 rounded-xl p-6 shadow-sm">
                <div class="text-4xl mb-2 text-red-500">😕</div>
                <h3 class="text-lg font-semibold text-red-600">No doctors found</h3>
                <p class="text-sm text-gray-500 mt-1">Try searching with a different name, specialty, or day.</p>
            </div>
        </div>
    </div>

    <script>
        function filterDoctors() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.doctorCard');
            let matchCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const dept = card.getAttribute('data-department').toLowerCase();
                const days = card.getAttribute('data-days').toLowerCase();
                const isMatch = name.includes(input) || dept.includes(input) || days.includes(input);
                card.style.display = isMatch ? 'block' : 'none';
                if (isMatch) matchCount++;
            });

            document.getElementById('noResults').style.display = matchCount === 0 ? 'block' : 'none';
        }
    </script>

@endsection