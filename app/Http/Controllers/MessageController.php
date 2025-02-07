<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController
{
    public function markAllAsRead()
    {
        Message::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['status' => 'success']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        Message::create($validatedData);

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
