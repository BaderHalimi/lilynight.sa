<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Workplace;


Route::middleware(['auth', 'verified'])
    ->prefix('Dashboard')
    ->name('Dashboard.')
    ->group(function () {


        Route::get('/', function () {

            return view('user.dashboard.index');
        })->name('overview');

        Route::resource('profile', UserProfileController::class)->names('profile');
        Route::resource("workplace", Workplace::class)->names("workplace");




    });