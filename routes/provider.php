<?php

use Illuminate\Support\Facades\Route;
use App\Models\Providers;

use App\Http\Controllers\ProvidersController;
// use DragonCode\Contracts\Cashier\Http\Request;

use Illuminate\Http\Request;

Route::middleware(['auth', 'verified'])
    ->prefix('Dashboard')
    ->name('Dashboard.')
    ->group(function () {


        Route::get('/{provider}', function ($provider) {
            if(!auth()->user()->providers()->exists()){
                return redirect()->route('ProviderCommercial');
            }
            $provider = auth()->user()->providers()->findOrFail($provider);
            return view('Provider.dashboard.index',compact('provider'));
        })->name('overview');


        // Route::get('/Provider-profile', function () {
        //     if (!auth()->user()->providers()->exists()) {
        //         return response()->json([
        //             'redirect' => route('ProviderCommercial')
        //         ]);
        //     }
            
        //     $Provider = auth()->user()->providers()->first();
        //     return response()->json([
        //         'Provider' => $Provider,
        //         'User' => auth()->user(),
        //     ]);
        // })->name('ProviderProfile');


        Route::resource('Provider-profile/', ProvidersController::class)->names("ProviderProfile");
        Route::get('Provider-about', function($id){
            $Provider = auth()->user()->providers()->findOrFail($id);
            $about = $Provider->description;
            return response()->json([
                'about' => $about,
            ]);
        })->name("Provider.about");

        Route::put('Provider-updateAbout', function(Request $request,$id){

            $Provider = auth()->user()->providers()->findOrFail($id);

            $request->validate([
                'about' => 'required|string|max:5000',
            ]);

            $Provider->description = $request->about;
            $Provider->save();
            return response()->json([
                'message' => 'About updated successfully',
            ]);
        })->name("Provider.updateAbout");

        // Route::post('Provider-Password', [ProvidersController::class,"password"])->names("ProviderProfile.password");



    });