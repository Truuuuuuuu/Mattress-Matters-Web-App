@props(['message'])

<div class="w-full  chat {{$message->sender_id === auth()->id() ? 'chat-end' : 'chat-start'}} my-3">
    <div class="chat-image avatar">
        <div class="avatar avatar-placeholder">
            <x-avatar-squircle :user="$message->sender" width="8" height="8"/>
        </div>
    </div>
    <div class="chat-bubble bg-primary text-base-100">{{$message->body}}</div>
    <div class="chat-footer opacity-50">
        <time class="text-xs opacity-50">{{$message->created_at->format('H:i') }}</time>
    </div>

</div>
