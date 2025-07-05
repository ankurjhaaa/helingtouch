@extends('doctor.doctorlayout')
@section('title')
    Leave Form
@endsection
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center">
            <div class="w-5/12 p-4">
                <div class="max-w-sm  mt-7 p-6 bg-white border border-gray-200 rounded-lg shadow-sm  ">


                    @if (session('success'))
                        <div id="success-alert"
                            class="flex items-center justify-between p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" onclick="document.getElementById('success-alert').remove();"
                                class="text-green-700 rounded-lg focus:ring-2 focus:ring-green-400 p-1 hover:bg-green-200 dark:hover:bg-green-300 dark:text-green-800">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="error-alert"
                            class="flex items-center justify-between p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                            role="alert">
                            <span>{{ session('error') }}</span>
                            <button type="button" onclick="document.getElementById('error-alert').remove();"
                                class="text-red-700 rounded-lg focus:ring-2 focus:ring-red-400 p-1 hover:bg-red-200 dark:hover:bg-red-300 dark:text-red-800">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif


                    {{-- Leave Form --}}
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Apply For Leave</h5>
                    <p class="mb-5 font-normal text-gray-500 dark:text-gray-400">Please fill out the form below to apply for
                        leave.</p>

                    <form action="{{ route('doctor.leave.store') }}" method="post" class="max-w-sm mx-auto"
                        onsubmit="showLoader()">
                        @csrf
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave
                                Date:</label>
                            <input type="date" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                name="leave_date" value="{{ old('leave_date') }}" />
                            @error('leave_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="reason"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason:</label>
                            <input type="text" id="reason"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                name="reason" value="{{ old('reason') }}" />
                            @error('reason')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Apply For Leave
                        </button>
                    </form>
                </div>

            </div>
            <div class="w-7/12 p-4">
                <div class=" w-full mt-7 p-6 bg-white border border-gray-200 rounded-lg shadow-sm ">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Leave History</h5>
                    <p class="mb-5 font-normal text-gray-500 ">Here you can view your previous leave
                        applications.</p>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reason
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 ">
                                        Requested On
                                    </th>


                                </tr>
                            </thead>
                            <tbody>

                                @forelse($leaves as $index => $leave)


                                    <tr class="bg-white  hover:bg-gray-50 ">

                                        <td class="px-6 py-4">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $leave->leave_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $leave->reason ?? 'No reason provided' }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($leave->status == 'approved')
                                                <span class="text-green-400 font-semibold">✅ Approved</span>
                                            @elseif($leave->status == 'pending')
                                                <span class="text-yellow-400 font-semibold">🕒 Pending</span>
                                            @else
                                                <span class="text-red-400 font-semibold">❌ Rejected</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($leave->created_at)->format('d M Y h:i A') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 px-6 py-4">No leave history available.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>





    <script>
        // Auto-hide after 5 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) successAlert.remove();
            if (errorAlert) errorAlert.remove();
        }, 5000); // 5000 ms = 5 seconds
    </script>

@endsection