@extends('admin.adminlayout')
@section('title', 'Apply for Role')
@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar Component -->
    <x-admin-sidebar/>

    <!-- Main Content -->
    <main class="flex-1 p-6 flex items-center justify-center">
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center space-x-2">
                <i class="fas fa-file-alt text-blue-600"></i>
                <span>Apply for Role</span>
            </h2>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="text-sm text-green-700 bg-green-50 border border-green-200 px-4 py-3 rounded-lg mb-4 transition-all duration-300">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="text-sm text-red-700 bg-red-50 border border-red-200 px-4 py-3 rounded-lg mb-4 transition-all duration-300">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <ul class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-4 list-disc list-inside transition-all duration-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('admin.applySubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                        placeholder="Enter full name">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 textm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                        placeholder="Enter email address">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                        placeholder="Enter password">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role"
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200">
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="receptionist" {{ old('role') == 'reception18' ? 'selected' : '' }}>Receptionist</option>
                    </select>
                    @error('role')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-200"
                        placeholder="Enter phone number">
                    @error('phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                    <input type="file" name="photo"
                        class="w-full text-sm border border-gray-300 rounded-lg bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200">
                    @error('photo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection