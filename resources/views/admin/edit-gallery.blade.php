@extends('admin.adminlayout')
@section('title', 'Edit Gallery')

@section('content')


    <div class="max-w-4xl mx-auto mt-10 bg-white shadow p-6 rounded">

        <h2 class="text-2xl font-bold mb-6">Edit Gallery</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove();"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 text-xl font-bold">×</button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Oops!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" onclick="this.parentElement.remove();"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 text-xl font-bold">×</button>
            </div>
        @endif

        {{-- Upload Form --}}
        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Title (optional)</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="{{ $gallery->title }}" />
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Type</label>
                <select name="type" class="w-full border px-3 py-2 rounded">
                    <option value="image" {{ $gallery->type == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ $gallery->type == 'video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="block font-semibold">Current Image Periview</label>
                @if($gallery->type == 'image')
                    <img src="{{ asset('storage/' . $gallery->file) }}" alt="jshd" class="w-40 h-auto rounded shadow border">
                @elseif($gallery->type == 'video')
                    <video controls class="w-72 rounded shadow border">
                        <source src="{{ asset('storage/' . $gallery->file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Upload File</label>
                <input type="file" name="file" value="{{ $gallery->file }}" class="w-full" />

            </div>

            <button type="submit" class="bg-[#015551] text-white px-6 py-2 rounded hover:bg-[#013c3a]">
                Update
            </button>
        </form>
    </div>


@endsection