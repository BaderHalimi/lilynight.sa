<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="flex items-center justify-center mt-24 mb-24 mx-auto p-6">
    <div class="max-w-lg w-full">
        <div class="border border-gray-200 bg-white text-gray-900 shadow-2xl rounded-2xl">
            <div class="flex flex-col items-center p-8">
                <img src="https://lilium-night.com/wp-content/uploads/2024/07/logo-1-1.png" alt="شعار" class="w-20 h-20 mx-auto mb-4">
                <h3 class="text-3xl font-bold text-primary">تأكيد البريد الإلكتروني</h3>
                <p class="text-sm text-gray-500 mt-2">شكرًا لتسجيلك! قبل أن تبدأ، يرجى تأكيد بريدك الإلكتروني من خلال الرابط الذي أرسلناه إليك.</p>
            </div>

            <div class="p-8 pt-0">
                @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-center text-sm text-primary">
                    {{ __('تم إرسال رابط التحقق إلى بريدك الإلكتروني.') }}
                </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <x-primary-button wire:click="sendVerification" class="bg-primary/80 hover:bg-primary text-white py-2 px-6 rounded-lg">
                        {{ __('إعادة إرسال رابط التحقق') }}
                    </x-primary-button>

                    <button wire:click="logout" type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
                        {{ __('تسجيل الخروج') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
