<x-layout>
    <x-slot:heading>Messages</x-slot:heading>


    <div class="flex flex-col h-[calc(100vh-5rem)] ">
        <div class="shrink-0 flex w-full justify-center bg-gray-200 py-3 ">
            <div class="w-full flex gap-3 max-w-3xl  items-center">
                <div class="avatar avatar-placeholder">
                    <div class="bg-neutral text-neutral-content w-12 rounded-full">
                        <span class="text-md">{{$user->name[0]}}</span>
                    </div>
                </div>
                <h1 class="font-bold text-xl">{{$user->name}}</h1></div>
        </div>
        <div id="chat-box" class="flex-1 overflow-y-auto flex justify-center py-5 px-3">
            <div class="w-full max-w-3xl" id="messages-container">
                @foreach($messages as $message)
                    <x-chat-buble :$message/>
                @endforeach
            </div>
        </div>
        <div class="shrink-0 flex w-full justify-center bg-gray-200 py-5">
            <div class="flex w-full max-w-3xl gap-2">
                <input id="msg-input" type="text" placeholder="Type a message..." class="w-full input input-neutral">
                <button id="send-btn" class="btn btn-ghost">
                    <x-lucide-send-horizonal class="w-7 h-7 " />
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

