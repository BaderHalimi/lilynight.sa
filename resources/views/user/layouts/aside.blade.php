

<!-- Sidebar كمكون مستقل -->
<aside x-data="sidebarData()" class="fixed top-0 right-0 h-full w-64 bg-white shadow-xl z-40 flex flex-col border-l border-slate-200">
    <!-- Logo -->
    <div class="flex items-center justify-center p-4 border-b bg-white">
        <img alt="شعار ليلة الليليوم" 
             class="w-12 h-12 ml-2 rounded-xl shadow-sm border border-slate-200" 
             src="https://images.unsplash.com/photo-1557845767-9cc6526890f7">
        <h1 class="text-lg font-bold text-slate-700">ليلة الليليوم</h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 mt-4 space-y-6 overflow-y-auto px-4">
        <template x-for="(categoryItems, category) in menuItems" :key="category">
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2" x-text="categoryTitles[category]"></h3>
                <template x-for="item in categoryItems" :key="item.page">
                    <button @click="navigateTo(item.page)" 
                            :class="currentPage === item.page ? 'bg-pink-100 text-pink-600 border-r-2 border-pink-500' : 'text-slate-700 hover:bg-pink-50 hover:text-pink-600'"
                            class="flex items-center w-full rounded-lg font-medium p-3 transition">
                        <i :class="item.icon" class="ml-2 text-lg text-pink-500"></i>
                        <span x-text="item.title"></span>
                    </button>
                </template>
            </div>
        </template>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t">
        <button @click="logout()" class="flex items-center w-full gap-2 text-red-500 hover:bg-red-50 font-semibold rounded-lg p-3 transition">
            <i class="ri-logout-box-line ml-2"></i> تسجيل الخروج
        </button>
    </div>
</aside>

<!-- Main Content -->
<main class="mr-64 p-8" x-data="{ currentPage: window.location.hash.replace('#','') || 'dashboard' }"
      x-init="
        window.addEventListener('hashchange', () => { currentPage = window.location.hash.replace('#','') || 'dashboard'; });
      ">

</main>

