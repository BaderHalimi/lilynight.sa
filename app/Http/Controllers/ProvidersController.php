<?php

namespace App\Http\Controllers;

use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show($Providers)
    {
        if (!auth()->user()->providers()->exists()) {
            return response()->json([
                'redirect' => route('ProviderCommercial')
            ]);
        }

        $Provider = auth()->user()->providers()->findOrFail($Providers);
        return response()->json([
            'Provider' => $Provider,
            'User' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Providers $providers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$Providers)
    {


        $providerModel = auth()->user()->providers()->findOrFail($Providers);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cr_number' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:providers,email,' . $providerModel->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $providerModel->fill($validatedData);
    
        if ($request->hasFile('logo')) {
            if ($providerModel->logo && \Storage::disk('public')->exists($providerModel->logo)) {
                \Storage::disk('public')->delete($providerModel->logo);
            }
            $providerModel->logo = $request->file('logo')->store('providers/logos', 'public');
        }
    
        $providerModel->save();
    
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث بيانات المزود بنجاح',
            'data' => $providerModel->fresh(),
        ]);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Providers $providers)
    {
        //
    }
}
