<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="flex-1 p-4 sm:p-6 lg:p-8">
    <div style="opacity: 1; transform: none;">
        <div class="space-y-8">
            <h2 class="text-3xl font-bold text-slate-800">إضافة قسم "نبذة عنا"</h2>
            <div class="rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-xl font-semibold leading-none tracking-tight">تحرير محتوى "نبذة عنا"</h3>
                    <p class="text-sm text-slate-500">اكتب وصفاً جذاباً عن نشاطك التجاري، خبراتك، وما يميزك عن الآخرين. سيظهر هذا النص في صفحتك العامة.</p>
                </div>
                <div class="p-6 pt-0"><textarea id="about" class="flex w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[250px] text-base leading-relaxed" placeholder="اكتب هنا نبذة عن نشاطك..."></textarea></div>
                <div class="flex items-center p-6 pt-0"><button id="saveAbout" class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 gradient-bg text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg> حفظ التغييرات</button></div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const storage = @json($storage);
        const providerId = @json($provider->id);

        const about = document.getElementById('about');




        function loadabout() {

            axios.get(route("provider.Dashboard.Provider.about"))
                .then(res => {
                    const about = res.data.about;

                    document.getElementById("about").value = about || '';


                })
                .catch(err => console.error(err));
        }
        const linkAboutSec = new URLSearchParams(window.location.search).get('tab');

        if (linkAboutSec === "about-section") {
            loadabout();
            console.log("Loading merchant about data on hash change...");
        }

        window.addEventListener('locationchange', () => {
            const newHash = new URLSearchParams(window.location.search).get('tab');

            if (newHash === "about-section") {
                loadabout();
                console.log("Loading merchant about data on hash change...");
            }
        });


        document.getElementById('saveAbout').addEventListener('click', function(e) {
            e.preventDefault();

            const saveButton = document.getElementById('saveAbout');
            const originalText = saveButton.textContent;
            saveButton.textContent = 'جاري الحفظ...';
            saveButton.disabled = true;

            const about = document.getElementById('about');
            const aboutText = about.value.trim();

            const formData = new FormData();
            formData.append('about', aboutText);
            formData.append('_method', 'PUT');

            console.log('Sending about text:', aboutText); 

            axios.post(route("provider.Dashboard.Provider.updateAbout"), formData, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log('Response:', response.data);

                    if (response.data.success) {
                        alert('تم حفظ التغييرات بنجاح!');
                    } else {
                        alert(response.data.message || 'حدث خطأ أثناء الحفظ');
                    }
                })
                .catch(error => {
                    console.error('Error details:', error);

                    if (error.response) {
                        console.error('Server error:', error.response.data);

                        if (error.response.status === 422) {
                            const errors = error.response.data.errors;
                            let errorMessage = "يرجى تصحيح الأخطاء التالية:\n";

                            Object.keys(errors).forEach(key => {
                                errorMessage += "- " + errors[key][0] + "\n";
                            });

                            alert(errorMessage);
                        } else {
                            alert(error.response.data.message || 'حدث خطأ من السيرفر');
                        }
                    } else if (error.request) {
                        alert('مشكلة في الاتصال. يرجى المحاولة مرة أخرى.');
                    } else {
                        alert('حدث خطأ غير متوقع: ' + error.message);
                    }
                })
                .finally(() => {
                    saveButton.textContent = originalText;
                    saveButton.disabled = false;
                });
        });

    });
</script>