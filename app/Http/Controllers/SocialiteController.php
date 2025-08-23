<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    protected array $allowed = ['google','github'];

    public function redirect(string $provider)
    {
        abort_unless(in_array($provider, $this->allowed), 404);
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        abort_unless(in_array($provider, $this->allowed), 404);

        $socialUser = Socialite::driver($provider)->user();

        // نحاول الربط عبر البريد إن وُجد
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // إنشاء مستخدم جديد (كلمة مرور عشوائية؛ لن يستخدمها غالباً)
            $user = User::create([
                'name'  => $socialUser->getName() ?: $socialUser->getNickname() ?: 'User',
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(Str::random(32)),
                'provider_name' => $provider,
                'provider_id'   => $socialUser->getId(),
                'avatar'        => $socialUser->getAvatar(),
                'email_verified_at' => now(), // اختياري: اعتبر البريد موثّقاً
            ]);
        } else {
            // حدّث بيانات الربط إن لزم
            $user->update([
                'provider_name' => $provider,
                'provider_id'   => $socialUser->getId(),
                'avatar'        => $socialUser->getAvatar() ?? $user->avatar,
            ]);
        }

        Auth::login($user, remember: true);
        return redirect()->intended('/dashboard');
    }
}
