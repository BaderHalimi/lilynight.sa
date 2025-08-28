<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div class="flex-1 p-4 sm:p-6 lg:p-8" x-data="{ activeTab: 'venues', activeModal: 'service', openModalServices: false }">
    <div x-cloak class="relative" id="serviceModal">

        <div x-show="openModalServices" x-data="{
            options: [],
            addons: [],
            addOption() { this.options.push('') },
            removeOption(i) { this.options.splice(i, 1) },
            addAddon() { this.addons.push({ name: '', price: '' }) },
            removeAddon(i) { this.addons.splice(i, 1) },
            onDemandGlobal: false
        }"
            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50" x-transition>

            <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl p-6 relative overflow-y-auto max-h-[90vh]"
                @click.away="openModalServices=false">

                <!-- رأس -->
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold text-slate-700 flex items-center gap-2">
                        <i class="ri-tools-line text-pink-500"></i> إنشاء خدمة جديدة
                    </h2>
                    <button @click="openModalServices=false"
                        class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
                </div>

                <!-- التابات -->
                <div class="flex flex-wrap gap-2 border-b mb-4">
                    <template
                        x-for="tab in [
        {id:'service',label:'الخدمة',icon:'ri-briefcase-4-line'},
        {id:'details',label:'الوصف',icon:'ri-file-text-line'},
        {id:'pricing',label:'التسعير',icon:'ri-price-tag-3-line'},
        {id:'features',label:'المميزات',icon:'ri-star-line'},
        {id:'gallery',label:'المعرض',icon:'ri-image-line'},
        {id:'options',label:'الخيارات',icon:'ri-settings-3-line'},
        {id:'addons',label:'الإضافات',icon:'ri-play-list-add-line'},
        {id:'availability',label:'الأيام والأوقات',icon:'ri-calendar-2-line'}
      ]">
                        <button @click="activeModal=tab.id"
                            :class="activeModal === tab.id ? 'bg-pink-500 text-white' : 'bg-slate-100 text-slate-600'"
                            class="px-4 py-2 rounded-t-lg font-medium transition-all flex items-center gap-2">
                            <i :class="tab.icon"></i> <span x-text="tab.label"></span>
                        </button>
                    </template>
                </div>

                <!-- المحتوى -->
                <div class="p-4 space-y-4">

                    <!-- الخدمة -->
                    <div x-show="activeModal==='service'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">اسم الخدمة</label>
                        <input id="service_name" type="text" class="w-full border rounded-lg px-3 py-2 mb-3">
                        <label class="block text-slate-600 mb-1">الصورة الرئيسية</label>
                        <input type="file" id="service_main_image" accept=".png,.jpg,.jpeg,.gif"
                            class="w-full border rounded-lg px-3 py-2 mb-3">
                        <label class="block text-slate-600 mb-1">التصنيف</label>
                        <select id="service_category" class="w-full border rounded-lg px-3 py-2">
                            <option>اختيار تصنيف</option>
                            <option>تجميل</option>
                            <option>صحة</option>
                            <option>تصوير</option>
                        </select>
                    </div>

                    <!-- الوصف -->
                    <div x-show="activeModal==='details'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">الوصف</label>
                        <textarea id="service_description" class="w-full border rounded-lg px-3 py-2" rows="5"></textarea>
                    </div>

                    <!-- التسعير -->
                    <div x-show="activeModal==='pricing'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">السعر</label>
                        <input id="service_price" type="number" class="w-full border rounded-lg px-3 py-2 mb-3">
                        <label class="block text-slate-600 mb-1">عملة</label>
                        <select id="service_currency" class="w-full border rounded-lg px-3 py-2">
                            <option>دولار</option>
                            <option>يورو</option>
                            <option>دينار</option>
                        </select>
                    </div>

                    <!-- المميزات -->
                    <div x-show="activeModal==='features'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">المميزات</label>
                        <textarea id="service_features" class="w-full border rounded-lg px-3 py-2" rows="4"></textarea>
                    </div>

                    <!-- المعرض -->
                    <div x-show="activeModal==='gallery'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">رفع الصور</label>
                        <input id="service_gallery" type="file" multiple class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- الخيارات -->
                    <div x-show="activeModal==='options'" x-transition.duration.400ms>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-slate-600">الخيارات المتاحة</p>
                            <button @click="addOption"
                                class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                <i class="ri-add-line"></i> إضافة خيار
                            </button>
                        </div>
                        <template x-for="(option,i) in options" :key="i">
                            <div class="flex items-center gap-2 mb-2">
                                <input :id="`optionServices_${i}`" type="text" placeholder="اكتب خيار"
                                    class="flex-1 border rounded-lg px-3 py-2">
                                <button @click="removeOption(i)" class="text-red-500 hover:text-red-700">
                                    <i class="ri-close-line text-xl"></i>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- الإضافات -->
                    <div x-show="activeModal==='addons'" x-transition.duration.400ms>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-slate-600">الإضافات</p>
                            <button @click="addAddon"
                                class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                <i class="ri-add-line"></i> إضافة
                            </button>
                        </div>
                        <template x-for="(addon,i) in addons" :key="i">
                            <div class="flex items-center gap-2 mb-2">
                                <input :id="`addon_nameServices_${i}`" type="text" placeholder="اسم الإضافة"
                                    class="flex-1 border rounded-lg px-3 py-2">
                                <input :id="`addon_priceServices_${i}`" type="number" placeholder="السعر"
                                    class="w-32 border rounded-lg px-3 py-2">
                                <button @click="removeAddon(i)" class="text-red-500 hover:text-red-700">
                                    <i class="ri-close-line text-xl"></i>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- الأيام والأوقات -->
                    <div x-show="activeModal==='availability'" x-transition.duration.400ms>
                        <p class="text-slate-600 mb-3">حدد أيام وساعات العمل:</p>

                        <!-- خيار عام: حسب الطلب -->
                        <label class="flex items-center gap-2 mb-4">
                            <input id="on_demand" type="checkbox" x-model="onDemandGlobal" class="rounded">
                            <span>حسب الطلب (On Demand)</span>
                        </label>

                        <!-- جدول الأيام -->
                        <div x-show="!onDemandGlobal" class="overflow-x-auto">
                            <table id="servisesTable" class="w-full border text-sm text-slate-700">
                                <thead class="bg-slate-100 text-slate-600">
                                    <tr>
                                        <th class="px-3 py-2 text-right">اليوم</th>
                                        <th class="px-3 py-2 text-center">من</th>
                                        <th class="px-3 py-2 text-center">إلى</th>
                                        <th class="px-3 py-2 text-center">تفعيل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template
                                        x-for="(Serviceday,idx) in ['السبت','الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة']"
                                        :key="Serviceday">
                                        <tr class="border-t">
                                            <td class="px-3 py-2 font-medium" x-text="Serviceday"></td>
                                            <td class="px-3 py-2 text-center">
                                                <input :id="`Serviceday_${idx}_from`" type="time"
                                                    class="border rounded-lg px-2 py-1">
                                            </td>
                                            <td class="px-3 py-2 text-center">
                                                <input :id="`Serviceday_${idx}_to`" type="time"
                                                    class="border rounded-lg px-2 py-1">
                                            </td>
                                            <td class="px-3 py-2 text-center">
                                                <input :id="`Serviceday_${idx}_active`" type="checkbox"
                                                    class="rounded">
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- أزرار -->
                <div class="flex justify-between mt-6 border-t pt-3">
                    <button @click="openModalServices=false"
                        class="px-4 py-2 bg-slate-200 rounded-lg hover:bg-slate-300">إلغاء</button>
                    <button id="saveService"
                        class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">حفظ</button>
                </div>

            </div>
        </div>


    </div>

    <div class="space-y-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <h1 class="text-3xl font-bold text-slate-800">إدارة الخدمات والباقات</h1>
            <button @click="openModalServices = true"
                class="inline-flex items-center justify-center rounded-lg text-sm font-semibold bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 text-white">
                <i class="ri-add-circle-line text-lg ml-2"></i>
                إضافة باقة أو خدمة جديدة
            </button>
        </div>

        <!-- Tabs -->
        <div class="w-full">
            <div id="tabs"
                class="grid w-full grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-2 p-2 bg-primary/10 rounded-xl mb-6">
                <button @click="activeTab='venues'" :class="{ 'active': activeTab==='venues' }" class="tab-btn">
                    <i class="ri-building-2-line text-lg"></i>
                    <span>القاعات والقصور</span>
                </button>
                <button @click="activeTab='catering'" :class="{ 'active': activeTab==='catering' }" class="tab-btn">
                    <i class="ri-restaurant-2-line text-lg"></i>
                    <span>الإعاشة والبوفيه</span>
                </button>
                <button @click="activeTab='photography'" :class="{ 'active': activeTab==='photography' }"
                    class="tab-btn">
                    <i class="ri-camera-line text-lg"></i>
                    <span>التصوير والفيديو</span>
                </button>
                <button @click="activeTab='beauty'" :class="{ 'active': activeTab==='beauty' }" class="tab-btn">
                    <i class="ri-magic-line text-lg"></i>
                    <span>التجميل والمكياج</span>
                </button>
                <button @click="activeTab='entertainment'" :class="{ 'active': activeTab==='entertainment' }"
                    class="tab-btn">
                    <i class="ri-music-2-line text-lg"></i>
                    <span>العروض الترفيهية</span>
                </button>
                <button @click="activeTab='transportation'" :class="{ 'active': activeTab==='transportation' }"
                    class="tab-btn">
                    <i class="ri-bus-line text-lg"></i>
                    <span>النقل والمواصلات</span>
                </button>
                <button @click="activeTab='security'" :class="{ 'active': activeTab==='security' }" class="tab-btn">
                    <i class="ri-shield-keyhole-line text-lg"></i>
                    <span>الحراسة والأمن</span>
                </button>
                <button @click="activeTab='flowers_invitations'"
                    :class="{ 'active': activeTab==='flowers_invitations' }" class="tab-btn">
                    <i class="ri-flower-line text-lg"></i>
                    <span>الورود والدعوات</span>
                </button>
            </div>

            <!-- محتويات التابات -->
            <div class="space-y-4">
                <div x-show="activeTab==='venues'" x-transition.duration.500ms class="tab-content">
                    <div style="opacity: 1; transform: none;">
                        <div
                            class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                            <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال القاعات والقصور</h3>
                                <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا المجال.
                                </p>
                            </div>
                            <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                <div class="space-y-4">
                                    <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع المدعومة
                                    </h2>
                                    <ul class="space-y-3">
                                        <li class="flex items-center gap-3 text-slate-600">
                                            <div
                                                class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-3 h-3 text-primary">
                                                    <path
                                                        d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                    </path>
                                                    <path d="M13 5v2"></path>
                                                    <path d="M13 17v2"></path>
                                                    <path d="M13 11v2"></path>
                                                </svg>
                                            </div><span>قاعة زفاف</span>
                                        </li>
                                        <li class="flex items-center gap-3 text-slate-600">
                                            <div
                                                class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-3 h-3 text-primary">
                                                    <path
                                                        d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                    </path>
                                                    <path d="M13 5v2"></path>
                                                    <path d="M13 17v2"></path>
                                                    <path d="M13 11v2"></path>
                                                </svg>
                                            </div><span>قصر أفراح</span>
                                        </li>
                                        <li class="flex items-center gap-3 text-slate-600">
                                            <div
                                                class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-3 h-3 text-primary">
                                                    <path
                                                        d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                    </path>
                                                    <path d="M13 5v2"></path>
                                                    <path d="M13 17v2"></path>
                                                    <path d="M13 11v2"></path>
                                                </svg>
                                            </div><span>استراحة للمناسبات</span>
                                        </li>
                                        <li class="flex items-center gap-3 text-slate-600">
                                            <div
                                                class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-3 h-3 text-primary">
                                                    <path
                                                        d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                    </path>
                                                    <path d="M13 5v2"></path>
                                                    <path d="M13 17v2"></path>
                                                    <path d="M13 11v2"></path>
                                                </svg>
                                            </div><span>منتجع خاص</span>
                                        </li>
                                        <li class="flex items-center gap-3 text-slate-600">
                                            <div
                                                class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-3 h-3 text-primary">
                                                    <path
                                                        d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                    </path>
                                                    <path d="M13 5v2"></path>
                                                    <path d="M13 17v2"></path>
                                                    <path d="M13 11v2"></path>
                                                </svg>
                                            </div><span>صالة متعددة الأغراض</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                    <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات الخاصة
                                    </h2>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3 text-slate-600"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg><span>تحديد السعة والمساحة</span></li>
                                        <li class="flex items-start gap-3 text-slate-600"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg><span>إدارة المرافق (صوتيات، إضاءة، مواقف)</span></li>
                                        <li class="flex items-start gap-3 text-slate-600"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg><span>تقويم حجوزات متقدم</span></li>
                                        <li class="flex items-start gap-3 text-slate-600"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg><span>إمكانية إضافة صور وفيديوهات للقاعة</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                    class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M8 12h8"></path>
                                        <path d="M12 8v8"></path>
                                    </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='catering'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-catering" id="radix-:rpt:-content-catering"
                        tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال الإعاشة والبوفيه</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>بوفيه مفتوح (غداء/عشاء)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>قوائم طعام مخصصة</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>خدمات ضيافة (قهوة وشاي)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>كيك وحلويات للمناسبات</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد عدد الأفراد</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>اختيار أنواع الأطباق والمشروبات</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>إدارة الحساسية الغذائية</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تنسيق طاولات الطعام والديكور</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='photography'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-photography" id="radix-:rpt:-content-photography"
                        tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال التصوير والفيديو</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تصوير فوتوغرافي (زفاف، خطوبة، تخرج)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تصوير فيديو احترافي</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تصوير جوي (درون)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>ألبوم صور فاخر</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد عدد ساعات التغطية</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>اختيار المصور/المصورة</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>معرض أعمال سابق</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تسليم المواد بجودة عالية</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='beauty'" x-show="activeTab==='beauty'" x-transition.duration.500ms
                    class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-beauty" id="radix-:rpt:-content-beauty" tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال التجميل والمكياج</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>مكياج عروس</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تسريحات شعر</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>خدمات تجميل شاملة (مانيكير، باديكير)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>باكجات عناية بالبشرة</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>اختيار خبيرة التجميل</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد نوع المكياج والتسريحة</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>إمكانية الحجز في الصالون أو المنزل</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>استخدام منتجات عالية الجودة</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='entertainment'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-entertainment" id="radix-:rpt:-content-entertainment"
                        tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال العروض الترفيهية</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>فرق موسيقية (DJ, فرقة شعبية)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>عروض ضوئية وصوتية</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>فقرات ترفيهية (ألعاب نارية، عروض بهلوانية)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تأجير معدات صوت وإضاءة</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد نوع العرض ومدته</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>اختيار الفنانين أو الفرقة</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تنسيق مع متطلبات المكان</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>توفير المعدات اللازمة</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='transportation'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-transportation" id="radix-:rpt:-content-transportation"
                        tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال النقل والمواصلات</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>سيارات فاخرة للعروسين</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>حافلات لنقل الضيوف</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>خدمات صف السيارات (Valet Parking)</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد نوع وعدد السيارات</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد مسار الرحلة والمواعيد</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>سائقين محترفين</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تأمين شامل للركاب</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='security'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-security" id="radix-:rpt:-content-security"
                        tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال الحراسة والأمن</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>حراس أمن للمناسبات</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تأمين مداخل ومخارج القاعة</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>كاميرات مراقبة</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تحديد عدد الحراس المطلوبين</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تنسيق خطة أمنية للمكان</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>فرق مدربة ومؤهلة</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab==='flowers_invitations'" x-transition.duration.500ms class="tab-content">
                    <div data-state="active" data-orientation="horizontal" role="tabpanel"
                        aria-labelledby="radix-:rpt:-trigger-flowers_invitations"
                        id="radix-:rpt:-content-flowers_invitations" tabindex="0"
                        class="mt-4 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                        <div style="opacity: 1; transform: none;">
                            <div
                                class="rounded-xl border bg-white text-slate-900 overflow-hidden shadow-lg border-t-4 border-primary">
                                <div class="flex flex-col space-y-1.5 p-6 bg-slate-50">
                                    <h3 class="font-semibold tracking-tight text-2xl">تفاصيل مجال الورود والدعوات</h3>
                                    <p class="text-sm text-slate-500">استعرض الأنواع المدعومة والمميزات الخاصة بهذا
                                        المجال.</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 p-6">
                                    <div class="space-y-4">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">🧩 الأنواع
                                            المدعومة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تنسيق زهور (كوشة، طاولات)</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>باقات ورد للعروس</span>
                                            </li>
                                            <li class="flex items-center gap-3 text-slate-600">
                                                <div
                                                    class="w-5 h-5 bg-primary/20 rounded-md flex items-center justify-center shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-3 h-3 text-primary">
                                                        <path
                                                            d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                                        </path>
                                                        <path d="M13 5v2"></path>
                                                        <path d="M13 17v2"></path>
                                                        <path d="M13 11v2"></path>
                                                    </svg>
                                                </div><span>تصميم وطباعة بطاقات دعوة</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-4 md:border-r md:border-slate-200 md:pr-8">
                                        <h2 class="font-bold text-lg text-slate-700 mb-4 border-b pb-2">⭐ المميزات
                                            الخاصة</h2>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>اختيار أنواع الزهور والألوان</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>تصاميم مبتكرة للدعوات</span></li>
                                            <li class="flex items-start gap-3 text-slate-600"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-5 h-5 text-amber-400 mt-0.5 shrink-0">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg><span>توصيل في الوقت المحدد</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-center bg-slate-50 p-4 flex justify-start"><button
                                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 ml-2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 12h8"></path>
                                            <path d="M12 8v8"></path>
                                        </svg>إنشاء باقة/خدمة جديدة في هذا المجال</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6">
                <div class="relative w-full mb-4">
                    <input type="text" id="serviceSearch" autocomplete="off" placeholder="ابحث عن خدمة..."
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="ri-search-line text-lg"></i>
                    </span>
                </div>

                <div id="servicesContainer"></div>
            </div>



        </div>
    </div>
