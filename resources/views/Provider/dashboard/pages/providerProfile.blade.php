<div id="output">... جاري التحميل</div>

<script>
    async function fetchProviderProfile() {
        try {
            let url = route('api.provider.profile'); // 👈 جبت الرابط بالاسم
            let response = await axios.get(url);

            // عرض البيانات في الصفحة
            document.getElementById('output').innerText =
                JSON.stringify(response.data, null, 2);

        } catch (err) {
            console.error(err);
            document.getElementById('output').innerText = 'خطأ في جلب البيانات';
        }
    }

    // نستدعي الدالة أول ما تفتح الصفحة
    fetchProviderProfile();
</script>
