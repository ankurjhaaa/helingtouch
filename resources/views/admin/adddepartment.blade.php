@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-blue-900 mb-6">Department Management</h2>

        <!-- Add Department Form -->
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Add New Department</h3>
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
            <form class="space-y-4" method="post" action="{{ route('admin.adddepartment') }}">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                    <input type="text" placeholder="e.g., Pediatrics" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea placeholder="Write a short description" name="description"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                        rows="3" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white text-gray-700"
                        name="status" value="{{ old('status') }}">

                        <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Select Status</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>

                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm hover:bg-blue-700 transition">Add
                    Department</button>
            </form>
        </div>

        <!-- Department List -->
        <div class="overflow-x-auto">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">All Departments</h3>
            <!-- Filter Section -->
            <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="departmentSearch" class="block text-sm font-medium text-gray-700 mb-1">Search
                        Department</label>
                    <input type="text" id="departmentSearch"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter department name...">
                </div>
                <div class="flex-1">
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Status</label>
                    <select id="statusFilter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <table class="min-w-full border border-gray-200 text-sm text-left">
                <thead class="bg-blue-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Department</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Actions</th>

                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($departments->isEmpty())
                        <tr id="noDataMessage">
                            <td colspan="5" class="px-4 py-2 border text-center text-gray-500">No Data Found</td>
                        </tr>
                    @else

                        @foreach ($departments as $department)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $department->name }}</td>
                                <td class="px-4 py-2 border">{{ $department->description }}</td>
                                <td class="px-4 py-2 border">{{ $department->status }}</td>
                                <td class="px-4 py-2 border space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.department.edit', $department->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.department.delete', $department->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this department?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $departments->links() }}
    </div>

    <!-- ✅ Script to Disable Submit Button -->
    <script>
        function disableSubmitButton() {
            document.getElementById('submitBtn').disabled = true;
        }
    </script>
    <!-- Include the JavaScript file -->
    <script src="{{ asset('js/department_filter.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get elements
            const searchInput = document.getElementById('departmentSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('tbody tr');

            // Filter function
            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();

                tableRows.forEach((row, index) => {
                    const departmentName = row.cells[1].textContent.toLowerCase();
                    const status = row.cells[3].textContent.toLowerCase();

                    // Check if row matches search and status filter
                    const matchesSearch = departmentName.includes(searchText);
                    const matchesStatus = statusValue === '' || status === statusValue;

                    // Show/hide row and update row number
                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        row.cells[0].textContent = index + 1; // Update row number
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Event listeners for filters
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });
        
    </script>

@endsection