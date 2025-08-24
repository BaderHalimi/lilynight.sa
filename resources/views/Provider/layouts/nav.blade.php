<header class="bg-white shadow p-4 sticky top-0 z-30 flex justify-between items-center">
                <!-- ✅ زر البرغر الثابت دائمًا -->
                <button @click="openSidebar = !openSidebar"
                    class="absolute top-4 right-4 bg-white z-50 py-2 px-4 rounded-md transition">
                    <i class="ri-menu-3-line text-2xl text-slate-800 hover:text-orange-600"></i>
                </button>
                <div class="flex items-center gap-4 ltr:ml-auto rtl:mr-auto">


                    {{-- @livewire('notif-bell') --}}
                    
                    <div class="flex items-center gap-2">
                        {{-- <span class="text-slate-800 font-bold text-sm hidden md:inline">
                            {{ $user->f_name . " " . $user->l_name ?? 'تاجر غير معروف' }}
                        </span> --}}
                        <img class="h-10 w-10 rounded-full border border-slate-300 object-cover"
                            src=""
                            alt="User">
                    </div>
                </div>
            </header>