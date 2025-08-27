<?php

namespace App\Http\Controllers;

use App\Models\CustomerMessage;
use Illuminate\Http\Request;

class CustomerMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function GetChatMessages($chat_id){
        $messages = CustomerMessage::where('chat_id',$chat_id)->get();
        return response()->json(['messages' => $messages]);
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
    public function show(CustomerMessage $customerMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerMessage $customerMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerMessage $customerMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerMessage $customerMessage)
    {
        //
    }
}
