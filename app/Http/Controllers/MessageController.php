<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(User $user)
    {
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
        })->with('sender')
            ->latest()
            ->take(50)
            ->get()
            ->reverse();

        return view('chat', compact('messages', 'user'));
    }

    public function send(Request $request, User $user)
    {
        $message = Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $user->id,
            'body'        => $request->validate(['body' => 'required|string|max:1000'])['body'],
        ]);

        $message->load('sender');
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
