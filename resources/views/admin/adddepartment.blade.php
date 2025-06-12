
@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
    <!-- Header -->
    <h2 class="text-2xl font-bold text-blue-900 mb-6">Department Management</h2>

    <!-- Add Department Form -->
    <div class="bg-gray-50 p-5 rounded-lg border border-gray-200 mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Add New Department</h3>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                <input type="text" placeholder="e.g., Pediatrics"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea placeholder="Write a short description"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                    rows="3"></textarea>
            </div>
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-md text-sm hover:bg-blue-700 transition">Add Department</button>
        </form>
    </div>

    <!-- Department List -->
    <div class="overflow-x-auto">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">All Departments</h3>
        <table class="min-w-full border border-gray-200 text-sm text-left">
            <thead class="bg-blue-50 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Department</th>
                    <th class="px-4 py-2 border">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">1</td>
                    <td class="px-4 py-2 border">Cardiology</td>
                    <td class="px-4 py-2 border">Heart-related treatments and diagnostics.</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">2</td>
                    <td class="px-4 py-2 border">Neurology</td>
                    <td class="px-4 py-2 border">Brain and nervous system care.</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">3</td>
                    <td class="px-4 py-2 border">Pediatrics</td>
                    <td class="px-4 py-2 border">Child and newborn healthcare services.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


    
@endsection