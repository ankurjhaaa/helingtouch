@extends('landing.publiclayout')
@section('title', 'Home')

@section('content')


    <div class="bg-[#f6f8f9] min-h-screen py-10 px-4 mt-20">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Top Banner -->
            <div
                class="bg-gradient-to-r from-[#b88c57] to-[#7f5a2b] px-8 py-10 flex flex-col sm:flex-row items-center sm:items-start sm:justify-between gap-6">
                <!-- Doctor Image -->
                <div class="flex-shrink-0">
                    <img src="https://via.placeholder.com/120" alt="Doctor"
                        class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-md">
                </div>

                <!-- Info -->
                <div class="flex-1 text-center sm:text-left">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">Dr. Charly Kumar Sinha</h2>
                    <p class="text-white text-sm mt-1">General Laparoscopic & Laser Surgeon</p>
                    <div class="text-sm text-white mt-2 space-y-1">
                        <p><strong>Department:</strong> Surgeon</p>
                        <p><strong>Availability:</strong> Mon – Sun</p>
                        <p><strong>Fee:</strong> 500</p>
                    </div>
                </div>

                <!-- Status -->
                <div class="text-white text-sm">
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium">
                        ✅ Available for Appointments
                    </span>
                </div>
            </div>

            <!-- Main Section -->
            <div class="grid md:grid-cols-3 gap-6 p-2 sm:p-4 lg:p-6">

                <!-- Left Column -->
                <div class="md:col-span-2 space-y-6">

                    <!-- About -->
                    <div class="bg-gray-50 p-5 rounded-xl border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">👨‍⚕️ About Doctor</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Dr. Charly Kumar Sinha is a dedicated healthcare professional with expertise in their field.
                            They provide exceptional patient care and stay current with the latest medical advancements.
                        </p>
                    </div>

                    <!-- Specialties -->
                    <div class="bg-gray-50 p-5 rounded-xl border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">💼 Specialties</h3>
                        <span
                            class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Surgeon</span>
                    </div>

                    <!-- Experience & Education -->
                    <div class="bg-gray-50 p-5 rounded-xl border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">🎓 Experience & Education</h3>
                        <p class="text-sm text-gray-600">General Laparoscopic & Laser Surgeon</p>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="bg-[#fdf8f2] border border-[#e4d5c4] rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-[#7f5a2b] mb-2">📅 Book an Appointment</h3>
                        <p class="text-sm text-gray-700 mb-4">Schedule your consultation in just a few clicks. We offer
                            next-day slots & online booking.</p>

                        <ul class="text-sm text-gray-600 space-y-2 mb-4">
                            <li>✅ Online Booking</li>
                            <li>✅ Next-Day Appointments</li>
                        </ul>

                        <button class="w-full bg-[#7f5a2b] text-white py-2 rounded-md hover:bg-[#68471f] transition">Book
                            Appointment</button>
                        <p class="text-xs text-gray-500 text-center mt-2">Or call us at: +91 919 471 659 700</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection