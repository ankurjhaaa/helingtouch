@extends('reception.receptionistlayout')
@section('title')
    receptionist-dashboard

@endsection
@section('content')

    <!-- Main Content -->
    <div class=" space-y-1">
        <main class="flex-1   space-y-2  transition-all duration-300">
            <div class="min-h-screen bg-gray-100 ">
                <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6 space-y-6">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Patient Info -->
                    <div class="border-b pb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Patient Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div>
                                <strong>Name:</strong> {{ $appointment->name }}
                            </div>
                            <div>
                                <strong>Phone:</strong> +91 {{ $appointment->phone }}
                            </div>
                            <div>
                                <strong>Email:</strong> {{ $appointment->email }}
                            </div>
                            <div>
                                <strong>Gender:</strong> {{ $appointment->gender }}
                            </div>
                            <div>
                                <strong>Age:</strong> {{ $appointment->age }}
                            </div>
                            <div>
                                <strong>Address:</strong> {{ $appointment->address }} , {{ $appointment->city }} ,
                                {{ $appointment->pincode }} , {{ $appointment->state }}
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Info -->
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Appointment Info</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div>
                                <strong>Appointment Date:</strong> {{ $appointment->date }}
                            </div>
                            <div>
                                <strong>Time:</strong> {{ $appointment->time }}
                            </div>
                            <div>
                                <strong>Doctor:</strong> Dr. {{ $appointment->doctor_id }}
                            </div>
                            <div>
                                <strong>Department:</strong> Cardiology
                            </div>
                            <div>
                                <strong>Fee:</strong> {{ $appointment->fee }}
                            </div>
                            <div>
                                <strong>Status:</strong>
                                @if ($appointment->status == 'no_show')
                                    Followed Up
                                @else
                                    {{ $appointment->status }}
                                @endif
                            </div>
                            <div>
                                <strong>Payment Status:</strong>

                                @if ($appointment->ispaid == 0)
                                    Unpaid
                                @elseif($appointment->ispaid == 2)
                                    Follow Up
                                @else
                                    Paid
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-6 justify-end">
                        @if ($appointment->ispaid == 0 && $appointment->status != 'cancelled')
                            <button onclick="openPaymentModal()"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3"></path>
                                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20z"></path>
                                </svg>
                                Make Payment
                            </button>
                        @endif
                        @php
                            $status = $appointment->status;
                            $paidstatus = $appointment->ispaid;
                        @endphp

                        @if($status === 'pending')
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to approve this appointment?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Approve
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.cancle', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to Cancle this appointment?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        X Cancle
                                    </button>
                                </form>
                            </td>


                        @elseif($status === 'approved')

                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.in_progress', $appointment->id) }}" method="POST"
                                    onsubmit="return checkPaymentStatus(event)">
                                    @csrf

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        In-Progress
                                    </button>
                                </form>

                                <script>
                                    function checkPaymentStatus(event) {
                                        const isPaid = {{ $appointment->ispaid ? 'true' : 'false' }};

                                        if (!isPaid) {
                                            alert('Please make the payment first.');
                                            event.preventDefault(); // stop form submit
                                            return false;
                                        }

                                        return confirm('Mark this appointment as In Progress?');
                                    }
                                </script>

                            </td>
                            <button type="button" onclick="toggleModal('{{ $appointment->id }}', true)"
                                class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7v10M16 7v10"></path>
                                    <path d="M3 12h18"></path>
                                </svg>
                                Reschedule
                            </button>
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.cancle', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to Cancle this appointment?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        X Cancle
                                    </button>
                                </form>
                            </td>
                        @elseif($status === 'in_progress')
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.checkin', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Mark as checked-in?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Check-in
                                    </button>
                                </form>
                            </td>
                            <button type="button" onclick="toggleModal('{{ $appointment->id }}', true)"
                                class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7v10M16 7v10"></path>
                                    <path d="M3 12h18"></path>
                                </svg>
                                Reschedule
                            </button>
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.cancle', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to Cancle this appointment?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        X Cancle
                                    </button>
                                </form>
                            </td>

                        @elseif($status === 'checked_in')
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Mark this appointment as completed?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Complete
                                    </button>
                                </form>
                            </td>
                        @elseif($status === 'rescheduled')
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.in_progress', $appointment->id) }}" method="POST"
                                    onsubmit="return checkPaymentStatus(event)">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        In-Progress
                                    </button>
                                </form>
                                <script>
                                    function checkPaymentStatus(event) {
                                        const isPaid = {{ $appointment->ispaid ? 'true' : 'false' }};

                                        if (!isPaid) {
                                            alert('Please make the payment first.');
                                            event.preventDefault(); // stop form submit
                                            return false;
                                        }

                                        return confirm('Mark this appointment as In Progress?');
                                    }
                                </script>
                            </td>
                            <button type="button" onclick="toggleModal('{{ $appointment->id }}', true)"
                                class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7v10M16 7v10"></path>
                                    <path d="M3 12h18"></path>
                                </svg>
                                Reschedule
                            </button>


                        @elseif($status === 'completed')
                            <td class="px-4 py-2">
                                <span
                                    class="px-3 py-1 flex items-center justify-center text-sm rounded bg-green-200 text-gray-600 capitalize">Appointment
                                    Completed</span>
                            </td>
                            <!-- Follow Up Button -->
                            <button onclick="openFollowUpDateModal('{{ $appointment->id }}')"
                                class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 10h.01M12 14h.01M16 10h.01M12 2a10 10 0 100 20 10 10 0 000-20z"></path>
                                </svg>
                                Follow Up
                            </button>
                        @elseif($status === 'cancelled')
                            <td class="px-4 py-2">
                                <span
                                    class="px-3 py-1 flex items-center justify-center text-sm rounded bg-red-200 text-gray-600 capitalize">Appointment
                                    Cancelled </span>
                            </td>

                        @elseif($status === 'no_show')
                            <td class="px-4 py-2">
                                <form action="{{ route('appointments.checkin', $appointment->id) }}" method="POST"
                                    onsubmit="return confirm('Mark as checked-in?')">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Check-in
                                    </button>
                                </form>
                            </td>

                        @else
                            <span
                                class="px-3 py-1 flex items-center justify-center text-sm rounded bg-green-200 text-gray-600 capitalize">Appointment
                                {{ $status }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>


    <!-- ----------------------------------------  Modal For Follow Up ------------------------------------------- -->
    <!-- Follow Up Modal -->
    <div id="followUpModal-{{ $appointment->id }}"
        class="fixed inset-0 bg-black/30 z-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 text-center">Choose a Follow Up Date</h2>

            <form id="followUpForm" action="{{ route('reception.followup', $appointment->id) }}" method="POST"
                onsubmit="return confirm('Confirm Follow Up?')">
                @csrf
                <input type="hidden" name="date" id="followUpSelectedDate">
                <input type="hidden" name="time" id="followUpTimeInput">
                <input type="hidden" name="appointmentid" value="{{ $appointment->id }}">

                <!-- Date Buttons -->
                <div class="grid grid-cols-3 gap-3 mb-4">
                    @php
                        use App\Models\Doctor;
                        use Carbon\Carbon;
                        $doctor = Doctor::where('user_id', $appointment->doctor_id)->first();
                        $today = now();
                        $followupLeaves = $doctor?->leaves->pluck('leave_date')->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))->toArray();
                    @endphp

                    @for($i = 0; $i < 15; $i++)
                        @php
                            $date = $today->copy()->addDays($i);
                            $dayName = strtolower($date->format('l'));
                            $label = $date->format('d M');
                            $value = $date->format('Y-m-d');

                            $isAvailable = optional($appointment->doctor)?->{$dayName} ?? 0;
                            $isOnLeave = in_array($value, $followupLeaves);
                        @endphp

                        @if($isAvailable && !$isOnLeave)
                            <button type="button" onclick="openFollowUpTimeModal('{{ $value }}')"
                                class="px-3 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 text-sm">
                                {{ $label }}
                            </button>
                        @else
                            <button type="button" disabled
                                class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-sm">
                                {{ $label }} (Absent)
                            </button>
                        @endif
                    @endfor
                </div>

                <!-- Selected Time Display -->
                <div class="text-sm mt-2 text-center">
                    Selected Time: <span id="followUpSelectedTime" class="font-semibold text-purple-600">None</span>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeFollowUpModal('{{ $appointment->id }}')"
                        class="px-4 py-2 border rounded mr-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Follow Up Time Modal -->
    <div id="followUpTimeModal" class="hidden fixed inset-0 backdrop-blur-sm bg-white/10 p-5 z-50">
        <div class="flex justify-center items-center mt-20">
            <div class="bg-white p-6 rounded-md shadow-xl w-full max-w-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">Select Follow Up Time</h2>

                @php
                    use App\Models\Appointment;

                    $timeSlots = [
                        '10:00 AM',
                        '10:30 AM',
                        '11:00 AM',
                        '11:30 AM',
                        '12:00 PM',
                        '12:30 PM',
                        '01:00 PM',
                        '01:30 PM',
                        '02:00 PM',
                        '02:30 PM',
                        '03:00 PM',
                        '03:30 PM',
                        '04:00 PM',
                        '04:30 PM',
                        '05:00 PM',
                        '05:30 PM',
                    ];

                    $slotCounts = [];
                    foreach ($timeSlots as $slot) {
                        $slotCounts[$slot] = 0; // placeholder
                    }

                    $morningSlots = array_slice($timeSlots, 0, 4);
                    $afternoonSlots = array_slice($timeSlots, 4, 8);
                    $eveningSlots = array_slice($timeSlots, 12);
                @endphp

                <!-- Morning -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-purple-700">🌅 Morning</div>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ($morningSlots as $slot)
                            <button onclick="selectFollowUpTime('{{ $slot }}')"
                                class="bg-purple-100 text-purple-800 py-2 px-2 rounded-md hover:bg-purple-200">
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Afternoon -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-purple-700">☀️ Afternoon</div>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ($afternoonSlots as $slot)
                            <button onclick="selectFollowUpTime('{{ $slot }}')"
                                class="bg-purple-100 text-purple-800 py-2 px-2 rounded-md hover:bg-purple-200">
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Evening -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-purple-700">🌇 Evening</div>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ($eveningSlots as $slot)
                            <button onclick="selectFollowUpTime('{{ $slot }}')"
                                class="bg-purple-100 text-purple-800 py-2 px-2 rounded-md hover:bg-purple-200">
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="text-right">
                    <button onclick="document.getElementById('followUpTimeModal').classList.add('hidden')"
                        class="text-sm text-gray-600 hover:text-red-500 transition">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openFollowUpDateModal(id) {
            document.getElementById('followUpModal-' + id).classList.remove('hidden');
            document.getElementById('followUpModal-' + id).classList.add('flex');
        }

        function closeFollowUpModal(id) {
            document.getElementById('followUpModal-' + id).classList.add('hidden');
            document.getElementById('followUpModal-' + id).classList.remove('flex');
        }

        function openFollowUpTimeModal(date) {
            document.getElementById('followUpSelectedDate').value = date;
            document.getElementById('followUpTimeModal').classList.remove('hidden');
        }

        function selectFollowUpTime(time) {
            document.getElementById('followUpSelectedTime').innerText = time;
            document.getElementById('followUpTimeInput').value = time;
            document.getElementById('followUpTimeModal').classList.add('hidden');
            document.getElementById('followUpForm').submit();
        }
    </script>


    <!-- ----------------------------------------  Modal For Reshedule ------------------------------------------- -->
    <!-- Modal: Date Picker -->
    <div id="modal-{{ $appointment->id }}"
        class="fixed inset-0 bg-black/30 bg-opacity-40 z-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 text-center">Choose a New Date</h2>

            <form id="rescheduleForm" action="{{ route('reception.resedule', $appointment->id) }}" method="POST"
                onsubmit="return confirm('Confirm Reschedule?')">
                @csrf

                <!-- Hidden inputs -->
                <input type="hidden" name="date" id="selectedDate">
                <input type="hidden" name="time" id="timeInput">

                <!-- Date Buttons -->
                <div class="grid grid-cols-3 gap-3 mb-4">
                    @php


                        $dayKeys = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                        $today = now();
                        $doctor = Doctor::where('user_id', $appointment->doctor_id)->first();
                        $doctorLeaveDates = $doctor?->leaves
                            ->pluck('leave_date')
                            ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
                            ->toArray();
                    @endphp

                    @for($i = 0; $i < 15; $i++)
                        @php
                            $date = $today->copy()->addDays($i);
                            $dayName = strtolower($date->format('l'));
                            $label = $date->format('d M');
                            $value = $date->format('Y-m-d');

                            $isAvailable = optional($appointment->doctor)?->{$dayName} ?? 0;
                            $isOnLeave = in_array($value, $doctorLeaveDates);
                        @endphp

                        @if($isAvailable && !$isOnLeave)
                            <button type="button" onclick="openTimeModal('{{ $value }}')"
                                class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                {{ $label }}
                            </button>
                        @else
                            <button type="button" disabled
                                class="px-3 py-2 bg-gray-200 text-gray-500 rounded cursor-not-allowed text-sm">
                                {{ $label }} (Absent)
                            </button>
                        @endif
                    @endfor
                </div>

                <!-- Selected Time Display -->
                <div class="text-sm mt-2 text-center">
                    Selected Time: <span id="selectedTime" class="font-semibold text-blue-600">None</span>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="toggleModal('{{ $appointment->id }}', false)"
                        class="px-4 py-2 border rounded mr-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Time Selection Modal -->
    <div id="timeModal" class="hidden fixed inset-0 backdrop-blur-sm bg-white/10 p-5 z-50">
        <div class="flex justify-center items-center mt-20">
            <div class="bg-white p-6 rounded-md shadow-xl w-full max-w-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">Select Appointment Time</h2>

                @php


                    $timeSlots = [
                        '10:00 AM',
                        '10:30 AM',
                        '11:00 AM',
                        '11:30 AM',
                        '12:00 PM',
                        '12:30 PM',
                        '01:00 PM',
                        '01:30 PM',
                        '02:00 PM',
                        '02:30 PM',
                        '03:00 PM',
                        '03:30 PM',
                        '04:00 PM',
                        '04:30 PM',
                        '05:00 PM',
                        '05:30 PM',
                    ];

                    $slotCounts = [];
                    foreach ($timeSlots as $slot) {
                        $slotCounts[$slot] = Appointment::where('doctor_id', $appointment->doctor_id)

                            ->count();
                    }

                    $morningSlots = array_slice($timeSlots, 0, 4);
                    $afternoonSlots = array_slice($timeSlots, 4, 8);
                    $eveningSlots = array_slice($timeSlots, 12);

                    function renderSlots($slots, $slotCounts)
                    {
                        foreach ($slots as $slot) {
                            $count = $slotCounts[$slot];
                            $disabled = $count >= 4;
                            $colorClass = match ($count) {
                                0 => 'bg-[#93cde6] text-[#015551]',
                                1 => 'bg-yellow-200 text-yellow-900',
                                2 => 'bg-orange-300 text-orange-900',
                                3 => 'bg-red-400 text-white',
                                default => 'bg-[#93cde6] text-[#015551]',
                            };
                            echo "<button onclick=\"selectTime('{$slot}')\" class=\"time-slot {$colorClass} py-2 px-1 rounded-md transition duration-200\">{$slot}</button>";

                        }
                    }
                @endphp

                <!-- Morning -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-[#015551]">🌅 Morning (Before 12 PM)</div>
                    <div class="grid grid-cols-3 gap-3">
                        @php renderSlots($morningSlots, $slotCounts); @endphp
                    </div>
                </div>

                <!-- Afternoon -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-[#015551]">☀️ Afternoon (12 PM – 4 PM)</div>
                    <div class="grid grid-cols-3 gap-3">
                        @php renderSlots($afternoonSlots, $slotCounts); @endphp
                    </div>
                </div>

                <!-- Evening -->
                <div class="mb-4">
                    <div class="mb-2 text-sm font-medium text-[#015551]">🌇 Evening (After 4 PM)</div>
                    <div class="grid grid-cols-3 gap-3">
                        @php renderSlots($eveningSlots, $slotCounts); @endphp
                    </div>
                </div>

                <div class="text-right">
                    <button onclick="document.getElementById('timeModal').classList.add('hidden')"
                        class="text-sm text-gray-600 hover:text-red-500 transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleModal(id, show) {
            const modal = document.getElementById('modal-' + id);
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function openTimeModal(date) {
            document.getElementById('selectedDate').value = date;
            document.getElementById('timeModal').classList.remove('hidden');
        }

        function selectTime(t) {
            document.getElementById('selectedTime').innerText = t;
            document.getElementById('timeInput').value = t;
            document.getElementById('timeModal').classList.add('hidden');

            // Auto-submit form
            document.getElementById('rescheduleForm').submit();
        }
    </script>




    <!-- ------------------------------------------------- payment wala popup online ya offline ----------------------------------- -->
    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-black/30 bg-opacity-50 z-50 hidden" style="display: none;">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-[90%] max-w-sm text-center">
                <h3 class="text-lg font-semibold mb-4">Choose Payment Method</h3>

                <!-- Offline Payment Form -->
                <form action="{{ route('appointments.pay', $appointment->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
                        Pay Offline
                    </button>
                </form>

                <!-- Online Payment -->
                <button id="rzp-button1"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition mb-2">
                    Pay Online
                </button>
                <form action="{{ route('payment') }}" method="POST" hidden id="payment-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                    <input type="hidden" name="description" value="{{ $appointment->id }}">
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                </form>
                <script>
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": {{ $appointment->fee * 100 }}, // Laravel me ₹ ko paise me convert karke bhej rahe
                        "currency": "INR",
                        "name": "Healing Touch",
                        "description": "For Appoint - {{ $appointment->name }}",
                        "image": "https://picsum.photos/80?random=2",
                        "handler": function (response) {
                            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                            document.getElementById('payment-form').submit();
                        },
                        "theme": {
                            "color": "#6366f1"
                        }
                    };

                    var rzp1 = new Razorpay(options);
                    document.getElementById('rzp-button1').onclick = function (e) {
                        rzp1.open();
                        e.preventDefault();
                    }
                </script>
                <!-- Cancel Button -->
                <button onclick="closePaymentModal()" class="text-gray-500 hover:text-red-600 text-sm mt-2">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openPaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'block';
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'none';
        }

        function handleOnlinePayment() {
            closePaymentModal();
            alert("Redirecting to online payment gateway...");
            Optionally: window.location.href = "{{ route('appointments.pay', $appointment->id) }}";
        }
    </script>
@endsection