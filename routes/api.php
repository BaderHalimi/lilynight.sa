<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/provider-profile', function () {
    return response()->json([
        'businessName' => 'متجر الهدى',
        'businessType' => 'بيع بالتجزئة',
        'crNumber' => '123456789',
        'email' => 'store@example.com',
        'phone' => '0551234567',
        'address' => 'الرياض - السعودية',
    ]);
})->name('api.provider.profile');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
