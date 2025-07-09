@extends('landing.publiclayout')
@section('title', 'Our Doctors')

@section('content')
    <div class="bg-[#f7f7f7] py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-[#4B2E2E]">Our Medical Services</h1>
                <p class="mt-4 text-gray-700 text-lg">We offer a comprehensive range of medical services designed to meet
                    the needs of our community with excellence and compassion.</p>
            </div>

            <!-- Appointment Box -->
            <div
                class="bg-white border border-[#ccf4f3] rounded-xl px-8 py-6 flex flex-col md:flex-row items-center justify-between mb-12 shadow-sm">
                <!-- Left Content -->
                <div class="mb-6 md:mb-0 md:mr-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Book Your Appointment Today</h2>
                    <p class="text-gray-600 mb-4 max-w-xl">
                        Schedule a consultation with our specialists in just a few clicks. We offer next-day appointments
                        and personalized care plans tailored to your needs.
                    </p>
                    <div class="flex flex-wrap gap-x-6 gap-y-2">
                        <div class="flex items-center text-yellow-700 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg>
                            Online Booking
                        </div>
                        <div class="flex items-center text-yellow-700 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg>
                            Next-Day Appointments
                        </div>
                    </div>
                </div>

                <!-- Button & Call -->
                <div class="text-center">
                    <a href="/appointment"
                        class="bg-yellow-700 hover:bg-yellow-800 text-white font-semibold px-6 py-3 rounded-md inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M8 7V3m8 4V3m-9 8h10m-15 9h18a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                        Book Appointment
                    </a>
                    <p class="text-sm text-gray-500 mt-2">Or call us at: <span class="whitespace-nowrap">+91
                            9471659700</span></p>
                </div>
            </div>


            <!-- Services Section -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Sidebar -->
                <div class="w-full lg:max-w-sm overflow-hidden h-fit bg-white rounded-xl shadow border border-gray-200">
                    <!-- Services Header -->
                    <div class="bg-yellow-800 text-white px-5 py-4 rounded-t-xl flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12h18M3 6h18M3 18h18"></path>
                        </svg>
                        <h3 class="text-lg font-semibold">Our Services</h3>
                    </div>

                    <!-- Service List -->
                    <ul class="px-8 py-4 space-y-1">
                        <li class="text-black font-medium hover:bg-yellow-50 cursor-pointer p-3">Multispeciality</li>
                        <li class="text-black font-medium hover:bg-yellow-50 cursor-pointer p-3">Multispeciality</li>
                        <li class="text-black font-medium hover:bg-yellow-50 cursor-pointer p-3">Multispeciality</li>
                        <li class="text-black font-medium hover:bg-yellow-50 cursor-pointer p-3">Multispeciality</li>
                        

                    </ul>

                    <!-- Divider -->
                    <hr class="border-gray-200" />

                    <!-- Operating Hours -->
                    <div class="px-10 py-6 text-md text-black space-y-2">
                        <h4 class="font-semibold flex items-center mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#00c6c4]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3"></path>
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            Operating Hours
                        </h4>
                        <div class="flex justify-between">
                            <span>Monday - Friday</span>
                            <span class="text-yellow-700 font-medium">8:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Saturday</span>
                            <span class="text-yellow-700 font-medium">9:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sunday</span>
                            <span class="text-yellow-700 font-medium">Closed</span>
                        </div>

                        <div class="bg-[#d2d0ca] text-yellow-700 p-2 rounded mt-3 text-center text-xs font-semibold">
                            Emergency care available 24/7
                        </div>
                    </div>

                    <!-- Call Section -->
                    <div class="px-10 py-6 text-md text-black  space-y-2">
                        <h4 class="font-semibold">Need Help?</h4>
                        <p>Contact us for appointments or questions</p>
                        <a href="tel:+919471659700"
                            class="block text-center bg-yellow-700 hover:bg-yellow-800 text-white font-semibold py-2 rounded">
                            Call Now
                        </a>
                    </div>
                </div>


                <!-- Service Cards -->
                <div class="w-full lg:flex-1 space-y-6">
                    <!-- Cards remain same -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="https://picsum.photos/seed/1/400/300" class="w-full md:w-1/3 h-48 object-cover"
                            alt="Multispeciality Care">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[#4B2E2E] mb-2">Multispeciality Care</h3>
                            <p class="text-gray-600">Our multispeciality care unit provides expert consultation across
                                cardiology, orthopedics, and general medicine.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="https://picsum.photos/seed/2/400/300" class="w-full md:w-1/3 h-48 object-cover"
                            alt="ICU Services">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[#4B2E2E] mb-2">ICU Services</h3>
                            <p class="text-gray-600">Our ICU offers round-the-clock monitoring for critical patients
                                requiring intensive medical attention.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="https://picsum.photos/seed/3/400/300" class="w-full md:w-1/3 h-48 object-cover"
                            alt="NICU Services">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[#4B2E2E] mb-2">NICU Services</h3>
                            <p class="text-gray-600">We provide advanced neonatal care for premature and critically ill
                                newborns in our NICU facility.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="https://picsum.photos/seed/4/400/300" class="w-full md:w-1/3 h-48 object-cover"
                            alt="Ultrasound">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[#4B2E2E] mb-2">Ultrasound Services</h3>
                            <p class="text-gray-600">High-quality ultrasound imaging helps us accurately diagnose and
                                monitor various health conditions.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="https://picsum.photos/seed/5/400/300" class="w-full md:w-1/3 h-48 object-cover"
                            alt="Neurosurgery">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[#4B2E2E] mb-2">Neurosurgery</h3>
                            <p class="text-gray-600">Our neurosurgery team specializes in brain and spine surgeries,
                                offering precise and compassionate care.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection