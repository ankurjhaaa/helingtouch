<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>

<body>
    @include('includes.navbar')
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 px-8 md:px-20 py-14 items-center mt-20">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                Compassionate Healthcare <br>
                <span class="text-yellow-700">For Your Family</span>
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Experience world-class medical care with our team of dedicated specialists and
                patient-centered approach. Your health is our priority.
            </p>
            <a href="" class="mt-6 bg-yellow-700 text-white px-6 py-3 rounded shadow hover:bg-yellow-800">
                Book Appointment →
            </a>

            <div class="flex space-x-10 mt-10">
                <div class="flex items-center space-x-3">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 8v4l3 2"></path>
                            <circle cx="12" cy="12" r="10"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-lg">10+</div>
                        <div class="text-sm text-gray-500">Years of Experience</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-lg">5000+</div>
                        <div class="text-sm text-gray-500">Successful Treatments</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="relative">
            <img src="{{ asset('storage/banner.avif') }}" alt="Surgery" class="rounded-xl shadow-xl">
            <div class="absolute bottom-4 left-4 bg-white p-4 rounded-xl shadow-md flex items-start space-x-3">
                <div class="bg-yellow-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 2l9 4.5v9l-9 4.5-9-4.5v-9z"></path>
                    </svg>
                </div>
                <div>
                    <div class="font-semibold">Safe & Quality Care</div>
                    <div class="text-sm text-gray-500">Advanced protocols</div>
                </div>
            </div>
        </div>
    </section>


    <section class="px-6 py-12 max-w-7xl mx-auto">
        <!-- Heading -->
        <h2 class="text-2xl md:text-3xl font-semibold">
            <span class="border-l-4 border-yellow-700 pl-3 inline-block">Redefining Healthcare with Expertise and
                Innovation!</span>
        </h2>
        <p class="text-gray-700 mt-3 max-w-4xl">
            Choose the Top Hospital in Purnia, Bihar for unmatched healthcare services.


        </p>
        <!-- Feature Cards -->
        <div class="mt-10 grid gap-6 grid-cols-1 md:grid-cols-3">
            <!-- Card 1 -->
            <div class="group border rounded-lg px-6 py-8 hover:shadow-xl hover:scale-105 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/3870/3870822.png" alt="Doctors"
                    class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold">
                    <span class="text-sky-500">Experienced</span> Doctors
                </h3>
                <a href="#"
                    class="mt-4 inline-block text-sm text-yellow-700 hover:text-sky-800 font-medium transition duration-300">
                    Learn More →
                </a>
            </div>

            <!-- Card 2 -->
            <div class="group border rounded-lg px-6 py-8 hover:shadow-xl hover:scale-105 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/1250/1250620.png" alt="Services"
                    class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold">
                    <span class="text-sky-500">Exceptional</span> Services
                </h3>
                <a href="#"
                    class="mt-4 inline-block text-sm text-yellow-700 hover:text-sky-800 font-medium transition duration-300">
                    Learn More →
                </a>
            </div>

            <!-- Card 3 -->
            <div class="group border rounded-lg px-6 py-8 hover:shadow-xl hover:scale-105 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/3079/3079125.png" alt="Equipments"
                    class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold">
                    <span class="text-sky-500">Top</span> Equipments
                </h3>
                <a href="#"
                    class="mt-4 inline-block text-sm text-yellow-700 hover:text-sky-800 font-medium transition duration-300">
                    Learn More →
                </a>
            </div>
        </div>
    </section>




    <section class="px-6 py-12 max-w-7xl mx-auto">
        <!-- Heading -->
        <h2 class="text-2xl md:text-3xl font-semibold">
            <span class="border-l-4 border-yellow-700 pl-3 inline-block">Meet Our Healthcare Professionals</span>
        </h2>
        <p class="text-gray-700 mt-3 max-w-4xl">
            Our team of experienced doctors and specialists are committed to providing exceptional care
        </p>

        <!-- Cards Grid -->
        <div class="flex flex-wrap justify-center gap-6 mt-10">

            <!-- Doctor Card -->
            <div
                class="w-full sm:w-[48%] lg:w-[23%] bg-white border rounded-xl overflow-hidden shadow hover:shadow-lg transition-all duration-300 flex flex-col">

                <!-- Image Link -->
                <a href="/doctor/charly-kumar" class="block overflow-hidden">
                    <img src="https://picsum.photos/seed/doc1/400/250" alt="Doctor"
                        class="w-full object-cover hover:scale-105 transition duration-300">
                </a>

                <!-- Card Content -->
                <div class="p-5 flex-grow flex flex-col text-left">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Dr. Charly Kumar</h3>
                        <p class="text-sm text-yellow-700">Laparoscopic & Laser Surgeon</p>
                    </div>

                    <!-- Appointment Button -->
                    <form method="POST" action="/book-appointment" class="mt-auto">
                        <input type="hidden" name="doctor" value="Dr. Charly Kumar">
                        <button type="submit"
                            class="w-full text-sm bg-yellow-700 text-white py-2 rounded-md hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all">
                            Book Appointment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Doctor Card 2 -->
            <div
                class="w-full sm:w-[48%] lg:w-[23%] bg-white border rounded-xl overflow-hidden shadow hover:shadow-lg transition-all duration-300 flex flex-col">

                <a href="/doctor/kiran-kumari" class="block overflow-hidden">
                    <img src="https://picsum.photos/seed/doc2/400/250" alt="Doctor"
                        class="w-full object-cover hover:scale-105 transition duration-300">
                </a>

                <div class="p-5 flex-grow flex flex-col text-left">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Dr. Kiran Kumari</h3>
                        <p class="text-sm text-yellow-700">Gynaecology Specialist</p>
                    </div>
                    <form method="POST" action="/book-appointment" class="mt-auto">
                        <input type="hidden" name="doctor" value="Dr. Kiran Kumari">
                        <button type="submit"
                            class="w-full text-sm bg-yellow-700 text-white py-2 rounded-md hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all">
                            Book Appointment
                        </button>
                    </form>
                </div>
            </div>

            <!-- More Cards... -->

        </div>
    </section>



    <section class="px-6 py-12 max-w-7xl mx-auto">
        <!-- Heading -->
        <h2 class="text-2xl md:text-3xl font-semibold">
            <span class="border-l-4 border-yellow-700 pl-3 inline-block">Our Services</span>
        </h2>
        <p class="text-gray-700 mt-3 max-w-4xl">
            At KK Hospital, Purnia, we are committed to providing high-quality healthcare with a range of services
            designed to meet the diverse needs of our patients. From advanced diagnostic tools to specialized
            treatments, we offer everything under one roof to ensure your health and comfort. Our hospital is equipped
            with the latest technology, expert medical professionals, and modern facilities, providing you with the best
            care possible 24/7.
        </p>

        <!-- Services Grid -->
        <div class="mt-10 grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <!-- Card 1 -->
            <div class="border rounded-lg px-6 py-8 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/3079/3079125.png" alt="Radiology"
                    class="w-10 h-10 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-center">
                    <span class="text-sky-500">Radiology</span> Department
                </h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="text-sky-600">✔</span> 24x7 CT Scan
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-sky-600">✔</span> DR X-Ray
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-sky-600">✔</span> Ultrasound
                    </li>
                </ul>
            </div>

            <!-- Card 2 -->
            <div class="border rounded-lg px-6 py-8 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/1250/1250620.png" alt="Cardio"
                    class="w-10 h-10 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-center">
                    <span class="text-sky-500">Cardio-Pulmonary</span> Department
                </h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> ECG</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> Echocardiography</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> TMT</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> PFT Spirometry</li>
                </ul>
            </div>

            <!-- Card 3 -->
            <div class="border rounded-lg px-6 py-8 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/10320/10320927.png" alt="In-Patient"
                    class="w-10 h-10 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-center">
                    <span class="text-sky-500">In-Patient</span> Services
                </h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> General, Semi-VIP, VIP Rooms
                    </li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> 24-Hour Labor Room</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> 24-Hour Modular OT</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> 24-Hour Dialysis</li>
                </ul>
            </div>

            <!-- Card 4 -->
            <div class="border rounded-lg px-6 py-8 hover:shadow-xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/3870/3870822.png" alt="Others"
                    class="w-10 h-10 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-center">
                    <span class="text-sky-500">Other</span> Services
                </h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> Computerized Pathology</li>
                    <li class="flex items-start gap-2"><span class="text-sky-600">✔</span> Pharmacy</li>
                </ul>
            </div>
        </div>

        <!-- Explore All Button -->
        <div class="mt-10 text-center">
            <a href="#"
                class="inline-block bg-yellow-600 text-white px-6 py-3 rounded-md hover:bg-yellow-700 shadow transition duration-300">
                Explore All →
            </a>
        </div>
    </section>

</body>

</html>