</div>
@php
    $RouteAddService = route('provider.Dashboard.ProviderServices.store');
    $RouteGetServices = route('provider.Dashboard.ServicesGet', $provider->id);
    $RouteUpdateService = route('provider.Dashboard.ProviderServices.update', ':id');
    $RouteDeleteService = route('provider.Dashboard.ProviderServices.destroy', ':id');

@endphp
<style>
    .tab-btn {
        @apply inline-flex flex-col sm:flex-row items-center justify-center gap-2 rounded-lg px-3 py-2.5 font-medium text-sm transition-all bg-white text-slate-600 hover:bg-slate-200 relative;
    }

    .tab-btn.active {
        @apply bg-primary text-white shadow-md;
    }

    .tab-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 4px;
        width: 100%;
        background: linear-gradient(to right, #ff3377, #ff66a3);
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease-in-out;
    }

    .tab-btn.active::before {
        transform: scaleX(1);
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ---- Helpers ----
        function runWhenAlpineReady(el, cb, timeout = 2000) {
            // wait until el.__x exists (Alpine initialized), then call cb
            const start = Date.now();
            (function check() {
                if (el && el.__x) return cb(el.__x);
                if (Date.now() - start > timeout) return cb(null);
                setTimeout(check, 50);
            })();
        }

        function safeQuery(selector) {
            try {
                return document.querySelector(selector);
            } catch (e) {
                return null;
            }
        }

        // ---- State ----
        let editingServiceId = null;

        // ---- collectFormData (as you defined) ----
        function collectFormData() {
            const formData = new FormData();

            const getVal = id => (document.getElementById(id) ? document.getElementById(id).value : '');

            formData.append("service_name", getVal("service_name"));
            formData.append("service_category", getVal("service_category"));
            formData.append("service_description", getVal("service_description"));
            formData.append("service_price", getVal("service_price"));
            formData.append("service_currency", getVal("service_currency"));
            formData.append("service_features", getVal("service_features"));

            formData.append("provider_id", @json($provider->id));

            const mainImageInput = document.getElementById("service_main_image");
            if (mainImageInput && mainImageInput.files && mainImageInput.files[0]) {
                formData.append("service_main_image", mainImageInput.files[0]);
            }

            const galleryInput = document.getElementById("service_gallery");
            if (galleryInput && galleryInput.files) {
                for (let i = 0; i < galleryInput.files.length; i++) {
                    formData.append("service_gallery[]", galleryInput.files[i]);
                }
            }

            // options & addons by id patterns
            document.querySelectorAll("[id^='optionServices_']").forEach((el, i) => {
                formData.append(`options[${i}]`, el.value);
            });

            document.querySelectorAll("[id^='addon_nameServices_']").forEach((el, i) => {
                formData.append(`addons[${i}][name]`, el.value);
            });
            document.querySelectorAll("[id^='addon_priceServices_']").forEach((el, i) => {
                formData.append(`addons[${i}][price]`, el.value);
            });

            formData.append("on_demand", (document.getElementById("on_demand") && document.getElementById(
                "on_demand").checked) ? 1 : 0);

            let Servicedays = ["السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة"];
            Servicedays.forEach((Serviceday, idx) => {
                formData.append(`Servicedays[${idx}][name]`, Serviceday);
                const fromEl = document.getElementById(`Serviceday_${idx}_from`);
                const toEl = document.getElementById(`Serviceday_${idx}_to`);
                const activeEl = document.getElementById(`Serviceday_${idx}_active`);
                formData.append(`Servicedays[${idx}][from]`, fromEl ? fromEl.value : '');
                formData.append(`Servicedays[${idx}][to]`, toEl ? toEl.value : '');
                formData.append(`Servicedays[${idx}][active]`, (activeEl && activeEl.checked) ? 1 : 0);
            });

            return formData;
        }

        // ---- resetForm ----
        function resetForm() {
            const modalEl = document.getElementById("serviceModal");
            if (!modalEl) return;

            // basic fields
            const setIf = (id, val) => {
                const el = modalEl.querySelector(`#${id}`);
                if (el) el.value = val;
            };
            setIf("service_name", "");
            setIf("service_category", "اختيار تصنيف");
            setIf("service_description", "");
            setIf("service_price", "");
            setIf("service_currency", "دولار");
            setIf("service_features", "");
            if (modalEl.querySelector("#service_main_image")) modalEl.querySelector("#service_main_image")
                .value = "";
            if (modalEl.querySelector("#service_gallery")) modalEl.querySelector("#service_gallery").value = "";

            const onDemand = modalEl.querySelector("#on_demand");
            if (onDemand) onDemand.checked = false;

            // reset options/addons via Alpine safely
            runWhenAlpineReady(modalEl, function(alpine) {
                if (!alpine) return;
                // Assuming the x-data component has options & addons
                Alpine.evaluate(modalEl, 'options = []');
                Alpine.evaluate(modalEl, 'addons = []');
            });

            // reset servicedays
            const Servicedays = ["السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة"];
            Servicedays.forEach((day, idx) => {
                const from = modalEl.querySelector(`#Serviceday_${idx}_from`);
                const to = modalEl.querySelector(`#Serviceday_${idx}_to`);
                const active = modalEl.querySelector(`#Serviceday_${idx}_active`);
                if (from) from.value = "";
                if (to) to.value = "";
                if (active) active.checked = false;
            });

            // gallery info remove or reset
            const galleryInfo = modalEl.querySelector("#gallery_info");
            if (galleryInfo) galleryInfo.textContent = "";

            editingServiceId = null;
            const saveBtn = modalEl.querySelector("#saveService");
            if (saveBtn) saveBtn.textContent = "حفظ الخدمة";
            const modalTitle = modalEl.querySelector("h2");
            if (modalTitle) modalTitle.innerHTML =
                '<i class="ri-tools-line text-pink-500"></i> إنشاء خدمة جديدة';
        }

        // ---- populateFormData (global) ----
        window.populateFormData = function(service) {
            // wrapper so older code that calls populateFormData(...) keeps working
            populateFormDataForEditing(service);
        };

        // ---- populateFormDataForEditing ----

        function populateFormDataForEditing(serviceData) {
            // تحويل features من JSON لو كانت string
            const features = typeof serviceData.features === 'string' ? JSON.parse(serviceData.features) :
                serviceData.features;

            // -------------------
            // الحقول الأساسية
            // -------------------
            document.getElementById("service_name").value = serviceData.name || '';
            document.getElementById("service_category").value = serviceData.type || '';
            document.getElementById("service_description").value = serviceData.description || '';
            document.getElementById("service_price").value = serviceData.price || '';
            document.getElementById("service_features").value = features?.features || '';

            // -------------------
            // Alpine.js state
            // -------------------
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl && alpineEl.__x) {
                // خيارات: نضيف القيم بدون مسح القديم
                if (features?.options && features.options.length) {
                    features.options.forEach(opt => {
                        if (!alpineEl.__x.$data.options.includes(opt)) {
                            alpineEl.__x.$data.options.push(opt);
                        }
                    });
                }

                // اضافات: نضيف القيم بدون تكرار
                if (features?.addons && features.addons.length) {
                    features.addons.forEach(addon => {
                        const exists = alpineEl.__x.$data.addons.some(a => a.name === addon.name && a
                            .price == addon.price);
                        if (!exists) alpineEl.__x.$data.addons.push(addon);
                    });
                }

                // حسب الطلب
                alpineEl.__x.$data.onDemandGlobal = features?.on_demand == "1" || features?.on_demand === true;
            }

            // -------------------
            // الأيام والأوقات
            // -------------------
            const days = features?.days || [];
            days.forEach((day, idx) => {
                const fromEl = document.getElementById(`Serviceday_${idx}_from`);
                const toEl = document.getElementById(`Serviceday_${idx}_to`);
                const activeEl = document.getElementById(`Serviceday_${idx}_active`);
                if (fromEl) fromEl.value = day.from || '';
                if (toEl) toEl.value = day.to || '';
                if (activeEl) activeEl.checked = day.active == "1" ? true : false;
            });

            // -------------------
            // عرض معرض الصور القديمة
            // -------------------
            const galleryContainerId = 'existingGalleryFiles';
            let galleryContainer = document.getElementById(galleryContainerId);
            if (!galleryContainer) {
                const inputGallery = document.getElementById('service_gallery');
                galleryContainer = document.createElement('div');
                galleryContainer.id = galleryContainerId;
                galleryContainer.classList.add('mt-2', 'text-sm', 'text-slate-600');
                inputGallery.parentNode.insertBefore(galleryContainer, inputGallery.nextSibling);
            }

            galleryContainer.innerHTML = '';
            if (features?.gallery && features.gallery.length) {
                const list = document.createElement('ul');
                features.gallery.forEach(file => {
                    const li = document.createElement('li');
                    li.textContent = file.split('/').pop(); // يظهر اسم الملف فقط
                    list.appendChild(li);
                });
                galleryContainer.appendChild(list);
            }
        }


        // ---- save/update handler ----
        const saveBtn = document.getElementById("saveService");
        if (saveBtn) {
            saveBtn.addEventListener("click", async function(e) {
                e.preventDefault();
                const btn = this;
                btn.disabled = true;
                btn.innerHTML = editingServiceId ?
                    'جاري التحديث... <span class="loader ml-2"></span>' :
                    'جاري الحفظ... <span class="loader ml-2"></span>';

                const fd = collectFormData();
                try {
                    let res;
                    if (editingServiceId) {
                        const updateUrl = @json($RouteUpdateService).replace(':id',
                            editingServiceId);
                        fd.append('_method', 'PUT');
                        res = await apiPost(updateUrl, fd);
                    } else {
                        res = await apiPost(@json($RouteAddService), fd);
                    }

                    if (res && res.success) {
                        alert(res.message || (editingServiceId ? 'تم التحديث' : 'تم الحفظ'));
                        resetForm();
                        loadServices();
                        // close modal
                        const modalEl = document.getElementById("serviceModal");
                        if (modalEl) Alpine.evaluate(modalEl, 'openModalServices = false');
                    } else {
                        alert(res.message || (editingServiceId ? 'فشل التحديث' : 'فشل الحفظ'));
                    }
                } catch (err) {
                    console.error(err);
                    alert("حدث خطأ، حاول مرة أخرى");
                } finally {
                    btn.disabled = false;
                    btn.textContent = editingServiceId ? "تحديث الخدمة" : "حفظ الخدمة";
                    editingServiceId = null;
                }
            });
        }

        // ---- loadServices & render ----
        async function loadServices() {
            try {
                const response = await apiGet(@json($RouteGetServices));
                const services = response || [];
                const container = document.getElementById("servicesContainer");
                if (!container) return;

                function renderTable(filteredServices) {
                    container.innerHTML = "";
                    if (!filteredServices.length) {
                        container.innerHTML = "<p class='text-center py-4'>لا توجد خدمات</p>";
                        return;
                    }

                    const table = document.createElement("table");
                    table.className = "min-w-full border border-gray-300";

                    const thead = document.createElement("thead");
                    thead.innerHTML = `
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">الاسم</th>
                            <th class="border px-4 py-2">السعر</th>
                            <th class="border px-4 py-2">النوع</th>
                            <th class="border px-4 py-2">تاريخ الإنشاء</th>
                            <th class="border px-4 py-2">أكشن</th>
                        </tr>
                    `;
                    table.appendChild(thead);

                    const tbody = document.createElement("tbody");

                    filteredServices.forEach((service, index) => {
                        const tr = document.createElement("tr");
                        tr.className = "hover:bg-gray-50";
                        // ensure we escape JSON for attribute safely
                        const serviceJson = JSON.stringify(service).replace(/"/g, '&quot;');
                        tr.innerHTML = `
                            <td class="border px-4 py-2">${index + 1}</td>
                            <td class="border px-4 py-2">${service.name}</td>
                            <td class="border px-4 py-2">${service.price} ${service.price_unit || ''}</td>
                            <td class="border px-4 py-2">${service.type || '-'}</td>
                            <td class="border px-4 py-2">${new Date(service.created_at).toLocaleString()}</td>
                            <td class="border px-4 py-2 flex gap-2 justify-center">
                                <i class="ri-pencil-line text-blue-500 text-lg cursor-pointer hover:text-blue-700 edit-service" data-service="${serviceJson}"></i>
                                <i class="ri-delete-bin-line text-red-500 text-lg cursor-pointer hover:text-red-700 delete-service" data-id="${service.id}"></i>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });

                    table.appendChild(tbody);
                    container.appendChild(table);
                }

                renderTable(services);

                // search
                const searchInput = document.getElementById("serviceSearch");
                if (searchInput) {
                    searchInput.value = "";
                    searchInput.removeEventListener('input', onSearchInput, false);
                    searchInput.addEventListener('input', onSearchInput);
                }

                function onSearchInput() {
                    const term = this.value.toLowerCase();
                    const filtered = services.filter(s =>
                        (s.name || '').toLowerCase().includes(term) ||
                        ((s.type || '')).toLowerCase().includes(term) ||
                        (s.price && s.price.toString().includes(term))
                    );
                    renderTable(filtered);
                }

            } catch (err) {
                console.error(err);
            }
        }

        // ---- delegation: edit / delete ----
        const servicesContainer = document.getElementById("servicesContainer");
        if (servicesContainer) {
            servicesContainer.addEventListener("click", function(e) {
                const editBtn = e.target.closest(".edit-service");
                const deleteBtn = e.target.closest(".delete-service");

                if (editBtn) {
                    // parse service payload
                    const serviceData = editBtn.getAttribute('data-service');
                    let serviceObj = {};
                    try {
                        serviceObj = JSON.parse(serviceData);
                    } catch (err) {
                        console.error(err);
                    }

                    resetForm();
                    populateFormDataForEditing(serviceObj);

                    // open modal (handled in populate but safe)
                    const modalEl = document.getElementById("serviceModal");
                    if (modalEl) runWhenAlpineReady(modalEl, () => {
                        Alpine.evaluate(modalEl, 'openModalServices = true');
                        Alpine.evaluate(modalEl, 'activeModal = "service"');
                    });
                }

                if (deleteBtn) {
                    const id = deleteBtn.dataset.id;
                    if (id && confirm("هل تريد حذف هذه الخدمة؟")) {
                        deleteService(id);
                    }
                }
            });
        }

        async function deleteService(serviceId) {
            try {
                const url = @json($RouteDeleteService).replace(':id', serviceId);
                await apiDelete(url);
                alert("تم الحذف بنجاح");
                loadServices();
            } catch (err) {
                console.error(err);
                alert("فشل الحذف");
            }
        }

        // ---- open button: reset form before open ----
        (function bindOpenButtons() {
            // common patterns: button with @click="openModalServices = true" OR specific id/class
            const openBtns = document.querySelectorAll(
                '[x-on\\:click="openModalServices = true"], button[data-open-service-modal]');
            openBtns.forEach(btn => {
                btn.addEventListener('click', () => resetForm());
            });
        })();

        // ---- close behavior: reset when user explicitly closes modal via buttons with openModalServices=false ----
        document.addEventListener('click', function(e) {
            if (e.target.matches(
                    '[x-on\\:click="openModalServices=false"], [x-on\\:click="openModalServices = false"]'
                ) ||
                e.target.closest(
                    '[x-on\\:click="openModalServices=false"], [x-on\\:click="openModalServices = false"]'
                )) {
                resetForm();
            }
        });

        // finally load initial services
        loadServices();
    });
</script>
