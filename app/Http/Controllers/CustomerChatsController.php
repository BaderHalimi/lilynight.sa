<?php

namespace App\Http\Controllers;

use App\Models\CustomerChats;
use Illuminate\Http\Request;

class CustomerChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function GetChats($provider_id){
        $provider = auth()->user()->providers()->findOrFail($provider_id);
        $chats = CustomerChats::where('provider_id',$provider->id)->get();
        //dd($chats);
        return response()->json( $chats,201);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerChats $customerChats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerChats $customerChats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerChats $customerChats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $customerChat)
    {
        $customerChats = CustomerChats::findOrFail($customerChat);
        $customerChats->delete();

        return response()->json($customerChats,201);
    }
}