<script>
function sidebarData() {
    return {
        currentPage: 'dashboard',

        menuItems: {
            account: [
                { page: 'dashboard', title: 'نظرة عامة', icon: 'ri-home-3-line' },
                { page: 'profile', title: 'ملفي الشخصي', icon: 'ri-user-3-line' }
            ],
            bookings: [
                { page: 'my-bookings', title: 'حجوزاتي', icon: 'ri-calendar-event-line' },
                { page: 'view-dates', title: 'عرض التواريخ', icon: 'ri-calendar-2-line' },
                { page: 'notifications', title: 'الإشعارات وتذاكري', icon: 'ri-notification-3-line' }
            ],
            finance: [
                { page: 'financial-record', title: 'السجل المالي', icon: 'ri-bank-card-line' },
                { page: 'rewards', title: 'المكافآت والنقاط', icon: 'ri-gift-line' }
            ],
            support: [
                { page: 'reviews', title: 'التقييمات وتجربتي', icon: 'ri-star-smile-line' },
                { page: 'support', title: 'الدعم والمساعدة', icon: 'ri-customer-service-2-line' },
                { page: 'contracts', title: 'العقود', icon: 'ri-file-list-3-line' }
            ],
            contracts: [
                { page: 'contract-management', title: 'إدارة العقود الإلكترونية', icon: 'ri-file-edit-line' },
                { page: 'contract-templates', title: 'قوالب عقود مخصصة', icon: 'ri-edit-line' }
            ],
            analytics: [
                { page: 'customer-reviews', title: 'تقييمات العملاء والردود', icon: 'ri-star-line' },
                { page: 'internal-evaluation', title: 'تقييم داخلي للعملاء', icon: 'ri-user-check-line' },
                { page: 'performance-reports', title: 'تقارير الأداء والتحليلات', icon: 'ri-bar-chart-line' },
                { page: 'ai-analytics', title: 'التحليلات المتقدمة والذكاء الاصطناعي', icon: 'ri-brain-line' }
            ],
            team: [
                { page: 'team-management', title: 'إدارة الموظفين والمساعدين', icon: 'ri-team-line' },
                { page: 'activity-log', title: 'سجل نشاط الفريق', icon: 'ri-history-line' }
            ],
            marketing: [
                { page: 'temporary-offers', title: 'العروض المؤقتة', icon: 'ri-time-line' },
                { page: 'coupons', title: 'إنشاء كوبونات وعروض', icon: 'ri-coupon-line' },
                { page: 'dynamic-pricing', title: 'التسعير الديناميكي (تجريبي)', icon: 'ri-price-tag-line' },
                { page: 'social-media', title: 'ربط ومشاركة عبر السوشيال ميديا', icon: 'ri-share-line' },
                { page: 'email-campaigns', title: 'حملات بريدية للعملاء', icon: 'ri-mail-line' },
                { page: 'loyalty-program', title: 'برنامج ولاء العملاء', icon: 'ri-heart-line' }
            ],
            security: [
                { page: 'login-settings', title: 'إعدادات تسجيل الدخول الآمن', icon: 'ri-shield-line' },
                { page: 'login-history', title: 'سجل الدخول للحساب', icon: 'ri-login-box-line' },
                { page: 'error-review', title: 'مراجعة الأخطاء والمشاكل', icon: 'ri-error-warning-line' }
            ],
            help: [
                { page: 'help-center', title: 'مركز المساعدة وقاعدة المعرفة', icon: 'ri-book-open-line' },
                { page: 'support-ticket', title: 'فتح تذكرة دعم فني', icon: 'ri-customer-service-line' },
                { page: 'faq', title: 'الأسئلة الشائعة', icon: 'ri-question-line' }
            ],
            customization: [
                { page: 'branding', title: 'الألوان، الشعار، والغلاف', icon: 'ri-palette-line' },
                { page: 'service-order', title: 'ترتيب عرض الخدمات والباقات', icon: 'ri-list-ordered' },
                { page: 'about-section', title: 'إضافة قسم "نبذة عنا"', icon: 'ri-information-line' }
            ],
            settings: [
                { page: 'branch-management', title: 'إدارة الفروع (إذا متعددة)', icon: 'ri-git-branch-line' },
                { page: 'check-in', title: 'التحقق من الحضور (Check-in)', icon: 'ri-qr-code-line' },
                { page: 'pos-system', title: 'نظام البيع الداخلي (POS)', icon: 'ri-printer-line' },
                { page: 'corporate-booking', title: 'نظام حجز الشركات', icon: 'ri-building-line' },
                { page: 'platform-policies', title: 'السياسات العامة للمنصة', icon: 'ri-settings-line' },
                { page: 'languages', title: 'اللغات والترجمة للمحتوى', icon: 'ri-global-line' },
                { page: 'api-integration', title: 'الربط البرمجي (API)', icon: 'ri-code-line' },
                { page: 'message-center', title: 'مركز الرسائل مع العملاء', icon: 'ri-message-line' }
            ]
        },

        categoryTitles: {
            account: 'حسابي',
            bookings: 'الحجوزات والتذاكر',
            finance: 'المالية والمكافآت',
            support: 'التفاعل والمساعدة',
            contracts: 'العقود والتواقيع',
            analytics: 'التقييمات والتقارير',
            team: 'إدارة الفريق والصلاحيات',
            marketing: 'التسويق والعروض',
            security: 'الأمان والتحكم',
            help: 'الدعم الفني والمساعدة',
            customization: 'تخصيص مظهر الصفحة العامة',
            settings: 'إعدادات وميزات إضافية'
        },

        navigateTo(page) {
            this.currentPage = page;
            window.location.hash = '#' + page;
        },

        logout() {
            if (confirm('هل أنت متأكد من تسجيل الخروج؟')) {
                alert('تم تسجيل الخروج بنجاح');
            }
        }
    }
}

// دالة لمحتوى الـ main content
function getPageTitle(page) {
    // بحث في جميع العناصر للعثور على العنوان
    const allItems = Object.values(sidebarData().menuItems).flat();
    const found = allItems.find(i => i.page === page);
    return found ? found.title : 'لوحة التحكم';
}
</script>

</body>
</html>
