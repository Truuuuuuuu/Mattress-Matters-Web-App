<x-layout>
    <x-slot:heading>Messages</x-slot:heading>


    <div id="chat-box" style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:10px;">
        @foreach($messages as $msg)
            <div class="message {{ $msg->sender_id === auth()->id() ? 'mine' : 'theirs' }}">
                <strong>{{ $msg->sender->name }}:</strong> {{ $msg->body }}
                <small>{{ $msg->created_at->format('H:i') }}</small>
            </div>
        @endforeach
    </div>

    <div style="margin-top:10px;">
        <input id="msg-input" type="text" placeholder="Type a message..." style="width:80%">
        <button id="send-btn">Send</button>
    </div>

    {{-- Pass Laravel data to JS --}}
    <script>
        window.CHAT_CONFIG = {
            authUserId:    {{ auth()->id() }},
            receiverId:    {{ $user->id }},
            csrfToken:     '{{ csrf_token() }}',
            sendUrl:       '{{ route("messages.send", $user->id) }}'
        };
    </script>
</x-layout>

