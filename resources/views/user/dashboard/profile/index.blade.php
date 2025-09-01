@extends('user.layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-6 lg:p-8">
    <div class="max-w-3xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800">الملف الشخصي</h1>
        </div>

        <form action="{{ route('user.Dashboard.profile.update',Auth::id()) }}" method="POST" enctype="multipart/form-data"
              class="rounded-xl border border-slate-200 bg-white shadow-sm p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- صورة البروفايل -->
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <span class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24 border border-slate-300">
                    <img id="preview-image" 
                         src="{{ Storage::url(auth()->user()->avatar ?? 'default/user.png') }}" 
                         class="object-cover w-full h-full">
                </span>

                <div>
                    <label for="photo"
                           class="cursor-pointer inline-flex items-center justify-center rounded-lg text-sm font-semibold border border-slate-300 bg-white hover:bg-slate-100 h-10 px-4 py-2 transition">
                        رفع صورة جديدة
                    </label>
                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*"
                           onchange="previewImage(event)">
                    @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- بيانات الحساب -->
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                           class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" disabled
                           class="w-full rounded-lg border border-slate-300 px-4 py-2 bg-slate-100">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الجوال</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                           class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- كلمة المرور (قسم منفصل) -->
            <div class="border-t border-slate-200 pt-6">
                <h2 class="text-lg font-semibold text-slate-800 mb-4">تغيير كلمة المرور</h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الجديدة</label>
                        <input type="password" id="password" name="password"
                               class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none"
                               placeholder="ادخل كلمة مرور جديدة">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none"
                               placeholder="أعد كتابة كلمة المرور">
                        @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- زر الحفظ -->
            <div class="pt-4">
                <button type="submit" 
                        class="bg-primary text-white font-semibold rounded-lg px-6 py-2 hover:bg-primary/90 shadow">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Preview صورة -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('preview-image').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
