<?php

use Illuminate\Support\Facades\Route;
use App\Models\Providers;

use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\ServicesController;
use App\Models\Services;
// use DragonCode\Contracts\Cashier\Http\Request;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\ContractTemplatesController;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomerMessageController;
use App\Http\Controllers\CustomerChatsController;
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


        Route::resource('Provider-profile', ProvidersController::class)->names("ProviderProfile");

        Route::resource('Provider-branches', BranchesController::class)->names("ProviderBranches");
        Route::get('Provider-branches/{provider}', [BranchesController::class, 'index'])->name("indexGet");

        Route::get('Provider-Services/{provider}', [ServicesController::class, 'GetServices'])->name("ServicesGet");
        Route::resource('Provider-Services', ServicesController::class)->names("ProviderServices");


        Route::get('Provider-Contracts/{provider}', [ContractsController::class, 'GetContracts'])->name("GetContracts");
        Route::resource('Provider-Contracts', ContractsController::class)->names("ProviderContracts");


        Route::get('Provider-ContractTemplates/{provider}', [ContractTemplatesController::class, 'GetContractTemplates'])->name("GetContractTemplates");
        Route::resource('Provider-ContractTemplates', ContractTemplatesController::class)->names("ProviderContractTemplates");

        Route::get("Provider_Chat/{provider}",[CustomerChatsController::class, 'GetChats'])->name("ProviderGetChat");
        Route::resource("Provider-Chat",CustomerChatsController::class)->names("ProviderChat");

        Route::get("Provider_Message/{provider}",[CustomerMessageController::class, 'GetChatMessages'])->name("ProviderGetChatMessage");
        Route::resource("Provider-Message",CustomerMessageController::class)->names("ProviderChatMessage");

        Route::get('Provider-about/{id}', function($id){
            $Provider = auth()->user()->providers()->findOrFail($id);
            $about = $Provider->description;
            return response()->json([
                'about' => $about,
            ]);
        })->name("Provider.about");

        Route::put('Provider-updateAbout/{id}', function(Request $request,$id){

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