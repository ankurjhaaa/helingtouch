@extends('reception.receptionistlayout')
@section('title')
    receptionist-dashboard

@endsection
@section('content')

    <!-- Main Content -->
    <div class="p-1 space-y-10">

        <main class="flex-1 p-4  space-y-8  transition-all duration-300">

            <!-- Recent Appointments Table -->
            <section>
                <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4">Manage Attendance</h2>

                <!-- 🔍 Search Input -->
                <div class="mb-4">
                    <input type="text" id="attendance-search"
                        class="w-full sm:w-1/2 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Search by ID, name, or phone...">
                </div>

                <!-- 📋 Attendance Table -->
                <div class="bg-white shadow-lg rounded-xl overflow-x-auto mt-4">
                    <table class="min-w-full text-xs sm:text-sm" id="attendance-table">
                        <thead class="bg-blue-100 text-left text-blue-900">
                            <tr>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">#</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Staff Name</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Gender</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Phone</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Status</th>
                                <th class="px-2 sm:px-4 py-2 sm:py-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use App\Models\Attendance;
                                use Illuminate\Support\Carbon;
                            @endphp
                            @foreach ($allworkers as $allworker)
                                @php
                                    $today = Carbon::today();
                                    $isPresent = Attendance::where('staffid', $allworker->id)
                                        ->whereDate('created_at', $today)
                                        ->exists();  
                                @endphp

                                <tr class="border-t hover:bg-blue-50 transition-all duration-200">
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $allworker->id }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $allworker->name }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $allworker->gender }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">{{ $allworker->phone }}</td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        {{ $isPresent ? 'Present' : 'Absent' }}
                                    </td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                                        <div class="flex gap-2">
                                            <form action="{{ route('receptionist.makeattendance') }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to Make this Attendance?');">
                                                @csrf
                                                <input type="hidden" name="staffid" value="{{ $allworker->id }}">
                                                <input type="hidden" name="attmaker" value="{{ Auth::user()->id }}">
                                                @if ($isPresent)
                                                    <div
                                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-red-700 text-xs font-semibold rounded hover:bg-red-200 hover:cursor-pointer transition">
                                                        Already Attended
                                                    </div>
                                                @else
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded hover:bg-red-200 hover:cursor-pointer transition">
                                                        Make Attendance
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ✅ Live Search Script -->
            <script>
                document.getElementById('attendance-search').addEventListener('input', function () {
                    const searchText = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#attendance-table tbody tr');

                    rows.forEach(row => {
                        const id = row.children[0].textContent.toLowerCase();
                        const name = row.children[1].textContent.toLowerCase();
                        const phone = row.children[3].textContent.toLowerCase();

                        if (id.includes(searchText) || name.includes(searchText) || phone.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>




        </main>


    </div>

@endsection