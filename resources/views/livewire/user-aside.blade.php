<!-- Sidebar -->
<aside class="fixed top-0 right-0 h-full w-72 bg-white shadow-xl z-40 flex flex-col border-l border-slate-200">
    <!-- Logo -->
    <div class="flex items-center justify-center p-4 border-b bg-white">
        <img alt="شعار ليلة الليليوم"
             class="w-12 h-12 ml-2 rounded-xl shadow-sm border border-slate-200"
             src="https://images.unsplash.com/photo-1557845767-9cc6526890f7">
        <h1 class="text-lg font-bold text-slate-700">ليلة الليليوم</h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 mt-4 space-y-6 overflow-y-auto px-4">
        <!-- حسابي -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">حسابي</h3>
            <a href=""
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-home-3-line ml-2 text-lg text-pink-500"></i>
                نظرة عامة
            </a>
            <a href="{{ route('user.Dashboard.profile.index') }}"
            wire:navigate
            class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600
                   {{ request()->routeIs('user.Dashboard.profile.index') ? 'bg-pink-50 text-pink-600' : '' }}">
             <i class="ri-user-3-line ml-2 text-lg text-pink-500"></i>
             ملفي الشخصي
         </a>
         

         <a href="{{ route('user.Dashboard.workplace.index') }}"
         wire:navigate
         class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600
                {{ request()->routeIs('user.Dashboard.workplace.index') ? 'bg-pink-50 text-pink-600' : '' }}">
                <i class="ri-briefcase-line ml-2 text-lg text-pink-500"></i>
                مكان العمل
      </a>
        </div>

        <!-- الحجوزات -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">الحجوزات</h3>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-calendar-event-line ml-2 text-lg text-pink-500"></i>
                حجوزاتي
            </a>
        </div>

        <!-- المالية -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">المالية</h3>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-bank-card-line ml-2 text-lg text-pink-500"></i>
                السجل المالي
            </a>
        </div>

        <!-- الدعم -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">الدعم والمساعدة</h3>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-customer-service-2-line ml-2 text-lg text-pink-500"></i>
                الدعم والمساعدة
            </a>
        </div>

        <!-- التقييمات -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">التفاعل</h3>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-star-smile-line ml-2 text-lg text-pink-500"></i>
                التقييمات وتجربتي
            </a>
        </div>

        <!-- الإعدادات -->
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">الإعدادات</h3>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-settings-line ml-2 text-lg text-pink-500"></i>
                الإعدادات العامة
            </a>
            <a href="#"
               wire:navigate
               class="flex items-center w-full rounded-lg font-medium p-3 transition hover:bg-pink-50 hover:text-pink-600">
                <i class="ri-message-line ml-2 text-lg text-pink-500"></i>
                مركز الرسائل
            </a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t">
        <button wire:click.prevent="logout" class="flex items-center w-full gap-2 text-red-500 hover:bg-red-50 font-semibold rounded-lg p-3 transition">
            <i class="ri-logout-box-line ml-2"></i> تسجيل الخروج
        </button>
    </div>
</aside>

