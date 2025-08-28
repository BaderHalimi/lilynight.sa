@php
    $providerID = $provider->id;

    $RouteGetTickets = route("provider.Dashboard.Provider_GetTickets",Auth::id()) . '?provider_id=:provider_id&user_id=:user_id';
    $RouteCreateTicket = route("provider.Dashboard.ProviderTickets.store");
    $RouteDeleteTicket = route("provider.Dashboard.ProviderTickets.destroy",":id");

    //dd($RouteGetTickets);



@endphp
<div class="flex-1 p-4 sm:p-6 lg:p-8" 
     x-data="unicoTicketsComponent()">

    <!-- العنوان + زر إنشاء -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-slate-800">تذاكر الدعم الفني</h2>
        <button @click="unicoSupportModalOpen = true"
            class="inline-flex items-center justify-center rounded-lg text-sm font-semibold bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 gradient-bg text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M8 12h8"></path>
                <path d="M12 8v8"></path>
            </svg>
            تذكرة جديدة
        </button>
    </div>

    <!-- البحث -->
    <div class="mb-4">
        <input type="text" x-model="unicoSearchQuery" placeholder="ابحث عن تذكرة..."
               class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <!-- جدول التذاكر -->
    <div class="rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-xl font-semibold leading-none tracking-tight">
                تذاكر الدعم (<span x-text="filteredTickets.length"></span>)
            </h3>
        </div>
        <div class="p-6 pt-0">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-right">#</th>
                            <th class="px-4 py-2 text-right">الموضوع</th>
                            <th class="px-4 py-2 text-right">الفئة</th>
                            <th class="px-4 py-2 text-right">الحالة</th>
                            <th class="px-4 py-2 text-right">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(ticket, index) in filteredTickets" :key="ticket.id">
                            <tr class="border-b">
                                <td class="px-4 py-2 font-mono" x-text="'TKT-' + ticket.id"></td>
                                <td class="px-4 py-2 font-semibold" x-text="ticket.title"></td>
                                <td class="px-4 py-2" x-text="ticket.type"></td>
                                <td class="px-4 py-2" x-text="ticket.status"></td>
                                <td class="px-4 py-2 space-x-2">
                                    <!-- زر الحذف لو مفتوحة -->
                                    <button x-show="ticket.status === 'open'" 
                                            @click="deleteTicket(ticket.id)"
                                            class="px-2 py-1 text-xs rounded bg-red-500 text-white">
                                        حذف
                                    </button>
                                    <!-- زر الشات لو pending -->
                                    <button x-show="ticket.status === 'pending'"
                                            @click="startChat(ticket.id)"
                                            class="px-2 py-1 text-xs rounded bg-blue-500 text-white">
                                        شات
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredTickets.length === 0">
                            <td colspan="5" class="text-center py-4 text-slate-500">لا توجد نتائج</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- مودال إنشاء تذكرة -->
    <div x-show="unicoSupportModalOpen" x-cloak 
         class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
        <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-xl font-bold mb-4">إنشاء تذكرة جديدة</h3>
            
            <!-- نموذج -->
            <div class="space-y-3">
                <div>
                    <label class="block text-sm mb-1">الموضوع</label>
                    <input type="text" x-model="unicoForm.title" 
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm mb-1">الفئة</label>
                    <select x-model="unicoForm.type" 
                            class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="">اختر الفئة</option>
                        <option>تقني</option>
                        <option>مالي</option>
                        <option>عام</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm mb-1">الوصف</label>
                    <textarea x-model="unicoForm.description" rows="3"
                              class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>

                    {{-- <input x-modal="unicoForm.provider_id" value="{{$providerID}}" hidden> --}}
                </div>
            </div>

            <!-- أزرار -->
            <div class="flex justify-end gap-2 mt-6">
                <button @click="unicoSupportModalOpen = false"
                        class="px-4 py-2 rounded-lg border text-sm">
                    إلغاء
                </button>
                <button @click="createTicket"
                        class="px-4 py-2 rounded-lg bg-primary text-white text-sm hover:bg-primary/90">
                    حفظ
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function unicoTicketsComponent() {
        return {
            unicoTicketsList: [],
            unicoSupportModalOpen: false,
            unicoForm: { 
                title: '', 
                type: '', 
                priority: 'منخفضة', 
                description: '', 
                provider_id: '{{ $providerID }}', 
                user_id: '{{ auth()->id() }}'
            },
            unicoSearchQuery: '',
    
            // فلترة حسب البحث
            get filteredTickets() {
                if (!this.unicoSearchQuery) return this.unicoTicketsList;
                return this.unicoTicketsList.filter(t => 
                    (t.title || '').toLowerCase().includes(this.unicoSearchQuery.toLowerCase()) ||
                    (t.type || '').toLowerCase().includes(this.unicoSearchQuery.toLowerCase())
                );
            },
    
            // جلب التذاكر
            async fetchTickets() {
                try {
                    let res = await apiGet("{{ $RouteGetTickets }}"
                        .replace(':provider_id', '{{ $providerID }}')
                        .replace(':user_id', '{{ auth()->id() }}'));
    
                    // هنا نعتمد ان الكنترولر يرجع { data: [...] }
                    this.unicoTicketsList = res || [];
                } catch (e) {
                    console.error("خطأ في جلب التذاكر:", e);
                }
            },
    
            // إنشاء تذكرة
            async createTicket() {
                if (!this.unicoForm.title || !this.unicoForm.type) return;
                try {
                    let res = await apiPost("{{ $RouteCreateTicket }}", this.unicoForm);
    
                    // نضيف التذكرة الجديدة للقائمة
                    //this.unicoTicketsList.push(res);
                    this.fetchTickets();
                    // نرجع الفورم للحالة الافتراضية
                    this.unicoForm = { 
                        title: '', 
                        type: '', 
                        priority: 'منخفضة', 
                        description: '', 
                        provider_id: '{{ $providerID }}', 
                        user_id: '{{ auth()->id() }}'
                    };
    
                    this.unicoSupportModalOpen = false;
                } catch (e) {
                    console.error("خطأ في إنشاء التذكرة:", e);
                }
            },
    
            // حذف تذكرة
            async deleteTicket(id) {
                if (!confirm('هل تريد حذف هذه التذكرة؟')) return;
                try {
                    await apiDelete("{{ $RouteDeleteTicket }}".replace(':id', id));
                    this.unicoTicketsList = this.unicoTicketsList.filter(t => t.id !== id);
                } catch (e) {
                    console.error("خطأ في حذف التذكرة:", e);
                }
            },
    
            // فتح شات
            startChat(id) {
                alert("فتح الشات للتذكرة: " + id);
                // لاحقاً تضيف هنا لينك الشات
            },
    
            // تحميل التذاكر عند التهيئة
            init() {
                this.fetchTickets();
            }
        }
    }
    </script>
    