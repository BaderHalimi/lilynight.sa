<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branches::where('provider_id', auth()->user()->providers()->first()->id)->get();
        return response()->json($branches);
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
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'moderator_name' => 'nullable|string|max:255',
            'services' => 'nullable|array',
            'services.*' => 'string|max:100',
            'status' => 'required|in:active,inactive',

        ]);
        $branch = new Branches();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->provider_id = auth()->user()->providers()->first()->id;   
        $branch->moderator_name = $request->moderator_name;
        $branch->services = $request->services;
        $branch->status = 'active';
        $branch->meta = [
            'created_by' => auth()->user()->id,
        ];
        $branch->save();


        return response()->json(['message' => 'Branch created successfully', 'branch' => $branch], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branches $branches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branches $branches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branches $branches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branches $branches)
    {
        //
    }
}
