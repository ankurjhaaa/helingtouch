
@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')

<div class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white border border-gray-200 rounded-sm shadow-md p-6">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">📝 Apply for Role</h2>
    
      {{-- Flash Message --}}
      @if(session('success'))
        <div class="text-sm text-green-700 bg-green-100 px-3 py-2 rounded-sm mb-3">{{ session('success') }}</div>
      @elseif(session('error'))
        <div class="text-sm text-red-700 bg-red-100 px-3 py-2 rounded-sm mb-3">{{ session('error') }}</div>
      @endif
    
      {{-- Validation --}}
      @if ($errors->any())
        <ul class="text-sm text-red-600 bg-red-50 border border-red-200 rounded-sm px-3 py-2 mb-3 list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    
      <form action="{{ route('admin.applySubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
        @csrf
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Full Name</label>
          <input type="text" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter name">
          @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="Enter email">
          @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Password</label>
          <input type="password" name="password"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="••••••">
          @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Role</label>
          <select name="role"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm bg-white focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">Select</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
            <option value="receptionist" {{ old('role') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
          </select>
          @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Phone</label>
          <input type="number" name="phone" value="{{ old('phone') }}"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm focus:outline-none focus:ring focus:ring-blue-200"
            placeholder="9876543210">
          @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <label class="block text-sm text-gray-600 mb-1">Photo</label>
          <input type="file" name="photo"
            class="w-full text-sm border border-gray-300 rounded-sm bg-white px-2 py-1">
          @error('photo') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    
        <div>
          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-sm transition">
            Submit
          </button>
        </div>
      </form>
    </div>
</div>

    
@endsection