@extends('landing.publiclayout')
@section('tile', 'registration page')
@section('content')

    <div class="max-w-md  mx-auto mt-30 bg-white p-6 shadow rounded">
        <h2 class="text-2xl font-bold mb-4 text-center">Login Here</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('userlogin') }}" method="POST">
            @csrf
          
           
            <input type="email" name="email" class="w-full mb-3 border rounded px-3 py-2" placeholder="Email" >
            @error('email')
            <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror
           

            <input type="password" name="password" class="w-full mb-3 border rounded px-3 py-2" placeholder="Password"
                >
            @error('password')
            <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror
          

            <button type="submit" class="bg-yellow-700 hover:cursor-pointer text-white px-6 py-2 rounded w-full">Register</button>
        </form>

        <p class="text-sm mt-4 text-center">Already registered? <a href=""
                class="text-blue-500">Login here</a></p>
    </div>


@endsection