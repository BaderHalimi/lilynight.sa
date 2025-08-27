<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div x-data="TemplateContracts()" class="p-6">

    <!-- شريط علوي فيه زر + بحث -->
    <div class="flex items-center justify-between mb-4">
        <button @click="openCreateModal()"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
            + إنشاء قالب جديد
        </button>

        <input type="text" placeholder="🔍 ابحث عن قالب..."
            x-model="search" @input="filterTemplates"
            class="border rounded px-3 py-2 w-1/3">
    </div>

    <!-- جدول -->
    <div class="mt-2 border rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-right">اسم القالب</th>
                    <th class="p-3 text-right">آخر تحديث</th>
                    <th class="p-3 text-right">الخيارات</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="t in filteredTemplates" :key="t.id">
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-semibold" x-text="t.name"></td>
                        <td class="p-3" x-text="t.updated_at"></td>
                        <td class="p-3 flex gap-2">
                            <button @click="openEditModal(t)"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">تعديل</button>
                            <button @click="deleteTemplate(t.id)"
                                class="px-2 py-1 bg-red-600 text-white rounded">حذف</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- مودال -->
    <div x-show="openModal" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">

            <h2 class="text-xl font-bold mb-4" x-text="isEditing ? 'تعديل القالب' : 'إضافة قالب جديد'"></h2>

            <form @submit.prevent="isEditing ? updateTemplate() : saveTemplate()">
                <input type="hidden" x-model="form.provider_id">

                <div class="mb-3">
                    <label class="block text-sm mb-1">اسم القالب</label>
                    <input type="text" x-model="form.name"
                        class="w-full border rounded px-3 py-2" placeholder="اكتب اسم القالب">
                </div>

                <div class="mb-3">
                    <label class="block text-sm mb-1">محتوى القالب</label>
                    <textarea x-model="form.content"
                        class="w-full border rounded px-3 py-2" rows="3"
                        placeholder="اكتب نص القالب"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="closeModal"
                        class="px-4 py-2 border rounded">إلغاء</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@php
    $providerId = $provider->id;
    $ContractTemplateRoutesStore = route('provider.Dashboard.ProviderContractTemplates.store');
    $ContractTemplateRoutesGet = route('provider.Dashboard.GetContractTemplates', $provider->id);
    $ContractTemplateRoutesDestroy = route('provider.Dashboard.ProviderContractTemplates.destroy', ":id");
    $ContractTemplateRoutesUpdate = route('provider.Dashboard.ProviderContractTemplates.update' , ":id");
    //dd($ContractTemplateRoutesGet);

@endphp

<script>
function TemplateContracts() {
    return {
        openModal: false,
        isEditing: false,
        search: "",
        templates: [],
        filteredTemplates: [],
        editId: null,
        form: { provider_id: @json($providerId), name: "", content: "" },

        async init() {
            await this.getTemplates();
        },

        async getTemplates() {
            let res = await fetch(@json($ContractTemplateRoutesGet));
            this.templates = await res.json();
            this.filteredTemplates = this.templates;
        },

        filterTemplates() {
            let q = this.search.toLowerCase();
            this.filteredTemplates = this.templates.filter(t => t.name.toLowerCase().includes(q));
        },

        openCreateModal() {
            this.form = { provider_id: @json($providerId), name: "", content: "" };
            this.isEditing = false;
            this.openModal = true;
        },

        openEditModal(template) {
            this.form = { provider_id: @json($providerId), name: template.name, content: template.content };
            this.editId = template.id;
            this.isEditing = true;
            this.openModal = true;
        },

        closeModal() {
            this.openModal = false;
        },

        async saveTemplate() {
            let res = await fetch(@json($ContractTemplateRoutesStore), {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(this.form)
            });
            if (res.ok) {
                this.closeModal();
                this.getTemplates();
            }
        },

        async updateTemplate() {
            let url = @json($ContractTemplateRoutesUpdate).replace(":id", this.editId);
            let res = await fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(this.form)
            });
            if (res.ok) {
                this.closeModal();
                this.getTemplates();
            }
        },

        async deleteTemplate(id) {
            if (!confirm("هل أنت متأكد من الحذف؟")) return;
            let url = @json($ContractTemplateRoutesDestroy).replace(":id", id);
            let res = await fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });
            if (res.ok) {
                this.getTemplates();
            }
        }
    }
}
</script>
