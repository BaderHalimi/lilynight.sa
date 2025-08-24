<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    // Route::get('/provider', function () {
    //     dd("Provider");
    // })->name('provider');
    
Volt::route('StartProvider', 'pages.provider.Start_Provider')
    ->middleware(['auth', 'verified'])
    ->name('ProviderCommercial');
require __DIR__.'/auth.php';

// routes/web.php

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->whereIn('provider', ['google','github'])
    ->name('oauth.redirect');

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->whereIn('provider', ['google','github'])
    ->name('oauth.callback');
