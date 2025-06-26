@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')


    <!-- Mobile/Tablet only -->
    <div
        class="block lg:hidden h-screen bg-[url('https://www.transparenttextures.com/patterns/wood-pattern.png')] bg-cover bg-center relative">

        <!-- Chat Area -->
        <div
            class="absolute top-0 bottom-16 left-0 right-0 overflow-y-auto p-4 flex flex-col-reverse space-y-reverse space-y-4 backdrop-blur-sm bg-white/60">



            @foreach($userchats as $userchat)
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
                                @else
                                    @php
                                        $doctorname = \App\Models\User::find($userchat->doctorid);
                                    @endphp
                                    Doctor : {{ $doctorname->name }}
                                @endif

                            </div>
                            <div class="text-xs text-gray-500 mb-1">{{ $userchat->created_at->diffForHumans() }}</div>
                            <div>{{ $userchat->chat }} || {{ $userchat->created_at }}</div>
                        </div>
                    </div>
                @else
                    <div class="relative ms-6">
                        <span class="absolute -start-4 top-1 w-8 h-8 rounded-full ring-4 ring-white">
                            <img src="https://i.pravatar.cc/40?img=5" alt="" class="rounded-full">
                        </span>
                        <div class="bg-white border border-orange-200 rounded-lg p-3 shadow text-sm text-gray-800">
                            <div class="font-semibold text-orange-800">Birbal</div>
                            <div class="text-xs text-gray-500 mb-1">1 min ago</div>

                            <!-- Clickable image -->
                            <div class="mt-1">
                                <img src="https://picsum.photos/id/1025/200/120" alt="shared"
                                    class="rounded-lg border cursor-pointer hover:opacity-90 transition"
                                    onclick="openImageModal('https://picsum.photos/id/1025/800/600')" />
                            </div>

                            <div class="mt-2">Yeh wala try kiya, mast hai 😎</div>
                        </div>
                    </div>
                @endif


            @endforeach


            <!-- 🧍 Dummy Text Message -->
            <div class="relative ms-6">
                <span class="absolute -start-4 top-1 w-8 h-8 rounded-full ring-4 ring-white">
                    <img src="https://i.pravatar.cc/40?img=3" alt="" class="rounded-full">
                </span>
                <div class="bg-white border border-orange-200 rounded-lg px-4 py-3 shadow text-sm text-gray-800">
                    <div class="font-semibold text-orange-800">Ankur</div>
                    <div class="text-xs text-gray-500 mb-1">Just now</div>
                    <div>Bhai, yeh gym ke naye supplements aaye hai!</div>
                </div>
            </div>




        </div>

        <!-- 📥 Input Form -->
        <form action="{{ route('landing.insertuserhistory') }}" method="post"
            class="absolute bottom-0 left-0 right-0 bg-white border-t border-orange-200 flex gap-2 p-3">
            @csrf

            <input type="text" name="chat" placeholder="Type your message..."
                class="flex-1 border border-orange-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-orange-200">
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                Add
            </button>
        </form>
    </div>

    <!-- 🖼️ Fullscreen Image Modal  -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center">
        <div class="relative max-w-full max-h-full">
            <img id="modalImage" src="" alt="Full image" class="max-h-[90vh] rounded-lg shadow-lg" />

            <!-- ❌ Close Button -->
            <button onclick="closeImageModal()"
                class="absolute top-2 right-2 bg-white text-black px-2 py-1 rounded-full hover:bg-red-500 hover:text-white transition text-xs">
                ✕
            </button>

            <!-- ⬇️ Download Button -->
            <a id="downloadLink" href="#" download
                class="absolute bottom-2 right-2 bg-white text-black px-3 py-1 rounded shadow text-xs hover:bg-orange-500 hover:text-white transition">
                Download
            </a>
        </div>
    </div>

    <!-- ✅ Image Modal Script -->
    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            const download = document.getElementById('downloadLink');

            img.src = src;
            download.href = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>




@endsection