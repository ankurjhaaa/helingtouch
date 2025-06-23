@extends('doctor.doctorlayout')
@section('title')
    doctordashboard

@endsection
@section('content')

    <div class="p-2">
        <div class="max-w-5xl mx-auto mt-4 bg-white shadow-xl overflow-hidden">
            <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md mt-10">
                @if(session('success'))
                    <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('info'))
                    <div class="mt-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                        {{ session('info') }}
                    </div>
                @endif

                <h2 class="text-2xl font-semibold text-[#015551] mb-6">Patient Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600 text-sm">Full Name</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->id }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Email</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Phone</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Gender</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->gender }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Age</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->age }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Date</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->date }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Time</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->time }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Status</p>
                        <span
                            class="inline-block px-2 py-1 text-sm rounded bg-green-100 text-green-700">{{ $patientappointdetail->status }}</span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Payment Status</p>

                        @if($patientappointdetail->ispaid)
                            <span class="inline-block px-2 py-1 text-sm rounded bg-green-100 text-green-700">
                                Paid
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 text-sm rounded bg-yellow-100 text-yellow-800">
                                Unpaid
                            </span>
                        @endif
                    </div>

                </div>

                <hr class="my-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">City</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->city }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">State</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->state }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Pincode</p>
                        <p class="font-medium text-base">{{ $patientappointdetail->pincode }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-gray-600 text-sm mb-1">Message / Symptoms</p>
                    <div class="p-4 bg-gray-100 rounded text-gray-700">
                        {{ $patientappointdetail->message ?: 'N.A.' }}

                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-4 flex-wrap">
                    <form action="{{ url('/doc/appointments/' . $patientappointdetail->id . '/complete') }}" method="POST"
                        onsubmit="return confirm('Mark this appointment as completed?')">
                        @csrf
                        <button type="submit"
                            class="inline-block bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                            Mark as Complete
                        </button>
                    </form>




                    <!-- Back to List Button -->
                    <a href="{{ route('doctor.dashboard') }}" class="inline-block bg-[#015551] text-white px-5 py-2 rounded hover:bg-[#01403f] transition">
                        Back to List
                    </a>
                </div>

            </div>

        </div>

    </div>



@endsection