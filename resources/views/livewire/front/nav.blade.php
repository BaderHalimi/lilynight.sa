<nav class="fixed top-0 w-full bg-white/80 backdrop-blur-lg border-b border-gray-200/80 z-50 px-[5%]">
    <div class="container mx-auto px-4" bis_skin_checked="1">
        <div class="flex items-center justify-between h-16" bis_skin_checked="1">
            <div class="flex items-center cursor-pointer" bis_skin_checked="1">
                <img alt="شعار ليلة الليليوم الجذاب" class="w-10 h-10 ml-3" src="https://lilium-night.com/wp-content/uploads/2024/07/logo-1-1.png">
                <span class="text-xl font-bold gradient-text">ليلة الليليوم</span>
            </div>
            <div class="hidden md:flex items-center space-x-1 space-x-reverse" bis_skin_checked="1">
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">الخدمات</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">مميزاتنا</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">رحلة مزوّد الخدمة</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">نظام الشركاء</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">الأسعار</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-gray-600 hover:text-primary">لوحات التحكم</button>
                <button class="px-4 py-2 rounded-lg transition-all duration-300 relative font-medium text-primary">عن المنصة
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary" bis_skin_checked="1" style="opacity: 1;"></div>
                </button>
                <a href="{{ route('login') }}" wire:navigate="true" class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 shadow-md h-10 px-4 py-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" x2="3" y1="12" y2="12"></line>
                    </svg>تسجيل الدخول</a>
            </div>
            <button class="md:hidden p-2 text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <line x1="4" x2="20" y1="6" y2="6"></line>
                    <line x1="4" x2="20" y1="18" y2="18"></line>
                </svg></button>
        </div>
    </div>
</nav>
