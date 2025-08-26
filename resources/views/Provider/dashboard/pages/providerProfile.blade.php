<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="flex-1 p-4 sm:p-6 lg:p-8">
    <div class="space-y-8">
        <h2 class="text-3xl font-bold text-slate-800">الملف الشخصي للتاجر</h2>

        <div class="rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-xl font-semibold leading-none tracking-tight">المعلومات الأساسية</h3>
                <p class="text-sm text-slate-500">إدارة معلومات نشاطك التجاري التي تظهر للعملاء.</p>
            </div>

            <div class="p-6 pt-0 space-y-6">
                <div class="flex items-center gap-6">
                    <!-- الصورة -->
                    <div class="relative">
                        <span
                            class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24 border-4 border-white shadow-md">
                            <img class="aspect-square h-full w-full" id="avatar-preview" alt="صورة النشاط"
                                src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?q=80&w=200">
                        </span>
                        <button type="button" id="changeAvatarBtn"
                            class="inline-flex items-center justify-center text-sm font-semibold bg-primary text-white hover:bg-primary/90 shadow-md absolute bottom-0 right-0 rounded-full w-8 h-8">
                            تغيير
                        </button>
                        <input type="file" id="avatar-upload" accept="image/*" class="hidden">
                    </div>

                    <!-- البيانات -->
                    <div class="flex-grow grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="businessName" class="block text-sm font-medium text-gray-700 mb-2">اسم النشاط
                                التجاري</label>
                            <input id="businessName" class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm"
                                value="">
                        </div>
                        <div>
                            <label for="businessType" class="block text-sm font-medium text-gray-700 mb-2">نوع
                                النشاط</label>
                            <input id="businessType" class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm"
                                value="">
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label for="crNumber" class="block text-sm font-medium text-gray-700 mb-2">رقم السجل
                            التجاري</label>
                        <input id="crNumber" class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm"
                            value="">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني
                            للتواصل</label>
                        <input type="email" id="email"
                            class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm" value="">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف
                            للتواصل</label>
                        <input id="phone" class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm"
                            value="">
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">عنوان النشاط
                        الرئيسي</label>
                    <input id="address" class="flex h-10 w-full rounded-lg border px-4 py-3 text-sm" value="">
                </div>
            </div>

            <div class="flex items-center p-6 border-t pt-6">
                <button id="saveProfile"
                    class="inline-flex items-center justify-center rounded-lg text-sm font-semibold bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 text-white">
                    حفظ التغييرات
                </button>
            </div>
        </div>

        {{-- <div class="grid lg:grid-cols-2 gap-8">
            <div class="rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-xl font-semibold leading-none tracking-tight flex items-center gap-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shield">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                        </svg> تغيير كلمة المرور</h3>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-2" for="currentPassword">كلمة المرور
                            الحالية</label><input type="password"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out"
                            id="currentPassword" name="current" value=""></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-2" for="newPassword">كلمة المرور
                            الجديدة</label><input type="password"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out"
                            id="newPassword" name="new" value=""></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-2" for="confirmPassword">تأكيد كلمة
                            المرور الجديدة</label><input type="password"
                            class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out"
                            id="confirmPassword" name="confirm" value=""></div>
                </div>
                <div class="flex items-center p-6 pt-0"><button id="savePassword"
                        class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">تغيير
                        كلمة المرور</button></div>
            </div>

        </div>  --}}

    </div>
</div>

