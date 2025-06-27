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
                <div class="mt-6">
                    <p class="text-gray-600 text-sm mb-1">Add Note To Patient </p>
                    
                    <!-- 📎 Upload Form -->
                    <form action="{{ route('doctor.insertuserhistory') }}" method="post" enctype="multipart/form-data"
                        class=" flex gap-2 p-3 z-50">
                        @csrf
                        <input type="hidden" name="doctorid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="useremail" value="{{ $patientappointdetail->email }}">
                        <!-- File Upload -->
                        <label for="image-upload" class="cursor-pointer text-orange-500 hover:text-orange-700 z-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.586 6.586" />
                            </svg>
                            <input type="file" name="image" id="image-upload" class="hidden" accept="image/*"
                                onchange="previewImage(event)">
                        </label>

                        <!-- Text -->
                        <input type="text" name="chat" placeholder="Type your message..."
                            class="flex-1 border border-orange-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-orange-200 z-50">

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition z-50">
                            Add
                        </button>
                    </form>

                    <!-- ✅ Image Modal -->
                    <div id="image-modal" class="fixed inset-0 bg-black/60 z-10 hidden items-center justify-center">
                        <div class="relative max-w-sm w-full p-4 bg-white rounded-lg shadow-lg">
                            <!-- ❌ Close Button -->
                            <button type="button" onclick="closeImageModal()"
                                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">
                                &times;
                            </button>
                            <img id="preview" src="#" alt="Preview" class="w-full max-h-[80vh] object-contain rounded">
                            
                        </div>
                    </div>

                    <!-- ✅ JavaScript -->
                    <script>
                        function previewImage(event) {
                            const file = event.target.files[0];
                            const preview = document.getElementById('preview');
                            const modal = document.getElementById('image-modal');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    preview.src = e.target.result;
                                    modal.classList.remove('hidden');
                                    modal.classList.add('flex'); // ✅ show modal
                                };
                                reader.readAsDataURL(file);
                            }
                        }

                        function closeImageModal() {
                            const modal = document.getElementById('image-modal');
                            modal.classList.add('hidden');
                            modal.classList.remove('flex'); // ✅ hide modal
                        }
                    </script>
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
                    <a href="{{ route('doctor.dashboard') }}"
                        class="inline-block bg-[#015551] text-white px-5 py-2 rounded hover:bg-[#01403f] transition">
                        Back to List
                    </a>
                </div>

            </div>

        </div>

    </div>



@endsection