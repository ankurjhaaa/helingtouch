@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')
    <div class="flex flex-col md:flex-row h-[calc(100vh-5rem)] mt-18">

        <!-- 🟤 Sidebar -->
        <div id="sidebar"
            class="bg-yellow-900 text-white w-72 md:w-72 space-y-6 py-5 px-4 fixed md:static inset-y-0 left-0 z-40 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('landing.dashboard') }}">
                    <h1 class="text-2xl font-bold">🏥 Patient Panel</h1>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('landing.dashboard') }}" class="px-4 py-2 hover:bg-yellow-800 rounded">Dashboard</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">My Appointments</a>
                <a href="{{ route('landing.userhistory') }}" class="px-4 py-2 hover:bg-yellow-800 rounded">Medical
                    Records</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Prescriptions</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Messages</a>
                <a href="#" class="px-4 py-2 hover:bg-yellow-800 rounded">Settings</a>
                <a href="{{ route('auth.logout') }}" class="px-4 py-2 hover:bg-yellow-800 rounded text-red-300">Logout</a>
            </nav>
        </div>

        <!-- 🟠 Main Section -->
        <div
            class="flex-1 relative md:ml-72 bg-[url('https://www.transparenttextures.com/patterns/wood-pattern.png')] bg-cover bg-center">

            <!-- 🔼 Mobile Header -->
            <header
                class="bg-white shadow p-4 flex justify-between items-center md:hidden fixed top-0 left-0 right-0 z-50 h-20">
                <button onclick="toggleSidebar()" class="text-yellow-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="font-bold text-yellow-900">Patient Dashboard</span>
            </header>

            <!-- 🧾 Chat Area -->
            <main class="h-full relative pt-4 px-2 sm:px-5 lg:px-10 pb-16">
                <!-- Scrollable Chat Box -->
                <div
                    class="absolute top-0 bottom-16 left-0 right-0 overflow-y-auto p-4 flex flex-col-reverse space-y-reverse space-y-4 backdrop-blur-sm bg-white/60">

                    {{-- 🧠 Your chat loop --}}
                    @foreach ($userchats as $userchat)
                        @if (is_null($userchat->image))
                            <!-- More Dummy Chat -->
                            <div class="relative ms-6">
                                <span class="absolute -start-5 top-1 w-8 h-8 rounded-full ring-4 ring-white">
                                    <img src="https://i.pravatar.cc/40?img=8" alt="" class="rounded-full">
                                </span>
                                <div class="bg-white border border-orange-200 rounded-lg px-4 py-3 shadow text-sm text-gray-800">
                                    <div class="font-semibold text-orange-800">
                                        @if (is_null($userchat->doctorid))
                                            You
                                        @elseif($userchat->doctorid === 0)
                                            Hospital
                                        @else
                                            @php
                                                $doctorname = \App\Models\User::find($userchat->doctorid);
                                            @endphp
                                            Doctor : {{ $doctorname->name }}
                                        @endif

                                    </div>
                                    <div class="text-xs text-gray-500 mb-1">{{ $userchat->created_at->diffForHumans() }}</div>
                                    <div>
                                        @if($userchat->doctorid === 0)
                                            @php
                                                $Appointment = \App\Models\Appointment::find($userchat->chat);
                                            @endphp
                                            Hi {{ Auth::user()->name }}, You Booked New Appointment , Patient Name is
                                            {{ $Appointment->name }} , Age = {{ $Appointment->age }} , Appointmant Date is :
                                            {{ $Appointment->date }} And Appoint Time is : {{ $Appointment->time }} , Gender :
                                            {{ $Appointment->gender }} , Fee : {{ $Appointment->fee }} , Address :
                                            {{ $Appointment->address }} , {{ $Appointment->pincode }} , {{ $Appointment->city }} ,
                                            {{ $Appointment->state }} And State is {{ $Appointment->status }} ||
                                            {{ $userchat->created_at }}
                                            <a href="{{ route('receipt.download', $Appointment->id) }}"
                                                class="inline-flex items-center gap-2 bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition text-sm font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                                </svg>
                                                Recipt
                                                <!-- 📥 Download Icon -->
                                            </a>

                                        @else

                                        @endif

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative ms-6">
                                <span class="absolute -start-5 top-1 w-8 h-8 rounded-full ring-4 ring-white">
                                    <img src="https://i.pravatar.cc/40?img=8" alt="" class="rounded-full">
                                </span>
                                <div class="bg-white border border-orange-200 rounded-lg px-4 p-3 shadow text-sm text-gray-800">
                                    <div class="font-semibold text-orange-800">
                                        @if (is_null($userchat->doctorid))
                                            You
                                        @elseif($userchat->doctorid === 0)
                                            Hospital
                                        @else
                                            @php
                                                $doctorname = \App\Models\User::find($userchat->doctorid);
                                            @endphp
                                            Doctor : {{ $doctorname->name }}
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 mb-1">{{ $userchat->created_at->diffForHumans() }}</div>

                                    <!-- Clickable image -->
                                    <div class="mt-1">
                                        <img src="{{ $userchat->image ? asset('storage/' . $userchat->image) : asset('default/default-user.jpg') }}"
                                            alt="shared" class="rounded-lg border cursor-pointer hover:opacity-90 transition"
                                            onclick="openImageModal('{{ $userchat->image ? asset('storage/' . $userchat->image) : asset('default/default-user.jpg') }}')" />
                                    </div>

                                    <div class="mt-2">{{ $userchat->chat }} || {{ $userchat->created_at }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <!-- 📝 Input Form -->
                <form action="{{ route('landing.insertuserhistory') }}" method="post" enctype="multipart/form-data"
                    class="absolute bottom-0 left-0 right-0 bg-white border-t border-orange-200 flex gap-2 p-3 z-50">
                    @csrf

                    <!-- 📎 File Upload with Thumbnail Preview -->
                    <div class="relative">
                        <label for="image-upload" class="cursor-pointer text-orange-500 hover:text-orange-700 block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 10-5.656-5.656l-6.586 6.586" />
                            </svg>
                            <input type="file" name="image" id="image-upload" class="hidden" accept="image/*"
                                onchange="showSelectedThumbnail(event)">
                        </label>

                        <!-- 🔍 Thumbnail Preview -->
                        <img id="thumbnail-preview" src="#" alt="Preview"
                            class="w-8 h-15 rounded-md absolute -top-15 -right-3 hidden ring-2 ring-orange-300 object-cover" />
                    </div>

                    <!-- 💬 Message Input -->
                    <input type="text" name="chat" placeholder="Type your message..."
                        class="flex-1 border border-orange-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-orange-200">

                    <!-- 🚀 Submit -->
                    <button type="submit"
                        class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                        Add
                    </button>
                </form>
                <script>
                    function showSelectedThumbnail(event) {
                        const file = event.target.files[0];
                        const thumbnail = document.getElementById('thumbnail-preview');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                thumbnail.src = e.target.result;
                                thumbnail.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                </script>

            </main>
        </div>
    </div>

    <!-- ✅ Toggle Sidebar Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
@endsection