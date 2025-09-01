<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div class="flex-1 p-4 sm:p-6 lg:p-8" x-data="{ activeTab: 'venues', activeModal: 'service', openModalServices: false }">
    <div x-cloak class="relative" id="serviceModal">
        <div x-show="openModalServices" x-data="{
            options: [],
            addons: [],
            addOption() { this.options.push({id: null, name: ''}) },
            removeOption(i) { this.options.splice(i, 1) },
            addAddon() { this.addons.push({ id: null, name: '', price: '' }) },
            removeAddon(i) { this.addons.splice(i, 1) },
            onDemandGlobal: false,
            activeModal: 'service'
        }" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50" x-transition>
    
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl p-6 relative overflow-y-auto max-h-[90vh]"
                @click.away="openModalServices=false">
    
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-lg font-semibold text-slate-700 flex items-center gap-2">
                        <i class="ri-tools-line text-pink-500"></i> إنشاء خدمة جديدة
                    </h2>
                    <button @click="openModalServices=false" class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
                </div>
    
                <div class="flex flex-wrap gap-2 border-b mb-4">
                    <template
                        x-for="tab in [
                            {id:'service',label:'الخدمة',icon:'ri-briefcase-4-line'},
                            {id:'details',label:'الوصف',icon:'ri-file-text-line'},
                            {id:'pricing',label:'التسعير',icon:'ri-price-tag-3-line'},
                            {id:'features',label:'المميزات',icon:'ri-star-line'},
                            {id:'gallery',label:'المعرض',icon:'ri-image-line'},
                            {id:'optionsT',label:'الخيارات',icon:'ri-settings-3-line'},
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
    
                <div class="p-4 space-y-4">
    
                    <div x-show="activeModal==='service'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">اسم الخدمة</label>
                        <input id="service_name" type="text" class="w-full border rounded-lg px-3 py-2 mb-3">
    
                        <label class="block text-slate-600 mb-1">مكان الخدمة</label>
                        <input id="service_location" type="text" class="w-full border rounded-lg px-3 py-2 mb-3">
    
                        <label class="block text-slate-600 mb-1">الصورة الرئيسية</label>
                        <div class="flex items-center gap-4">
                            <img id="preview_service_main_image" src="/images/default.png" alt="Service Image"
                                class="w-24 h-24 object-cover rounded border">
                            <input type="file" id="service_main_image" accept=".png,.jpg,.jpeg,.gif"
                                class="w-full border rounded-lg px-3 py-2 mb-3" onchange="previewSelectedFile(event)">
                        </div>
    
                        <label class="block text-slate-600 mb-1">التصنيف</label>
                        <select id="service_category" class="w-full border rounded-lg px-3 py-2">
                            <option value="">اختيار تصنيف</option>
                            <option value="halls_palaces">القاعات والقصور</option>
                            <option value="catering_buffet">الإعاشة والبوفيه</option>
                            <option value="photo_video">التصوير والفيديو</option>
                            <option value="beauty_makeup">التجميل والمكياج</option>
                            <option value="entertainment_shows">العروض الترفيهية</option>
                            <option value="transportation">النقل والمواصلات</option>
                            <option value="security_guard">الحراسة والأمن</option>
                            <option value="flowers_invitations">الورود والدعوات</option>
                        </select>
                    </div>
    
                    <div x-show="activeModal==='details'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">الوصف</label>
                        <textarea id="service_description" class="w-full border rounded-lg px-3 py-2" rows="5"></textarea>
                    </div>
    
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
    
                    <div x-show="activeModal==='features'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">المميزات</label>
                        <textarea id="service_features" class="w-full border rounded-lg px-3 py-2" rows="4"></textarea>
                    </div>
    
                    <div x-show="activeModal==='gallery'" x-transition.duration.400ms>
                        <label class="block text-slate-600 mb-1">رفع الصور</label>
                        <input id="service_gallery" type="file" multiple class="w-full border rounded-lg px-3 py-2">
                    </div>
    
                    <div x-show="activeModal==='optionsT'" x-transition.duration.400ms>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-slate-600">الخيارات المتاحة</p>
                            <button @click="addOption"
                                class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                <i class="ri-add-line"></i> إضافة خيار
                            </button>
                        </div>
                        <template x-for="(option,i) in options" :key="option.id || `new-${i}`">
                            <div class="flex items-center gap-2 mb-2">
                                <input :id="`optionServices_${i}`" type="text" x-model="options[i].name" placeholder="اسم الخيار"
                                    class="flex-1 border rounded-lg px-3 py-2">
                                <button @click="removeOption(i)" class="text-red-500 hover:text-red-700">
                                    <i class="ri-close-line text-xl"></i>
                                </button>
                            </div>
                        </template>
                    </div>
    
                    <div x-show="activeModal==='addons'" x-transition.duration.400ms>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-slate-600">الإضافات</p>
                            <button @click="addAddon"
                                class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                <i class="ri-add-line"></i> إضافة
                            </button>
                        </div>
                        <template x-for="(addon,i) in addons" :key="addon.id || `new-${i}`">
                            <div class="flex items-center gap-2 mb-2">
                                <input :id="`addon_nameServices_${i}`" type="text" x-model="addons[i].name" placeholder="اسم الإضافة"
                                    class="flex-1 border rounded-lg px-3 py-2">
                                <input :id="`addon_priceServices_${i}`" type="number" x-model="addons[i].price" placeholder="السعر"
                                    class="w-32 border rounded-lg px-3 py-2">
                                <button @click="removeAddon(i)" class="text-red-500 hover:text-red-700">
                                    <i class="ri-close-line text-xl"></i>
                                </button>
                            </div>
                        </template>
                    </div>
    
                    <div x-show="activeModal==='availability'" x-transition.duration.400ms>
                        <p class="text-slate-600 mb-3">حدد أيام وساعات العمل:</p>
    
                        <label class="flex items-center gap-2 mb-4">
                            <input id="on_demand" type="checkbox" x-model="onDemandGlobal" class="rounded">
                            <span>حسب الطلب (On Demand)</span>
                        </label>
    
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
            const start = Date.now();
            (function check() {
                if (el && el.__x) return cb(el.__x);
                if (Date.now() - start > timeout) return cb(null);
                setTimeout(check, 50);
            })();
        }

        // Add these functions as they are missing in your original code
        async function apiPost(url, data) {
            const response = await fetch(url, {
                method: 'POST',
                body: data,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            return response.json();
        }

        async function apiDelete(url) {
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            return response.json();
        }

        async function apiGet(url) {
            const response = await fetch(url);
            return response.json();
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

        // ---- collectFormData (with updated logic) ----
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
            formData.append("service_location", getVal("service_location"));
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

            // Options and addons collection
            const alpineEl = document.querySelector('#serviceModal');
            if (alpineEl && alpineEl.__x) {
                const data = alpineEl.__x.data;
                data.options.forEach((opt, i) => {
                    formData.append(`options[${i}][name]`, opt.name);
                    if (opt.id) {
                        formData.append(`options[${i}][id]`, opt.id);
                    }
                });
                data.addons.forEach((addon, i) => {
                    formData.append(`addons[${i}][name]`, addon.name);
                    formData.append(`addons[${i}][price]`, addon.price);
                    if (addon.id) {
                        formData.append(`addons[${i}][id]`, addon.id);
                    }
                });
            }

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
            if (modalEl.querySelector("#service_main_image")) modalEl.querySelector("#service_main_image").value = "";
            if (modalEl.querySelector("#service_gallery")) modalEl.querySelector("#service_gallery").value = "";

            const onDemand = modalEl.querySelector("#on_demand");
            if (onDemand) onDemand.checked = false;

            runWhenAlpineReady(modalEl, function(alpine) {
                if (!alpine) return;
                alpine.data.options = [];
                alpine.data.addons = [];
                alpine.data.activeModal = 'service';
                alpine.data.onDemandGlobal = false;
            });

            const Servicedays = ["السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة"];
            Servicedays.forEach((day, idx) => {
                const from = modalEl.querySelector(`#Serviceday_${idx}_from`);
                const to = modalEl.querySelector(`#Serviceday_${idx}_to`);
                const active = modalEl.querySelector(`#Serviceday_${idx}_active`);
                if (from) from.value = "";
                if (to) to.value = "";
                if (active) active.checked = false;
            });

            const galleryInfo = modalEl.querySelector("#existingGalleryFiles");
            if (galleryInfo) galleryInfo.innerHTML = "";

            editingServiceId = null;
            const saveBtn = modalEl.querySelector("#saveService");
            if (saveBtn) saveBtn.textContent = "حفظ الخدمة";
            const modalTitle = modalEl.querySelector("h2");
            if (modalTitle) modalTitle.innerHTML = '<i class="ri-tools-line text-pink-500"></i> إنشاء خدمة جديدة';
        }

        // ---- populateFormDataForEditing (updated logic) ----
        window.populateFormData = function(service) {
            populateFormDataForEditing(service);
        };

        function populateFormDataForEditing(serviceData) {
            const features = typeof serviceData.features === 'string' ? JSON.parse(serviceData.features) :
                serviceData.features;
            editingServiceId = serviceData.id;

            document.getElementById("service_name").value = serviceData.name || '';
            document.getElementById("service_category").value = serviceData.type || '';
            document.getElementById("service_description").value = serviceData.description || '';
            document.getElementById("service_price").value = serviceData.price || '';
            document.getElementById("service_features").value = features?.features || '';
            document.getElementById("preview_service_main_image").src = features?.service_main_image ?
                `/storage/${features.service_main_image}` :
                '/images/default.png';
            document.getElementById("service_location").value = serviceData.service_location || '';

            const alpineEl = document.querySelector('#serviceModal');
            if (alpineEl) {
                runWhenAlpineReady(alpineEl, function(alpine) {
                    if (!alpine) return;
                    alpine.data.options = features?.options || [];
                    alpine.data.addons = features?.addons || [];
                    alpine.data.onDemandGlobal = features?.on_demand == "1" || features?.on_demand === true;
                    alpine.data.activeModal = 'service';
                });
            }

            const days = features?.days || [];
            days.forEach((day, idx) => {
                const fromEl = document.getElementById(`Serviceday_${idx}_from`);
                const toEl = document.getElementById(`Serviceday_${idx}_to`);
                const activeEl = document.getElementById(`Serviceday_${idx}_active`);
                if (fromEl) fromEl.value = day.from || '';
                if (toEl) toEl.value = day.to || '';
                if (activeEl) activeEl.checked = day.active == "1" ? true : false;
            });

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
                    li.textContent = file.split('/').pop();
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
                        const updateUrl = @json($RouteUpdateService).replace(':id', editingServiceId);
                        fd.append('_method', 'PUT');
                        res = await apiPost(updateUrl, fd);
                    } else {
                        res = await apiPost(@json($RouteAddService), fd);
                    }

                    if (res && res.success) {
                        alert(res.message || (editingServiceId ? 'تم التحديث' : 'تم الحفظ'));
                        const modalEl = document.getElementById("serviceModal");
                        if (modalEl) Alpine.evaluate(modalEl, 'openModalServices = false');
                        resetForm();
                        loadServices();
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
                    const serviceData = editBtn.getAttribute('data-service');
                    let serviceObj = {};
                    try {
                        serviceObj = JSON.parse(serviceData);
                    } catch (err) {
                        console.error(err);
                    }

                    resetForm();
                    populateFormDataForEditing(serviceObj);

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
            const openBtns = document.querySelectorAll(
                '[x-on\\:click="openModalServices = true"], button[data-open-service-modal]');
            openBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    resetForm();
                    // Ensure the modal is open, sometimes the click event is too fast for Alpine
                    const modalEl = document.getElementById("serviceModal");
                    if(modalEl) {
                        runWhenAlpineReady(modalEl, () => {
                            Alpine.evaluate(modalEl, 'openModalServices = true');
                            Alpine.evaluate(modalEl, 'activeModal = "service"');
                        });
                    }
                });
            });
        })();

        // ---- close behavior: reset when user explicitly closes modal via buttons with openModalServices=false ----
        document.addEventListener('click', function(e) {
            if (e.target.matches('[x-on\\:click="openModalServices=false"], [x-on\\:click="openModalServices = false"]') ||
                e.target.closest('[x-on\\:click="openModalServices=false"], [x-on\\:click="openModalServices = false"]')) {
                resetForm();
            }
        });

        loadServices();
    });
</script>