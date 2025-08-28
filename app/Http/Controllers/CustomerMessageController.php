<?php

namespace App\Http\Controllers;

use App\Models\CustomerMessage;
use Illuminate\Http\Request;
use App\Models\CustomerChats;
use Illuminate\Support\Facades\Auth;
class CustomerMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function GetChatMessages(Request $request, $chat_id)
    {
        $perPage = $request->get('per_page', 20) ?? 20;
    
        $messages = CustomerMessage::where('chat_id', $chat_id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    
        return response()->json($messages);
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
            "chat_id" => "required|exists:customer_chats,id",
            "message" => "nullable|string",
            "files.*" => "nullable|file|max:10240" // 10MB لكل ملف
        ]);
    
        $meta = [];
    
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('chat_files', 'public');
                $meta[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'type' => $file->getClientMimeType(),
                ];
            }
        }
    
        $message = CustomerMessage::create([
            "chat_id" => $request->chat_id,
            "sender_id" => Auth::id(),
            "message" => $request->message ?? null,
            "type" => $request->hasFile('files') ? 'file' : 'text',
            "meta" => json_encode($meta),
        ]);
    
        return response()->json(['message' => $message], 201);
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
