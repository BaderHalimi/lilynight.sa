<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div x-data="{ open: false }" id="branchModal" x-on:close-branch-modal.window="open = false"
 x-on:open-branch-modal.window="open = true" class="relative" x-cloak>

    <!-- زر فتح المودال -->
    <button @click="open = true" class="px-4 py-2 bg-primary text-white rounded">إضافة فرع جديد</button>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">#</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">الاسم</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">الموقع</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">الهاتف</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">الحالة</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-700">إجراءات</th>
                </tr>
            </thead>
            <tbody id="branchesTable" class="divide-y divide-gray-200"></tbody>
        </table>
    </div>


    <!-- الخلفية السوداء -->
    <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 z-50 bg-black/80"
        style="pointer-events: auto;" aria-hidden="true"></div>

    <!-- المودال -->
    <div x-show="open" x-transition
        class="fixed left-1/2 top-1/2 z-50 grid w-full max-w-lg -translate-x-1/2 -translate-y-1/2 gap-4 border bg-background p-6 shadow-lg sm:rounded-lg sm:max-w-[625px]"
        style="pointer-events: auto;" role="dialog" aria-labelledby="modal-title" aria-describedby="modal-desc">
        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="modal-title" class="tracking-tight text-xl font-semibold mb-1">إضافة فرع أو موقع جديد</h2>
            <p id="modal-desc" class="text-sm text-muted-foreground">أدخل بيانات الفرع أو الموقع الجديد لتبدأ بإدارته
                وربطه بخدماتك.</p>
        </div>

        <div class="py-4 max-h-[60vh] overflow-y-auto pr-2">
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="branchName">اسم
                            الفرع/الموقع</label>
                        <input id="branchName" name="name" placeholder="مثال: قاعة الياسمين للاحتفالات"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="branchLocation">عنوان
                            الفرع/الموقع</label>
                        <input id="branchLocation" name="location" placeholder="مثال: الرياض، شارع العليا"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out" />
                    </div>
                </div>

                <!-- باقي الحقول بنفس التنسيق السابق -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="branchManager">اسم المدير
                            المسؤول</label>
                        <input id="branchManager" name="manager" placeholder="مثال: عبدالله السالم"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="branchPhone">رقم هاتف
                            الفرع</label>
                        <input id="branchPhone" name="phone" placeholder="05xxxxxxxx"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out" />
                    </div>
                </div>

                <!-- الخدمات -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الخدمات المقدمة في هذا الفرع</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 mt-2 p-3 border rounded-md">
                        <template x-for="service in ['قاعات','بوفيه','تصوير','تجميل','ترفيه','نقل','أمن','زهور ودعوات']"
                            :key="service">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" :id="'service-' + service.replace(/\s+/g, '-')"
                                    class="form-checkbox h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary">
                                <label :for="'service-' + service.replace(/\s+/g, '-')"
                                    class="block font-medium text-gray-700 mb-2 text-sm" x-text="service"></label>
                            </div>
                        </template>

                    </div>
                </div>

                <!-- حالة الفرع -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="branchStatus">اميل الفرع</label>
                    <input id="Branchemail" name="Branchemail"
                        class="w-full p-2 border border-slate-300 rounded-md focus:ring-primary focus:border-primary">

                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="branchStatus">حالة الفرع</label>
                    <select id="branchStatus" name="status"
                        class="w-full p-2 border border-slate-300 rounded-md focus:ring-primary focus:border-primary">
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                        <!-- <option value="maintenance">تحت الصيانة</option>
                        <option value="soon">قريباً</option> -->
                    </select>
                </div>
            </div>
        </div>

        <!-- أزرار الإغلاق والإضافة -->
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 gap-2 pt-4 border-t">
            <button id="closeBranchModal" @click="open = false;" 
                class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                إلغاء
            </button>
            <button id="saveBranch"
                class="inline-flex items-center justify-center rounded-lg text-sm font-semibold bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 text-white">
                إضافة الفرع
            </button>
        </div>
    </div>
</div>

@php
    $RouteViewBranch = route('provider.Dashboard.indexGet', $provider->id);
    $RouteAddBranch = route('provider.Dashboard.ProviderBranches.store');
    //$RouteShowBranch = route("provider.Dashboard.ProviderBranches.show",":id");
    $RouteEditBranch = route('provider.Dashboard.ProviderBranches.edit', ':id');

@endphp

