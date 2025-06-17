@extends('landing.publiclayout')
@section('title', 'Hospital Contact')
@section('content')
    <div class="container mx-auto mt-10 px-4 py-12">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Get in Touch</h1>
            <p class="text-gray-600 mt-2">We're here to help and answer any questions you might have. We look forward to
                hearing from you.</p>
        </div>

        <!-- Main Content Section -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Contact Information Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex-1">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-4 border-yellow-600 inline-block pb-1">Contact
                    Information</h2>
                <div class="space-y-6">
                    <!-- Phone -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h2l1 7h12l1-7h2m-9 12h2m-5 0h2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Phone</p>
                            <p class="text-gray-600">+919471659700</p>
                            <p class="text-sm text-gray-500">Available 24/7 for emergency</p>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12H8m4 4H8m4-8H8m8 0h4a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Email</p>
                            <p class="text-gray-600">info@healingtouchpurnea.com</p>
                            <p class="text-sm text-gray-500">We respond within 24 hours</p>
                        </div>
                    </div>
                    <!-- Support Hours -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Support Hours</p>
                            <p class="text-gray-600">Monday - Saturday: 9:00 AM - 8:00 PM</p>
                            <p class="text-gray-600">Sunday: Closed (Emergency Only)</p>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-2.596 0-4.192 1.583-4.192 4.615v3.385z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.326 3.608 1.301.975.975 1.24 2.242 1.301 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.326 2.633-1.301 3.608-.975.975-2.242 1.24-3.608 1.301-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.326-3.608-1.301-.975-.975-1.24-2.242-1.301-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.326-2.633 1.301-3.608.975-.975 2.242-1.24 3.608-1.301 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-1.542.07-2.888.377-3.947 1.436-1.059 1.059-1.366 2.405-1.436 3.947-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.07 1.542.377 2.888 1.436 3.947 1.059 1.059 2.405 1.366 3.947 1.436 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.542-.07 2.888-.377 3.947-1.436 1.059-1.059 1.366-2.405 1.436-3.947.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.07-1.542-.377-2.888-1.436-3.947-1.059-1.059-2.405-1.366-3.947-1.436-1.28-.058-1.688-.072-4.947-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441-.645-1.441-1.441s.645-1.441 1.441-1.441 1.441.645 1.441 1.441-.645 1.441-1.441 1.441z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex-1">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Our Location</h2>
                <!-- Placeholder for Map -->
                <div class="relative mb-4">
                    <iframe
                        src="https://maps.google.com/maps?q={{ $setting->latitude }},{{ $setting->longitude }}&output=embed"
                        width="100%" height="300" style="border:0;" allowfullscreen loading="lazy">
                    </iframe>
                    <a href="#" class="absolute top-2 right-2 text-blue-600 text-sm font-medium">View larger map</a>
                </div>
                <p class="text-gray-600">Visiting Hours:</p>
                <p class="text-gray-600">9:00 AM - 8:00 PM (Monday - Saturday)</p>
                <p class="text-gray-600 font-medium">24/7 Emergency Services Available</p>
            </div>

        </div>
        <!-- Contact Form Section -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-4 border-yellow-600 inline-block pb-1">Send Us a
                Message</h2>
            <div class="space-y-6">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('landing.hospital-contact.store') }}" method="post">
                    @csrf
                    <!-- Name Field -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-600 transition duration-200"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email Field -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-600 transition duration-200"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Message Field -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Message</label>
                        <textarea name="message"
                            class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-600 transition duration-200"
                            rows="4" value="{{ old('message') }}" name="message"></textarea>
                        @error('message')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div>
                        <button
                            class="bg-[#015551] text-white px-6 py-3 rounded-lg hover:bg-[#013c3a] transition duration-200">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection