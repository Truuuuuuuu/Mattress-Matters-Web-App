@props(['message'])

<div class="w-full  chat {{$message->sender_id === auth()->id() ? 'chat-end' : 'chat-start'}} my-3">
    <div class="chat-image avatar">
        <div class="avatar avatar-placeholder">
            <div class="bg-neutral text-neutral-content w-8 rounded-full">
                <span class="text-xs">{{$message->sender->name[0]}}</span>
            </div>
        </div>
    </div>
    <div class="chat-bubble">{{$message->body}}</div>
    <div class="chat-footer opacity-50">
        <time class="text-xs opacity-50">{{$message->created_at->format('H:i') }}</time>
    </div>

</div>
