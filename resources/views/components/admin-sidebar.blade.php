<div>
   <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white h-full flex-shrink-0">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-center">Healing Touch</h1>
            <p class="text-sm text-center text-blue-200">Hospital Management</p>
        </div>
        <nav class="mt-6">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.addrole') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add (Doctor, Staff)
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.department') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                       <i class="fas fa-building me-2"></i>
                       Manage department
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.manageDoctor') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                         <i class="fas fa-user-md me-2"></i>
                        Manage Doctors
                    </a>
                </li>
                 <li>
                    <a href="{{ route('admin.gallery') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                         <i class="fas fa-images me-2"></i>
                        Manage Gallery
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Manage Appointments
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.seeting') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path>
                        </svg>
                        Admin Settings
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</div>