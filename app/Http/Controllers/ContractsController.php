<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function GetContracts($Provider_id)
    {
        $contracts = Contracts::where("Provider_id",$Provider_id)->get();
        return response()->json($contracts);
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
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:pending,cancelled,finished',
            'provider_signature' => 'nullable|string',
            'customer_signature' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);
        $contract = new Contracts(); //3mk
        $contract->name = $request->name;
        $contract->date = $request->date;
        $contract->content = $request->content;
        $contract->status = $request->status;
        $contract->provider_signature = $request->provider_signature;
        $contract->customer_signature = $request->customer_signature;
        $contract->amount = $request->amount;
        $contract->save();

        return response()->json("the contract has been created succesfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Contracts $contracts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($contract_id)
    {
        $contract = Contracts::findOrFail($contract_id);
        return response()->json($contract)
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $contract)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'content' => 'required|string',
            'status' => 'required|in:pending,cancelled,finished',
            'provider_signature' => 'nullable|string',
            'customer_signature' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);
        $contract = Contracts::findOrFail($contract); //3mk
        $contract->name = $request->name ?? $contract->name;
        $contract->date = $request->date ?? $contract->date;
        $contract->content = $request->content ?? $contract->content;
        $contract->status = $request->status ?? $contract->status;
        $contract->provider_signature = $request->provider_signature ?? $contract->provider_signature;
        $contract->customer_signature = $request->customer_signature ?? $contract->customer_signature;
        $contract->amount = $request->amount ?? $contract->amount;
        $contract->save();

        return response()->json("the contract has been created succesfully");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($contracts)
    {
        $contract = Contracts::findOrFail($contracts);
        $contract->delete();
        return response()->json("has been delete");
    }
}
