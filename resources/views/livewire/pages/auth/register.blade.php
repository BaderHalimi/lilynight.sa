<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';  // إضافة حقل رقم الهاتف

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // إضافة تحقق من رقم الهاتف
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['nullable', 'string', 'max:20'], // تحقق من رقم الهاتف
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // تشفير كلمة المرور
        $validated['password'] = Hash::make($validated['password']);

        // إنشاء المستخدم الجديد
        event(new Registered($user = User::create($validated)));

        // تسجيل الدخول تلقائيًا
        Auth::login($user);

        // إعادة التوجيه إلى الصفحة الرئيسية
        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>
<div class="flex align-center justify-center mt-[10vh] mb-[10vh] mx-auto p-6">
    <div class="max-w-lg w-full" bis_skin_checked="1" style="opacity: 1; transform: none;">
        <div class="border border-slate-200 bg-white text-slate-900 shadow-2xl rounded-2xl" bis_skin_checked="1">
            <div class="flex flex-col space-y-1.5 text-center p-8" bis_skin_checked="1"><img src="https://lilium-night.com/wp-content/uploads/2024/07/logo-1-1.png" alt="شعار ليلة الليليوم" class="w-20 h-20 mx-auto mb-4">
                <h3 class="tracking-tight text-3xl font-bold gradient-text">إنشاء حساب جديد</h3>
                <p class="text-sm text-slate-500">انضم إلينا وابدأ بتخطيط مناسباتك القادمة بكل سهولة.</p>
            </div>
            <div class="p-8 pt-0" bis_skin_checked="1">
                <form wire:submit="register" class="space-y-4">
                    <div class="relative" bis_skin_checked="1">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="name">الاسم الكامل</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input wire:model="name" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10"
                            required="" id="name" name="name" placeholder="أدخل اسمك الكامل" value="" autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="relative" bis_skin_checked="1">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="email">البريد الإلكتروني</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <input wire:model="email" type="email" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10"
                            required="" id="email" name="email" placeholder="example@domain.com" value="" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="relative" bis_skin_checked="1">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">رقم الجوال (اختياري)</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <input type="tel" wire:model="phone" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10"
                            id="phone" name="phone" placeholder="+966 5X XXX XXXX" value="" required autocomplete="phone">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="grid md:grid-cols-2 gap-4" bis_skin_checked="1">
                        <div class="relative" bis_skin_checked="1">
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="password">كلمة المرور</label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input wire:model="password" type="password" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10"
                                required="" id="password" name="password" placeholder="••••••••" value="" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="relative" bis_skin_checked="1">
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="password_confirmation">تأكيد كلمة المرور</label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input wire:model="password_confirmation" type="password" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10"
                                required="" id="password_confirmation" name="password_confirmation" placeholder="••••••••" value="" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 space-x-reverse pt-2" bis_skin_checked="1">
                        <button id="termsButton" type="button" role="checkbox" aria-checked="false" data-state="unchecked" value="on" class="peer h-4 w-4 shrink-0 border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground rounded-full relative" id="terms"><small class="text-white absolute top-0 left-1" style="margin-top: -2px; margin-left:-1px;"><b>✓</b></small></button>
                        <input type="checkbox" id="terms" aria-hidden="true" tabindex="-1" value="on" style="position: absolute; pointer-events: none; opacity: 0; margin: 0px; transform: translateX(-100%); width: 16px; height: 16px;">
                        <label class="block text-sm font-normal text-slate-600 mb-0" for="terms">أوافق على
                            <button class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary underline-offset-4 hover:underline p-0 h-auto">الشروط والأحكام</button> وسياسة الخصوصية.</label>
                    </div>
                    <button class="inline-flex items-center justify-center ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 shadow-md h-11 rounded-lg px-8 w-full gradient-bg text-white py-6 text-lg font-semibold mt-4" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 ml-2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <line x1="19" x2="19" y1="8" y2="14"></line>
                            <line x1="22" x2="16" y1="11" y2="11"></line>
                        </svg>إنشاء الحساب
                    </button>
                </form>
            </div>
            <div class="flex items-center p-8 pt-0 text-center text-sm" bis_skin_checked="1">
                <p>لديك حساب بالفعل؟ <button class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary underline-offset-4 hover:underline p-0 h-auto">سجل دخولك من هنا</button></p>
            </div>
        </div>
    </div>
    <script>
        const termsButton = document.getElementById('termsButton');
        const termsCheckbox = document.getElementById('terms');
        const submitButton = document.querySelector('button[type="submit"]'); // زر الإرسال
        submitButton.disabled = !termsCheckbox.checked;

        termsButton.addEventListener('click', function() {
            const isChecked = termsButton.getAttribute('aria-checked') === 'true';

            // تحديث aria-checked
            termsButton.setAttribute('aria-checked', !isChecked);

            // تحديث data-state
            if (!isChecked) {
                termsButton.setAttribute('data-state', 'checked');
            } else {
                termsButton.setAttribute('data-state', 'unchecked');
            }

            // تغيير حالة الـ checkbox أيضا
            termsCheckbox.checked = !isChecked;

            // تعطيل زر الإرسال إذا لم يتم الموافقة على الشروط
            setTimeout(() => {
                submitButton.disabled = !termsCheckbox.checked;
            }, 500);
        });
    </script>
</div>
