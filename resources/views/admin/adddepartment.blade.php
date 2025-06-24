@extends('admin.adminlayout')
@section('title', 'Department Management')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 overflow-x-hidden">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                    <i class="fas fa-building text-blue-600"></i>
                    <span>Department Management</span>
                </h2>

                <!-- Add Department Form -->
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Add New Department</h3>
                    <!-- Success Message -->
                    @if (session('masg'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 transition-all duration-300" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('masg') }}</span>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-md mb-4 transition-all duration-300" role="alert">
                            <strong class="font-bold">Whoops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                        </div>
                    @endif

                    <form class="space-y-4" method="POST" action="{{ route('admin.adddepartment') }}" onsubmit="disableSubmitButton()">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                            <input type="text" id="name" placeholder="e.g., Pediatrics" name="name" value="{{ old('name') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200 aria-invalid:bg-red-50" 
                                aria-describedby="name-error" />
                            @error('name')
                                <span id="name-error" class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" placeholder="Write a short description" name="description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200 aria-invalid:bg-red-50"
                                rows="3" aria-describedby="description-error">{{ old('description') }}</textarea>
                            @error('description')
                                <span id="description-error" class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200 aria-invalid:bg-red-50"
                                aria-describedby="status-error">
                                <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Select Status</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span id="status-error" class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" id="submitBtn"
                            class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 font-medium hover:shadow-lg text-sm disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Add Department
                        </button>
                    </form>
                </div>
            </div>

            <!-- Department List -->
            <div class="bg-white rounded-xl shadow-xl p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center space-x-2">
                    <i class="fas fa-list text-blue-600"></i>
                    <span>All Departments</span>
                </h3>
                <!-- Filter Section -->
                <div class="mb-4 flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="departmentSearch" class="block text-sm font-medium text-gray-700 mb-1">Search Department</label>
                        <input type="text" id="departmentSearch"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200"
                            placeholder="Enter department name..." aria-describedby="search-desc" />
                        <span id="search-desc" class="sr-only">Search by department name</span>
                    </div>
                    <div class="flex-1">
                        <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Status</label>
                        <select id="statusFilter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 bg-gray-50 text-gray-700 text-sm transition duration-200"
                            aria-describedby="filter-desc">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <span id="filter-desc" class="sr-only">Filter departments by status</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm" role="grid" aria-label="Departments Table">
                        <thead class="bg-blue-100 text-blue-900">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-sm w-12" scope="col">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm w-1/4" scope="col">Department</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm w-1/2" scope="col">Description</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm w-1/6" scope="col">Status</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm w-1/6" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if ($departments->isEmpty())
                                <tr id="noDataMessage">
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500 text-sm" role="gridcell">No Data Found</td>
                                </tr>
                            @else
                                @foreach ($departments as $department)
                                    <tr class="hover:bg-blue-50 transition-colors duration-200" role="row">
                                        <td class="px-4 py-3 text-sm" role="gridcell">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm" role="gridcell">{{ $department->name }}</td>
                                        <td class="px-4 py-3 text-sm max-w-[200px] truncate" role="gridcell" title="{{ $department->description }}">{{ Str::limit($department->description, 30) }}</td>
                                        <td class="px-4 py-3 text-sm" role="gridcell">
                                            <span class="{{ $department->status == '1' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $department->status == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 flex space-x-2" role="gridcell">
                                            <a href="{{ route('admin.department.edit', $department->id) }}"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition duration-200 shadow-md text-sm"
                                                aria-label="Edit {{ $department->name }} department">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.department.delete', $department->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this department?')"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-200 shadow-md text-sm"
                                                    aria-label="Delete {{ $department->name }} department">
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
                <div class="mt-4">
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script to Disable Submit Button -->
<script>
    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true;
    }
</script>

<!-- Department Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('departmentSearch');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('tbody tr:not(#noDataMessage)');
        const noDataMessage = document.getElementById('noDataMessage');

        function filterTable() {
            const searchText = searchInput.value.toLowerCase().trim();
            const statusValue = statusFilter.value.toLowerCase();
            let visibleRows = 0;

            tableRows.forEach(row => {
                const departmentName = row.cells[1].textContent.toLowerCase();
                const status = row.cells[3].textContent.toLowerCase();

                const matchesSearch = departmentName.includes(searchText);
                const matchesStatus = statusValue === '' || status === statusValue;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    row.cells[0].textContent = ++visibleRows;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noDataMessage) {
                noDataMessage.style.display = visibleRows === 0 && tableRows.length > 0 ? '' : 'none';
            }
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
    });
</script>
@endsection