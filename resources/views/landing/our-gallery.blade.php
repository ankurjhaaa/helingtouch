@extends('landing.publiclayout')
@section('title', 'Gallery')

@section('content')
<div class="max-w-7xl mt-10 mx-auto px-4 py-12 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#015551] tracking-tight">Our Hospital Gallery</h1>
        <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">
            Explore the heart of our hospital through captivating images and videos showcasing our facilities, staff, and care.
        </p>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse ($galleryItems as $item)
            <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <!-- Media Container -->
                <div class="relative w-full h-64 bg-gray-100">
                    @if ($item->type == 'image')
                        <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->title ?? 'Gallery Image' }}"
                             class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @elseif ($item->type == 'video')
                        <video class="w-full h-full object-cover auto-play-video" 
                               data-id="{{ $loop->index }}"
                               loop
                               muted
                               preload="metadata"
                               poster="{{ asset('storage/' . ($item->thumbnail ?? $item->file)) }}">
                            <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    <!-- Overlay for Media Type -->
                    <div class="absolute top-3 right-3 bg-[#015551] text-white text-xs font-semibold uppercase px-2 py-1 rounded-full">
                        {{ ucfirst($item->type) }}
                    </div>
                </div>
                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $item->title ?? 'Untitled' }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                        {{ $item->description ?? 'Explore our hospital facilities and care.' }}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-12">
                <p class="text-xl text-gray-600 font-medium">😕 No gallery items available right now.</p>
                <p class="mt-2 text-gray-500">Check back soon for updates!</p>
            </div>
        @endforelse
    </div>


</div>


<!-- JavaScript for Auto-Play Video on Hover -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Add fade-in effect for gallery items
        const galleryItems = document.querySelectorAll('.grid > div');
        galleryItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add('fade-in');
            }, index * 100);
        });

        // Auto-play/pause videos on hover
        const videos = document.querySelectorAll('.auto-play-video');
        videos.forEach((video) => {
            video.parentElement.addEventListener('mouseenter', () => {
                video.play().catch((error) => {
                    console.log('Video play failed:', error);
                });
            });
            video.parentElement.addEventListener('mouseleave', () => {
                video.pause();
            });
        });
    });
</script>
@endsection