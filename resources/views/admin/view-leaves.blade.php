@extends('admin.adminlayout')
@section('title')
    View Leaves
@endsection
@section('content')

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar Component -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 overflow-x-hidden">
            <div
                class=" w-2xl ms-[350px] mt-7 p-4 text-center bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2  text-3xl font-semibold text-gray-900 dark:text-white">View Leave request Here</h5>
                <div id="info-alert"
                    class="flex items-center justify-between p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800"
                    role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0zM9 8a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm1 2a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>This is an informational message. Please take note.</span>
                    </div>
                    <button type="button" onclick="document.getElementById('info-alert').remove();"
                        class="text-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 0 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>



                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th scope="col" class="px-6 py-3">
                                    Doctor
                                </th>
                                <th scope="col " class="px-6 py-3">
                                    Leave Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Reason
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaves as $leave)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Dr. {{ $leave->doctor->user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{  $leave->leave_date  }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($leave->reason)
                                            {{ $leave->reason }}
                                        @else
                                            <span class="text-gray-500">No reason yet</span>
                                        @endif

                                    </td>
                                    <td class="px-6 py-4">
                                        @if($leave->status == 'pending')
                                            <form method="POST" action="{{ route('admin.leave.approve', $leave->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="">--Select--</option>
                                                    <option value="approved" class="text-green-700">Approve</option>
                                                    <option value="rejected" class="text-red-900">Reject</option>
                                                </select>
                                            </form>
                                        @else
                                            {{ ucfirst($leave->status) }}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>





            </div>
    </div>
    </main>
    </div>

    <script>
        setTimeout(() => {
            const infoAlert = document.getElementById('info-alert');
            if (infoAlert) infoAlert.remove();
        }, 5000);
    </script>
    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
        });

        // File Preview
        document.getElementById('fileUpload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const filePreview = document.getElementById('filePreview');
            const imagePreview = document.getElementById('imagePreview');
            const videoPreview = document.getElementById('videoPreview');
            const videoSource = document.getElementById('videoSource');

            // Reset previews
            imagePreview.classList.add('hidden');
            videoPreview.classList.add('hidden');
            filePreview.classList.add('hidden');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (file.type.startsWith('image/')) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        filePreview.classList.remove('hidden');
                    } else if (file.type === 'video/mp4') {
                        videoSource.src = e.target.result;
                        videoPreview.load();
                        videoPreview.classList.remove('hidden');
                        filePreview.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Form Submission (Client-side demo)
        document.getElementById('galleryForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const spinner = submitButton.querySelector('.fa-spinner');
            submitButton.disabled = true;
            spinner.classList.remove('hidden');

            // Simulate form submission
            setTimeout(() => {
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                alert('Gallery updated successfully! (Demo)');
            }, 1500);
        });

        // Hide loading overlay after page load
        window.addEventListener('load', () => {
            const overlay = document.getElementById('loading-overlay');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.remove(), 500);
        });
    </script>


@endsection