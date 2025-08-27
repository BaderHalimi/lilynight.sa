<?php

namespace App\Http\Controllers;

use App\Models\ContractTemplates;
use Illuminate\Http\Request;
class ContractTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function GetContractTemplates($Provider_id){
        $contractTemplates = ContractTemplates::where("provider_id",$Provider_id)->get();
        return response()->json($contractTemplates);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
            "provider_id" => 'required|exists:providers,id',
            'meta' => 'nullable|array',
        ]);
        $providerId = auth()->user()->providers()->findOrFail($request->provider_id);
        $contractTemplate = ContractTemplates::create([
            'name' => $request->name,
            'content' => $request->content,
            'provider_id' => $providerId->id,
            'meta' => $request->meta,
        ]);
        return response()->json($contractTemplate, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(ContractTemplates $contractTemplates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractTemplates $contractTemplates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $contractTemplates)
    {
        $contractTemplate = ContractTemplates::find($contractTemplates);
        if (!$contractTemplate) {
            return response()->json(['message' => 'Contract Template not found'], 404);
        }
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string|max:10000',
            'meta' => 'nullable|array',
        ]);
        $contractTemplate->update($request->only(['name', 'content', 'meta']));
        return response()->json($contractTemplate, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $contractTemplates)
    {
        $contractTemplate = ContractTemplates::find($contractTemplates);
        if (!$contractTemplate) {
            return response()->json(['message' => 'Contract Template not found'], 404);
        }
        $contractTemplate->delete();
        return response()->json(['message' => 'Contract Template deleted'], 200);
    }
}
