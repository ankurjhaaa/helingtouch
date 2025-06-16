@extends('admin.adminlayout')
@section('title', 'Gallery')

@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white shadow p-6 rounded">

    <h2 class="text-2xl font-bold mb-6">Upload to Gallery</h2>

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
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Title (optional)</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="{{ old('title') }}" />
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Type</label>
            <select name="type" class="w-full border px-3 py-2 rounded">
                <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Upload File</label>
            <input type="file" name="file" class="w-full" required />
        </div>

        <button type="submit" class="bg-[#015551] text-white px-6 py-2 rounded hover:bg-[#013c3a]">
            Upload
        </button>
    </form>
</div>

{{-- Gallery Table --}}
<div class="max-w-6xl mx-auto mt-12 bg-white shadow p-6 rounded">
    <h2 class="text-xl font-semibold mb-4">Gallery Items</h2>

    @if($galleryItems->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Type</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Preview</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Uploaded</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($galleryItems as $index => $item)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->title ?? '-' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $item->type }}</td>
                        <td class="px-4 py-2">
                            @if($item->type == 'image')
                                <img src="{{ asset('storage/' . $item->file) }}" class="w-20 h-16 object-cover rounded" />
                            @elseif($item->type == 'video')
                                <video width="160" height="90" controls class="rounded">
                                    <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.gallery.delete', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 cursor-pointer hover:text-red-800 font-semibold text-sm">Delete</button>
                            </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-gray-500">No gallery items uploaded yet.</p>
    @endif
</div>

@endsection
