<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="flex align-center justify-center mx-auto p-6">
    <div class="max-w-md w-full" style="opacity: 1; transform: none;" bis_skin_checked="1">
        <div class="border border-slate-200 bg-white text-slate-900 shadow-2xl rounded-2xl" bis_skin_checked="1">
            <div class="flex flex-col space-y-1.5 text-center p-8" bis_skin_checked="1"><img src="https://lilium-night.com/wp-content/uploads/2024/07/logo-1-1.png" alt="شعار ليلة الليليوم" class="w-20 h-20 mx-auto mb-4">
                <h3 class="tracking-tight text-3xl font-bold gradient-text">تسجيل الدخول</h3>
                <p class="text-sm text-slate-500">مرحباً بعودتك! أدخل البريد الالكتروني وكلمة المرور لتسجيل الدخول.</p>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="p-8 pt-0" bis_skin_checked="1">
                <div dir="ltr" data-orientation="horizontal" class="w-full" bis_skin_checked="1">
                    <!-- <div role="tablist" aria-orientation="horizontal" class="h-auto items-center justify-center rounded-lg bg-slate-100 p-1 text-slate-500 grid w-full grid-cols-2" tabindex="0" data-orientation="horizontal" style="outline: none;" bis_skin_checked="1"><button type="button" role="tab" aria-selected="true" aria-controls="radix-:rt:-content-customer" data-state="active" id="radix-:rt:-trigger-customer" class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium ring-offset-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-white data-[state=active]:text-primary data-[state=active]:shadow-sm" tabindex="0" data-orientation="horizontal" data-radix-collection-item=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg> عميل</button>
                            <button type="button" role="tab" aria-selected="false" aria-controls="radix-:rt:-content-merchant" data-state="inactive" id="radix-:rt:-trigger-merchant" class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium ring-offset-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-white data-[state=active]:text-primary data-[state=active]:shadow-sm" tabindex="-1" data-orientation="horizontal" data-radix-collection-item=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                                <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path>
                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path>
                                <path d="M2 7h20"></path>
                                <path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path>
                            </svg> مزود خدمة</button></div> -->
                    <div data-state="active" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:rt:-trigger-customer" id="radix-:rt:-content-customer" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" style="" bis_skin_checked="1">
                        <form wire:submit="login" class="space-y-4">
                            <div class="relative" bis_skin_checked="1"><label class="block text-sm font-medium text-gray-700 mb-2" for="customer-email">البريد الإلكتروني</label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10" placeholder="example@domain.com" value="">
                            </div>
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />

                            <div class="relative" bis_skin_checked="1"><label class="block text-sm font-medium text-gray-700 mb-2" for="customer-password">كلمة المرور</label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute top-9 right-3 h-5 w-5 text-slate-400">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password" class="flex h-10 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 transition-all duration-200 ease-in-out pr-10" placeholder="••••••••" value="">
                            </div>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />

                            <div class="block mt-4">
                                <label for="remember" class="inline-flex items-center">
                                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <button class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 shadow-md h-10 px-4 py-2 w-full gradient-bg text-white" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" x2="3" y1="12" y2="12"></line>
                                </svg>تسجيل الدخول </button>
                        </form>
                    </div>
                    <div data-state="inactive" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:rt:-trigger-merchant" id="radix-:rt:-content-merchant" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 mt-6" bis_skin_checked="1" hidden=""></div>
                </div>
                <div class="flex items-center justify-center mt-4">
                    @if (Route::has('password.request'))
                    <a class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary underline-offset-4 hover:underline p-0 h-auto" href="{{ route('password.request') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                            <circle cx="16.5" cy="7.5" r=".5"></circle>
                        </svg>
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="flex items-center flex-col p-8 pt-0 text-center text-sm gap-2" bis_skin_checked="1">
                <!-- <button class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary underline-offset-4 hover:underline p-0 h-auto"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1">
                        <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                        <circle cx="16.5" cy="7.5" r=".5"></circle>
                    </svg> هل نسيت كلمة المرور؟</button> -->
                <p>ليس لديك حساب؟ <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary underline-offset-4 hover:underline p-0 h-auto">سجل الآن</a></p>
            </div>
        </div>
    </div>
</div>
