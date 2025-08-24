<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])
    ->prefix('Dashboard')
    ->name('Dashboard.')
    ->group(function () {


        Route::get('/', function () {
            if(!auth()->user()->providers()->exists()){
                return redirect()->route('ProviderCommercial');
            }
            return view('Provider.dashboard.index');
        })->name('overview');


        Route::get('/Provider-profile', function () {
            if (!auth()->user()->providers()->exists()) {
                return response()->json([
                    'redirect' => route('ProviderCommercial')
                ]);
            }
            

            $Provider = auth()->user()->providers()->first();
            return response()->json([
                'Provider' => $Provider,
                'User' => auth()->user(),
            ]);
        })->name('ProviderProfile');



    });