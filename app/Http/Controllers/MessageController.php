<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function inbox()
    {
        $userId = auth()->id();

        // Get the latest message per unique conversation
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($message) use ($userId) {
                // Group by the OTHER person's ID
                return $message->sender_id === $userId
                    ? $message->receiver_id
                    : $message->sender_id;
            })
            ->map(function ($messages) use ($userId) {
                $latest = $messages->first(); // already sorted latest first
                $otherUser = $latest->sender_id === $userId
                    ? $latest->receiver
                    : $latest->sender;

                return [
                    'user'       => $otherUser,
                    'last_msg'   => $latest->body,
                    'last_at'    => $latest->created_at,
                    'unread'     => $messages->where('receiver_id', $userId)
                        ->where('is_read', false)
                        ->count(),
                ];
            })
            ->sortByDesc('last_at')
            ->values();

        return view('messages.inbox', compact('conversations'));
    }
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

        return view('messages.chat', compact('messages', 'user'));
    }

    public function send(Request $request, User $user)
    {
        $message = Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $user->id,
            'body'        => $request->validate(['body' => 'required|string|max:1000'])['body'],
        ]);

        $message->load('sender');
        broadcast(new MessageSent($message));

        return response()->json($message);
    }
}
