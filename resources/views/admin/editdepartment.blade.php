@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-blue-900 mb-6">Department Management</h2>

        <!-- Add Department Form -->
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Edit Department</h3>
            <!-- ✅ Success Message -->
            @if (session('masg'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('masg') }}</span>
                </div>
            @endif

            <!-- ❌ Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                </div>
            @endif
            <form class="space-y-4" method="post" action="{{ route('admin.department.update', $department->id) }}">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                    <input type="text" placeholder="e.g., Pediatrics" name="name"
                        value="{{ old('name', $department->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea placeholder="Write a short description" name="description"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                        rows="3">{{ old('description', $department->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-300 focus:outline-none">
                        <option value="active" {{ $department->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $department->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm hover:bg-blue-700 transition">Update
                    Department</button>
            </form>
        </div>


    </div>


    <!-- ✅ Script to Disable Submit Button -->
    <script>
        function disableSubmitButton() {
            document.getElementById('submitBtn').disabled = true;
        }
    </script>

@endsection