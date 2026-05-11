<x-layout>
    <x-slot:heading>Messages</x-slot:heading>


    <div class="flex w-full max-w-3xl  mx-auto  pt-5 flex-col bg-base-200 h-[calc(100vh-5rem)] ">

        <div class="shrink-0 flex w-full justify-center bg-base-100 rounded-t-3xl  py-3 px-3 shadow-sm">
            <div class="w-full flex gap-3 max-w-3xl  items-center">
                <x-avatar-squircle :$user/>
                <h1 class="font-bold text-xl">{{$user->name}}</h1></div>
        </div>
        <div id="chat-box" class="flex-1 overflow-y-auto flex justify-center py-5 px-3 border border-base-100 shadow-sm">
            <div class="w-full max-w-3xl" id="messages-container">
                @foreach($messages as $message)
                    <x-chat-buble :$message/>
                @endforeach
            </div>
        </div>
        <div class="shrink-0 flex w-full justify-center bg-base-100 py-5 px-3 shadow-sm">
            <div class="flex w-full max-w-3xl gap-2 ">
                <input id="msg-input" type="text" placeholder="Type a message..." class="w-full input input-primary rounded-4xl">
                <button id="send-btn" class="btn btn-ghost rounded-3xl">
                    <x-lucide-send-horizonal class="w-7 h-7 text-primary" />
                </button>
            </div>
        </div>
    </div>




    {{-- Pass Laravel data to JS --}}
    <script>
        window.CHAT_CONFIG = {
            senderName:     '{{auth()->user()->name}}',
            authUserId:    {{ auth()->id() }},
            receiverId:    {{ $user->id }},
            csrfToken:     '{{ csrf_token() }}',
            sendUrl:       '{{ route("messages.send", $user->id) }}'
        };
    </script>
</x-layout>

