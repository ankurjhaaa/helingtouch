<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reception Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="bg-white max-w-md w-full p-8 rounded-lg shadow-lg text-center space-y-6">

        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/logo/logo4.png') }}" alt="logo" class="w-16 h-16 rounded-full border" />
        </div>

        <!-- Heading -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Continue to <span class="text-yellow-600">Login</span></h2>
            <p class="text-sm text-gray-600 mt-1">Enter your credentials to access the dashboard</p>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded text-sm">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm">{{ session('error') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm text-left">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="post" class="text-left space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-yellow-500 focus:outline-none @error('email') border-red-500 @enderror"
                    placeholder="login@example.com" />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-yellow-500 focus:outline-none @error('password') border-red-500 @enderror"
                    placeholder="••••••••" />
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox rounded text-yellow-700" />
                    <span class="ml-2 text-gray-700">Remember me</span>
                </label>
                <a href="#" class="text-yellow-700 hover:underline">Forgot password?</a>
            </div>
            <!-- Submit -->
            <div>
                <input type="submit" value="Sign In"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded font-semibold transition cursor-pointer" />
            </div>
        </form>

        <!-- Footer Links -->
        <div class="text-sm text-gray-600 mt-4">
            Need assistance? <a href="#" class="text-yellow-600 hover:underline">Contact Admin</a><br />
            <a href="/" class="inline-flex items-center gap-1 mt-2 text-yellow-600 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0H7" />
                </svg>
                Back to Home
            </a>
        </div>
    </div>

</body>

</html>