{{-- 
window.addEventListener("open-branch-modal", () => {
                        document.querySelector('#branchModal').__x.$data.open = true;


}); --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        //window.dispatchEvent(new Event("close-branch-modal"));

        async function loadBranches() {
            try {
                const branches = await apiGet(@json($RouteViewBranch));
                const tbody = document.getElementById("branchesTable");
                tbody.innerHTML = "";

                branches.forEach((branch, index) => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                        <td class="px-4 py-2">${index + 1}</td>
                        <td class="px-4 py-2">${branch.name}</td>
                        <td class="px-4 py-2">${branch.address}</td>
                        <td class="px-4 py-2">${branch.phone}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs ${
                                branch.status === 'active' 
                                    ? 'bg-green-100 text-green-600' 
                                    : 'bg-red-100 text-red-600'
                            }">
                                ${branch.status === 'active' ? 'نشط' : 'غير نشط'}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded editBtn" data-id="${branch.id}">تعديل</button>
                            <button class="px-3 py-1 bg-red-500 text-white rounded deleteBtn" data-id="${branch.id}">حذف</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error(err);
            }
        }

        // تحميل الفروع عند فتح التبويب
        const linkBranches = new URLSearchParams(window.location.search).get('tab');
        if (linkBranches === "branch-management") {
            loadBranches();
        }
        window.addEventListener('locationchange', () => {
            if (new URLSearchParams(window.location.search).get('tab') === "branch-management") {
                loadBranches();
            }
        });

        document.getElementById("saveBranch").addEventListener("click", async function(e) {
            e.preventDefault();

            const saveBtn = this;
            let editId = saveBtn.getAttribute("data-edit-id");
            const originalText = saveBtn.textContent;
            saveBtn.textContent = 'جاري الحفظ...';
            saveBtn.disabled = true;

            const servicesList = ['قاعات', 'بوفيه', 'تصوير', 'تجميل', 'ترفيه', 'نقل', 'أمن',
                'زهور ودعوات'
            ];
            const selectedServices = servicesList.filter(service => {
                const el = document.getElementById('service-' + service.replace(/\s+/g,
                    '-'));
                return el && el.checked;
            });

            const payload = {
                name: document.getElementById('branchName').value.trim(),
                address: document.getElementById('branchLocation').value.trim(),
                moderator_name: document.getElementById('branchManager').value.trim(),
                phone: document.getElementById('branchPhone').value.trim(),
                status: document.getElementById('branchStatus').value,
                email: document.getElementById('Branchemail').value.trim(),
                services: selectedServices,
            };

            if (!payload.name || !payload.address || !payload.moderator_name || !payload.phone) {
                alert('يرجى ملء جميع الحقول المطلوبة.');
                saveBtn.textContent = originalText;
                saveBtn.disabled = false;
                return;
            }

            try {
                let res;
                if (editId) {
                    res = await apiPut(route("provider.Dashboard.ProviderBranches.update", editId),
                        payload);
                } else {
                    res = await apiPost(@json($RouteAddBranch), payload);
                }

                if (res.success) {
                    alert('تم الحفظ بنجاح!');
                    loadBranches();

                    //document.getElementById("branchModal").__x.$data.open = false;
                    window.dispatchEvent(new Event("close-branch-modal"));

                    clearBranchForm();
                } else {
                    alert(res.message || 'حدث خطأ أثناء الحفظ');
                }
            } catch (err) {
                console.error(err);
                alert('حدث خطأ غير متوقع');
            } finally {
                saveBtn.textContent = originalText;
                saveBtn.disabled = false;
                editId = null;
                loadBranches();
            }
        });

        function clearBranchForm() {
            document.getElementById("branchName").value = "";
            document.getElementById("branchLocation").value = "";
            document.getElementById("branchManager").value = "";
            document.getElementById("branchPhone").value = "";
            document.getElementById("Branchemail").value = "";
            document.getElementById("branchStatus").value = "inactive";
            document.getElementById("saveBranch").removeAttribute("data-edit-id");

            const servicesList = ['قاعات', 'بوفيه', 'تصوير', 'تجميل', 'ترفيه', 'نقل', 'أمن', 'زهور ودعوات'];
            servicesList.forEach(service => {
                const el = document.getElementById('service-' + service.replace(/\s+/g, '-'));
                if (el) el.checked = false;
            });
        }

        document.getElementById('closeBranchModal').addEventListener('click', function() {
            clearBranchForm();
        });

        document.getElementById("branchesTable").addEventListener("click", async (e) => {
            const btn = e.target;
            const id = btn.dataset.id;
            if (!id) return;

            // تعديل
            if (btn.classList.contains("editBtn")) {
                try {
                    const branch = await apiGet(route("provider.Dashboard.ProviderBranches.edit",
                        id));
                    console.log(branch);

                    //document.querySelector('[x-data]').__x.$data.open = true;
                    document.getElementById('branchName').value = branch.name || '';
                    document.getElementById('branchLocation').value = branch.address || '';
                    document.getElementById('branchManager').value = branch.moderator_name || '';
                    document.getElementById('branchPhone').value = branch.phone || '';
                    document.getElementById('branchStatus').value = branch.status || 'inactive';
                    document.getElementById('Branchemail').value = branch.email || '';

                    const servicesList = ['قاعات', 'بوفيه', 'تصوير', 'تجميل', 'ترفيه', 'نقل', 'أمن',
                        'زهور ودعوات'
                    ];

                    servicesList.forEach(service => {
                        const checkbox = document.getElementById('service-' + service
                            .replace(/\s+/g, '-'));
                        if (checkbox) {
                            checkbox.checked = branch.services?.includes(service) || false;
                        }
                    });

                    window.dispatchEvent(new Event("open-branch-modal"));
                    //document.querySelector('#branchModal').__x.$data.open = true;


                    document.getElementById("saveBranch").setAttribute("data-edit-id", id);
                } catch (err) {
                    console.log(err);
                    alert("تعذر تحميل بيانات الفرع");
                }
            }

            
            if (btn.classList.contains("deleteBtn")) {
                if (!confirm("هل أنت متأكد من حذف هذا الفرع؟")) return;
                try {
                    await apiDelete(route("provider.Dashboard.ProviderBranches.destroy", id));
                    alert("تم الحذف بنجاح");
                    loadBranches();
                } catch (err) {
                    console.error(err);
                }
            }
        });

    });
</script>