@php
    $storage = Storage::url('');
    $providerID = $provider->id;
    $linkRoute = route("provider.Dashboard.ProviderProfile.show",$providerID);
    $linkRouteSave = route("provider.Dashboard.ProviderProfile.update",$providerID);
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const storage = @json($storage);
        const providerId = @json($provider->id);

        const avatarInput = document.getElementById('avatar-upload');
        const avatarPreview = document.getElementById('avatar-preview');
        const changeAvatarBtn = document.getElementById('changeAvatarBtn');

        changeAvatarBtn.addEventListener('click', () => avatarInput.click());

        avatarInput.addEventListener('change', () => {
            if (avatarInput.files && avatarInput.files[0]) {
                avatarPreview.src = URL.createObjectURL(avatarInput.files[0]);
            }
        });

        function loadProfile() {

            axios.get(@json($linkRoute))
                .then(res => {
                    const provider = res.data.Provider;

                    document.getElementById("businessName").value = provider.name || '';
                    document.getElementById("businessType").value = provider.type || '';
                    document.getElementById("crNumber").value = provider.cr_number || '';
                    document.getElementById("email").value = provider.email || '';
                    document.getElementById("phone").value = provider.phone || '';
                    document.getElementById("address").value = provider.address || '';

                    if (provider.logo) {
                        avatarPreview.src = storage + provider.logo;
                    }
                })
                .catch(err => console.error(err));
        }
        // const currentHash = window.location.hash; 
        // if (currentHash === "#merchant-profile") {
        //     loadProfile();
        //     console.log("Loading merchant profile data...");
        // }

        // window.addEventListener('hashchange', () => {
        //     const newHash = window.location.hash;
        //     //console.log("الهاش الجديد:", newHash);

        //     if (newHash === "#merchant-profile") {
        //         loadProfile();
        //         console.log("Loading merchant profile data on hash change...");
        //     }
        // });
        const link = new URLSearchParams(window.location.search).get('tab');
            //console.log("الهاش الجديد:", newHash);

            if (link === "merchant-profile") {
                loadProfile();
                console.log("Loading merchant profile data on hash change...");
            }

        window.addEventListener('locationchange', () => {
            const newHash = new URLSearchParams(window.location.search).get('tab');
            //console.log("الهاش الجديد:", newHash);

            if (newHash === "merchant-profile") {
                loadProfile();
                console.log("Loading merchant profile data on hash change...");
            }
       });

        document.getElementById("saveProfile").addEventListener("click", function(e) {
            e.preventDefault();

            const saveButton = document.getElementById("saveProfile");
            const originalText = saveButton.textContent;
            saveButton.textContent = "جاري الحفظ...";
            saveButton.disabled = true;

            const formData = new FormData();
            const linkFormsave = @json($linkRouteSave);

            const businessName = document.getElementById("businessName").value.trim();
            const businessType = document.getElementById("businessType").value.trim();
            const crNumber = document.getElementById("crNumber").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const address = document.getElementById("address").value.trim();

            if (!businessName || !businessType || !crNumber || !email || !phone || !address) {
                alert("يرجى ملء جميع الحقول المطلوبة");
                saveButton.textContent = originalText;
                saveButton.disabled = false;
                return;
            }

            formData.append('name', businessName);
            formData.append('type', businessType);
            formData.append('cr_number', crNumber);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);

            const avatarInput = document.getElementById("avatar-upload");
            if (avatarInput && avatarInput.files && avatarInput.files[0]) {
                formData.append('logo', avatarInput.files[0]);
            }

            formData.append('_method', 'PUT');

            console.log("البيانات المرسلة:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            axios.post(linkFormsave, formData, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log("Server Response:", response.data);

                    if (response.data.success) {
                        alert("تم حفظ التغييرات بنجاح!");

                        if (response.data.data.logo) {
                            const avatarPreview = document.getElementById('avatar-preview');
                            if (avatarPreview) {
                                avatarPreview.src = storage + response.data.data.logo;
                            }
                        }
                    } else {
                        alert(response.data.message || "حدث خطأ غير متوقع");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);

                    if (error.response) {
                        if (error.response.status === 422) {
                            const errors = error.response.data.errors;
                            let errorMessage = "يرجى تصحيح الأخطاء التالية:\n";

                            Object.keys(errors).forEach(key => {
                                errorMessage += "- " + errors[key][0] + "\n";
                            });

                            alert(errorMessage);
                        } else {
                            alert(error.response.data.message || "حدث خطأ أثناء الحفظ");
                        }
                    } else if (error.request) {
                        alert("مشكلة في الاتصال. يرجى المحاولة مرة أخرى.");
                    } else {
                        alert("حدث خطأ غير متوقع");
                    }
                })
                .finally(() => {
                    saveButton.textContent = originalText;
                    saveButton.disabled = false;
                });
        });


        // document.getElementById("savePassword").addEventListener("click", function(e) {
        //     e.preventDefault();

        //     const saveButtonPssword = document.getElementById("saveProfile");
        //     const originalText = saveButton.textContent;
        //     saveButtonPssword.textContent = "جاري الحفظ...";
        //     saveButtonPssword.disabled = true;

        //     const formData = new FormData();

        //     const oldpassword = document.getElementById("currentPassword").value.trim();
        //     const password = document.getElementById("newPassword").value.trim();
        //     const password_confermation = document.getElementById("confirmPassword").value.trim();

        //     if ((!oldpassword || !password || !password_confermation) && password !== password_confermation) {
        //         alert("يرجى ملء جميع الحقول المطلوبة او التاكد من الباسورد");
        //         saveButtonPssword.textContent = originalText;
        //         saveButtonPssword.disabled = false;
        //         return;
        //     }

        //     formData.append('oldpassword', oldpassword);
        //     formData.append('password', password);
        //     formData.append('password_confermation', password_confermation);


 
        //     //formData.append('_method', 'PUT');

        //     console.log("البيانات المرسلة:");
        //     for (let pair of formData.entries()) {
        //         console.log(pair[0] + ': ' + pair[1]);
        //     }

        //     axios.post(route("provider.Dashboard.ProviderProfile.update", providerId), formData, {
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                     .getAttribute('content'),
        //             }
        //         })
        //         .then(response => {
        //             console.log("Server Response:", response.data);

        //             if (response.data.success) {
        //                 alert("تم حفظ التغييرات بنجاح!");

        //                 if (response.data.data.logo) {
        //                     const avatarPreview = document.getElementById('avatar-preview');
        //                     if (avatarPreview) {
        //                         avatarPreview.src = storage + response.data.data.logo;
        //                     }
        //                 }
        //             } else {
        //                 alert(response.data.message || "حدث خطأ غير متوقع");
        //             }
        //         })
        //         .catch(error => {
        //             console.error("Error:", error);

        //             if (error.response) {
        //                 if (error.response.status === 422) {
        //                     const errors = error.response.data.errors;
        //                     let errorMessage = "يرجى تصحيح الأخطاء التالية:\n";

        //                     Object.keys(errors).forEach(key => {
        //                         errorMessage += "- " + errors[key][0] + "\n";
        //                     });

        //                     alert(errorMessage);
        //                 } else {
        //                     alert(error.response.data.message || "حدث خطأ أثناء الحفظ");
        //                 }
        //             } else if (error.request) {
        //                 alert("مشكلة في الاتصال. يرجى المحاولة مرة أخرى.");
        //             } else {
        //                 alert("حدث خطأ غير متوقع");
        //             }
        //         })
        //         .finally(() => {
        //             saveButtonPssword.textContent = originalText;
        //             saveButtonPssword.disabled = false;
        //         });
        // });
    });
</script>
