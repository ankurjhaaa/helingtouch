<!-- Sidebar -->
<aside
    class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white flex-shrink-0 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-700 scrollbar-track-blue-100 transition-all duration-300"
    data-aos="fade-right" data-aos-duration="800">
    <div class="p-3 mt-[50px] text-center">
        <h4 class="text-2xl mt-7 px-2 py-1 font-bold text-center whitespace-nowrap" data-aos="fade-down">Care with Precision</h4>
        <p class="text-sm text-center mb-4 text-blue-200" data-aos="fade-down" data-aos-delay="100">Efficient hospital
            management begins here</p>

    </div>
    <hr class="border-blue-300 mx-4 mb-4">
    <nav class="mb-[50px]">
        <ul class="space-y-2">
            <li data-aos="fade-right" data-aos-delay="200">
                <a href="{{ route('admin.addrole') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add (Doctor, Staff)
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="300">
                <a href="{{ route('admin.department') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <i class="fas fa-building mr-3"></i>
                    Manage Department
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="400">
                <a href="{{ route('admin.manageDoctor') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <i class="fas fa-user-md mr-3"></i>
                    Manage Doctors
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="500">
                <a href="{{ route('admin.docleave') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <i class="fas fa-info-circle mr-3"></i>
                    Doctors Leaves Info
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="600">
                <a href="{{ route('admin.gallery') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <i class="fas fa-images mr-3"></i>
                    Manage Gallery
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="700">
                <a href="#"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Manage Appointments
                </a>
            </li>
            <li data-aos="fade-right" data-aos-delay="800">
                <a href="{{ route('admin.seeting') }}"
                    class="flex items-center px-6 py-3 hover:bg-blue-700 hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z">
                        </path>
                    </svg>
                    Admin Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>