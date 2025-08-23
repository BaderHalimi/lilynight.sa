@extends('layouts.app')
@section('content')
<main>
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden hero-pattern px-[5%]">
        <div class="absolute inset-0 bg-primary/5" bis_skin_checked="1"></div>
        <div class="container mx-auto px-4 relative z-10" bis_skin_checked="1">
            <div class="text-center max-w-4xl mx-auto" bis_skin_checked="1" style="opacity: 1; transform: none;">
                <div class="mb-8" bis_skin_checked="1" style="opacity: 1; transform: none;"><img class="w-32 h-32 mx-auto mb-6 floating-animation" alt="شعار ليلة الليليوم المتألق" src="https://images.unsplash.com/photo-1557845767-9cc6526890f7"></div>
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 text-primary">ليلة الليليوم</h1>
                <p class="text-xl md:text-2xl text-slate-700 mb-8 leading-relaxed">منصتك الرقمية الشاملة لتنظيم أروع المناسبات</p>
                <p class="text-lg text-slate-500 mb-12 max-w-2xl mx-auto">نجمع بين العملاء ومزوّدي الخدمات بأسلوب عصري، سهل، وآمن. نهدف إلى تبسيط كل ما يتعلق بالحفلات والفعاليات، من الحجز وحتى التقييم، عبر تجربة رقمية متكاملة.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" bis_skin_checked="1" style="opacity: 1; transform: none;"><button class="inline-flex items-center justify-center ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 h-11 rounded-lg bg-primary text-white px-10 py-6 text-lg font-semibold pulse-glow shadow-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-5 w-5">
                            <path d="m15 18-6-6 6-6"></path>
                        </svg>اكتشف الخدمات الآن</button><button class="inline-flex items-center justify-center ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-background h-11 rounded-lg border-2 border-primary text-primary hover:bg-primary hover:text-white px-10 py-6 text-lg font-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 h-5 w-5">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>انضم كمزوّد خدمة</button></div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50 px-[5%]">
        <div class="container mx-auto px-4" bis_skin_checked="1">
            <div class="text-center mb-16" bis_skin_checked="1" style="opacity: 1; transform: none;">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-primary">لماذا ليلة الليليوم؟</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">نوفر لك كل ما تحتاجه لتنظيم مناسبات لا تُنسى، مع التركيز على الجودة والابتكار.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" bis_skin_checked="1">
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                            <path d="M2 12h20"></path>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">منصة شاملة ومتكاملة</h3>
                    <p class="text-slate-600 leading-relaxed">كل ما تحتاجه لتنظيم مناسبتك في مكان واحد، من الحجز إلى التقييم.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                            <path d="M12 18h.01"></path>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">تجربة رقمية عصرية</h3>
                    <p class="text-slate-600 leading-relaxed">تصميم سهل الاستخدام ومتجاوب مع جميع الأجهزة لتجربة حجز سلسة.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">أمان وموثوقية عالية</h3>
                    <p class="text-slate-600 leading-relaxed">نظام حماية متقدم لبياناتك ومدفوعاتك، مع عقود إلكترونية آمنة.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">حلول تقنية ذكية</h3>
                    <p class="text-slate-600 leading-relaxed">أدوات للحجز، الدفع، التمويل، إدارة المخزون، والتسويق بذكاء.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                            <polyline points="16 7 22 7 22 13"></polyline>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">تقارير وتحليلات</h3>
                    <p class="text-slate-600 leading-relaxed">إحصائيات دقيقة لمزوّدي الخدمات لمتابعة الأداء واتخاذ قرارات أفضل.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover cursor-pointer text-center" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 mx-auto shadow-md" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <circle cx="12" cy="8" r="6"></circle>
                            <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                        </svg></div>
                    <h3 class="text-xl font-bold mb-4 text-slate-800">دعم لكافة المناسبات</h3>
                    <p class="text-slate-600 leading-relaxed">من حفلات الزفاف إلى فعاليات الشركات، نلبي جميع احتياجاتك.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-white px-[5%]">
        <div class="container mx-auto px-4" bis_skin_checked="1">
            <div class="text-center mb-16" bis_skin_checked="1" style="opacity: 1; transform: none;">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-primary">خدماتنا المتكاملة للمناسبات</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">حلول شاملة ومصممة خصيصاً لتلبية جميع احتياجاتك في تنظيم وإدارة مناسباتك السعيدة.</p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8" bis_skin_checked="1">
                <div class="bg-primary/5 p-8 rounded-3xl border border-primary/10 card-hover cursor-pointer" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 shadow-lg" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <path d="M5.8 11.3 2 22l10.7-3.79"></path>
                            <path d="M4 3h.01"></path>
                            <path d="M22 8h.01"></path>
                            <path d="M15 2h.01"></path>
                            <path d="M22 20h.01"></path>
                            <path d="m22 2-2.24.75a2.9 2.9 0 0 0-1.96 3.12v0c.1.86-.57 1.63-1.45 1.63h-.38c-.86 0-1.6.6-1.76 1.44L14 10"></path>
                            <path d="m22 13-.82-.33c-.86-.34-1.82.2-1.98 1.11v0c-.11.7-.72 1.22-1.43 1.22H17"></path>
                            <path d="m11 2 .33.82c.34.86-.2 1.82-1.11 1.98v0C9.52 4.9 9 5.52 9 6.23V7"></path>
                            <path d="M11 13c1.93 1.93 2.83 4.17 2 5-.83.83-3.07-.07-5-2-1.93-1.93-2.83-4.17-2-5 .83-.83 3.07.07 5 2Z"></path>
                        </svg></div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-800">حفلات الزفاف والمناسبات</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">قاعات، تصوير، تجميل، ضيافة، وكل ما يلزم لليلة العمر.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>حجز قاعات وقصور</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>خدمات تصوير وتجميل</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>تنسيق زهور ودعوات</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>ضيافة وبوفيهات فاخرة</li>
                    </ul>
                </div>
                <div class="bg-primary/5 p-8 rounded-3xl border border-primary/10 card-hover cursor-pointer" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 shadow-lg" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg></div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-800">فعاليات الشركات</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">تنظيم احترافي لفعاليات الشركات، عشاء العمل، واحتفالات الموظفين.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>حجز قاعات اجتماعات</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>خدمات إعاشة متكاملة</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>تنظيم لوجستي وترفيهي</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>تغطية إعلامية وتصوير</li>
                    </ul>
                </div>
                <div class="bg-primary/5 p-8 rounded-3xl border border-primary/10 card-hover cursor-pointer" bis_skin_checked="1" style="opacity: 1; transform: none;">
                    <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center mb-6 shadow-lg" bis_skin_checked="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-white">
                            <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                            <path d="M12 8v13"></path>
                            <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
                            <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
                        </svg></div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-800">المناسبات الخاصة</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">تخطيط وتنفيذ حفلات التخرج، أعياد الميلاد، وغيرها من المناسبات السعيدة.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>تنسيق ديكورات وثيمات</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>خدمات ترفيهية متنوعة</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>تأجير مستلزمات الحفلات</li>
                        <li class="flex items-center text-slate-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-500 ml-3 flex-shrink-0">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>حلويات وكيكات مخصصة</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50 px-[5%]">
        <div class="container mx-auto px-4" bis_skin_checked="1">
            <div class="text-center mb-16" bis_skin_checked="1" style="opacity: 1; transform: translateY(30px) translateZ(0px);">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-primary">شركاء النجاح</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">نثق بشركائنا الذين يشاركوننا الرؤية في تقديم أفضل الحلول التقنية لمزوّدي الخدمات وعملائهم في عالم المناسبات.</p>
            </div>
            <div class="relative" bis_skin_checked="1">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8" bis_skin_checked="1">
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="مبتكرون عالميون" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">مبتكرون عالميون</h3>
                        <p class="text-xs text-slate-500">شريك استراتيجي في الابتكار التقني للمناسبات</p>
                    </div>
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="حلول المستقبل" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">حلول المستقبل</h3>
                        <p class="text-xs text-slate-500">حلول دفع آمنة وموثوقة للمناسبات</p>
                    </div>
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="عقول إبداعية" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">عقول إبداعية</h3>
                        <p class="text-xs text-slate-500">خبراء في تصميم تجارب مستخدم فريدة للمناسبات</p>
                    </div>
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="رواد التقنية" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">رواد التقنية</h3>
                        <p class="text-xs text-slate-500">رواد في تطوير البنية التحتية لفعاليات ضخمة</p>
                    </div>
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="فعاليات الجيل القادم" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">فعاليات الجيل القادم</h3>
                        <p class="text-xs text-slate-500">شريك في تنظيم الفعاليات الكبرى والمهرجانات</p>
                    </div>
                    <div class="flex flex-col items-center text-center" bis_skin_checked="1" style="opacity: 1; transform: scale(0.8) translateZ(0px);">
                        <div class="w-24 h-24 rounded-full bg-white shadow-lg border-2 border-primary/20 flex items-center justify-center mb-4" bis_skin_checked="1"><img class="w-16 h-16 object-contain" alt="رأس مال استثماري" src="https://images.unsplash.com/photo-1639168314917-53ecd2e3135c"></div>
                        <h3 class="font-bold text-slate-700">رأس مال استثماري</h3>
                        <p class="text-xs text-slate-500">دعم استثماري لتوسيع أعمال تنظيم المناسبات</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-primary text-white px-[5%]">
        <div class="container mx-auto px-4 text-center" bis_skin_checked="1">
            <div bis_skin_checked="1" style="opacity: 1; transform: none;">
                <h2 class="text-4xl font-bold mb-6">هل أنت جاهز لتنظيم مناسبتك القادمة؟</h2>
                <p class="text-xl mb-10 max-w-2xl mx-auto opacity-90">انضم إلى عملائنا السعداء ومزوّدي الخدمات المتميزين الذين يثقون في ليلة الليليوم.</p><button class="inline-flex items-center justify-center ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-11 rounded-lg bg-white text-primary hover:bg-gray-100 px-10 py-6 text-lg font-bold shadow-2xl transform hover:scale-105 transition-transform"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 h-5 w-5">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                        <path d="M13 5v2"></path>
                        <path d="M13 17v2"></path>
                        <path d="M13 11v2"></path>
                    </svg>ابدأ الآن</button>
            </div>
        </div>
    </section>
</main>

@endsection
