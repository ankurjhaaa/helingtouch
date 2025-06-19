@extends('landing.publiclayout')
@section('title', 'Our Doctors')

@section('content')
    <div class="max-w-8xl mx-auto px-10 py-10 grid grid-cols-1 xl:grid-cols-3 gap-6 font-sans mt-20">
        <!-- Left Panel -->
        <div
            class="bg-white rounded-2xl shadow-md p-6 sm:p-8 xl:col-span-1 flex flex-col justify-between border border-[#d5bfa5]">
            <div class="space-y-6 text-center">
                <div
                    class="mx-auto w-20 h-20 bg-gradient-to-br from-[#a77c52] to-[#c9a27e] rounded-full flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10m-7 4h4m5-10H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2z" />
                    </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-[#5a3921]">Schedule Your Visit</h2>
                <p class="text-[#7d5a3d] text-sm">Plan your appointment with top specialists in just a few clicks.</p>
                <button
                    class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white px-6 py-2 rounded-full shadow hover:scale-105 transition-transform text-sm md:text-base">
                    + Book Appointment
                </button>
            </div>

            <div class="mt-10 bg-[#fffaf2] border border-[#e0c9aa] rounded-xl p-4 shadow-sm">
                <h3 class="text-sm font-semibold text-[#5a3921] mb-2">Why Choose Us?</h3>
                <ul class="space-y-2 text-sm text-[#7d5a3d] list-disc list-inside">
                    <li>Experienced & trusted doctors</li>
                    <li>Premium wooden-themed interface</li>
                    <li>Seamless online booking experience</li>
                </ul>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 xl:col-span-2 border border-[#d5bfa5]">
            <h2 class="text-xl md:text-2xl font-bold text-[#5a3921] mb-6">Find Your Appointment</h2>

            <!-- Search Controls -->
            <div class="flex flex-col sm:flex-row sm:items-end gap-4 mb-6">
                <!-- <div class="flex items-center gap-4">
                            <label class="flex items-center space-x-1">
                              <input type="radio" name="searchType" class="accent-[#a77c52]" checked>
                              <span class="text-sm text-[#5a3921]">Phone</span>
                            </label>
                            <label class="flex items-center space-x-1">
                              <input type="radio" name="searchType" class="accent-[#a77c52]">
                              <span class="text-sm text-[#5a3921]">Email</span>
                            </label>
                          </div> -->

                <div class="flex-grow relative">
                    <input type="text"
                        class="w-full border border-[#d5bfa5] bg-[#fff8ee] text-[#5a3921] rounded-md py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-[#a77c52] placeholder-[#a78b6d]"
                        placeholder="Enter phone or email...">
                    <!-- <div class="absolute top-2.5 right-3 text-[#a77c52]">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm5.293 13.293a1 1 0 00-1.414 0L10 19.172l-3.879-3.879a1 1 0 10-1.414 1.414l4.586 4.586a1 1 0 001.414 0l4.586-4.586a1 1 0 000-1.414z" clip-rule="evenodd" />
                              </svg>
                            </div> -->
                </div>

                <button
                    class="bg-gradient-to-r from-[#a77c52] to-[#c9a27e] text-white px-5 py-2 rounded-md shadow hover:scale-105 transition-transform text-sm md:text-base">
                    Search
                </button>
            </div>

            <!-- Appointment Table -->
            <div class="overflow-auto rounded-lg border border-[#d5bfa5] max-h-[350px]">
                <table class="w-full min-w-[600px] text-sm text-left text-[#5a3921]">
                    <thead class="bg-[#f5e8d9] text-sm">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Ref ID</th>
                            <th class="px-4 py-3 font-semibold">Date & Time</th>
                            <th class="px-4 py-3 font-semibold">Doctor</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#fffaf2] divide-y divide-[#ead6b9]">
                        <!-- Dummy rows -->
                        <!-- Row 1 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00073</td>
                            <td class="px-4 py-3">13 May 2025<br><span class="text-xs text-[#a78b6d]">17:00:00</span></td>
                            <td class="px-4 py-3">Dr. Charly Kumar Sinha<br><span
                                    class="text-xs text-[#a77c52]">Surgeon</span></td>
                            <td class="px-4 py-3"><span
                                    class="bg-[#f3e4c9] text-[#a77c52] text-xs font-semibold px-3 py-1 rounded-full">Checked
                                    In</span></td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 2 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00074</td>
                            <td class="px-4 py-3">14 May 2025<br><span class="text-xs text-[#a78b6d]">10:00:00</span></td>
                            <td class="px-4 py-3">Dr. Meena Shah<br><span class="text-xs text-[#a77c52]">Cardiologist</span>
                            </td>
                            <td class="px-4 py-3"><span
                                    class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">Cancelled</span>
                            </td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 3 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00075</td>
                            <td class="px-4 py-3">15 May 2025<br><span class="text-xs text-[#a78b6d]">12:30:00</span></td>
                            <td class="px-4 py-3">Dr. Alok Verma<br><span
                                    class="text-xs text-[#a77c52]">Dermatologist</span></td>
                            <td class="px-4 py-3"><span
                                    class="bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">Completed</span>
                            </td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 4 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00076</td>
                            <td class="px-4 py-3">16 May 2025<br><span class="text-xs text-[#a78b6d]">09:45:00</span></td>
                            <td class="px-4 py-3">Dr. Pooja Rana<br><span class="text-xs text-[#a77c52]">Gynecologist</span>
                            </td>
                            <td class="px-4 py-3"><span
                                    class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">Scheduled</span>
                            </td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 5 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00077</td>
                            <td class="px-4 py-3">17 May 2025<br><span class="text-xs text-[#a78b6d]">11:15:00</span></td>
                            <td class="px-4 py-3">Dr. Rohan Singh<br><span class="text-xs text-[#a77c52]">Orthopedic</span>
                            </td>
                            <td class="px-4 py-3"><span
                                    class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">In
                                    Queue</span></td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 6 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00078</td>
                            <td class="px-4 py-3">18 May 2025<br><span class="text-xs text-[#a78b6d]">15:00:00</span></td>
                            <td class="px-4 py-3">Dr. Shalini Das<br><span class="text-xs text-[#a77c52]">ENT
                                    Specialist</span></td>
                            <td class="px-4 py-3"><span
                                    class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">Pending</span>
                            </td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                        <!-- Row 7 -->
                        <tr>
                            <td class="px-4 py-3">HTH-00079</td>
                            <td class="px-4 py-3">19 May 2025<br><span class="text-xs text-[#a78b6d]">08:30:00</span></td>
                            <td class="px-4 py-3">Dr. Vikram Patel<br><span
                                    class="text-xs text-[#a77c52]">Neurologist</span></td>
                            <td class="px-4 py-3"><span
                                    class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">Rescheduled</span>
                            </td>
                            <td class="px-4 py-3 space-x-3"><a href="#"
                                    class="text-[#5a3921] hover:underline font-medium">View</a><a href="#"
                                    class="text-[#7d5a3d] hover:underline">Receipt</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection