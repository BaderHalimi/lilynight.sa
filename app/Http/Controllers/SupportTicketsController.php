<?php

namespace App\Http\Controllers;

use App\Models\SupportTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SupportTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    }
    public function GetSupportTickets(Request $request,$user_id)
    {
        //dd($user_id);
        $provider_id = $request->input('provider_id');
        $user_id = $request->input('user_id');
        $tickets = null;
        if ($provider_id) {
            $tickets = SupportTickets::where('provider_id', $provider_id)->get();
        } elseif ($user_id) {
            $tickets = SupportTickets::where('user_id', $user_id)->get();
        } else {
            return response()->json(['error' => 'provider_id or user_id is required'], 400);
        }
        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
            'provider_id' => 'nullable|exists:providers,id',
            'staff_id' => 'nullable|exists:users,id',
            'status' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:100',
            'meta' => 'nullable|array',
        ]);
        if(!$request->input('user_id') && !$request->input('provider_id')){
            return response()->json(['error' => 'Either user_id or provider_id must be provided'], 400);
        }
        if($request->input('user_id') && ($request->input('user_id')!= Auth::id() )){
            return response()->json(['error' => 'Only one of user_id or provider_id must be provided'], 400);
        }
        $ticket = SupportTickets::create($request->all());
        return response()->json([
            'message' => 'تم إنشاء التذكرة بنجاح',
            'data' => $ticket
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTickets $supportTickets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportTickets $supportTickets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportTickets $supportTickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $supportTickets)
    {
        $ticket = SupportTickets::find($supportTickets);
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);

    }
}
