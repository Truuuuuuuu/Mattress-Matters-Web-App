<x-layout>
    <x-slot:heading>Inbox</x-slot:heading>
    <div class="max-w-2xl mx-auto py-6 px-4">
        <h1 class="text-xl font-bold mb-4">Messages</h1>

        @if($conversations->isEmpty())
            <p class="text-gray-500 text-center py-12">No conversations yet.</p>
        @else
            <div class="flex flex-col gap-2">
                @foreach($conversations as $convo)
                    <a href="{{ route('messages.show', $convo['user']->id) }}"
                       class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm hover:bg-gray-50 transition">

                        {{-- Avatar --}}
                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-12 rounded-full">
                                <span class="text-md"> {{ strtoupper(substr($convo['user']->name, 0, 1)) }}</span>
                            </div>
                        </div>

                        {{-- Name + Last message --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">{{ $convo['user']->name }}</span>
                                <span class="text-xs text-gray-400 shrink-0 ml-2">
                                    {{ $convo['last_at']->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">{{ $convo['last_msg'] }}</p>
                        </div>

                        {{-- Unread badge (remove if no is_read column) --}}
                        @if(!empty($convo['unread']) && $convo['unread'] > 0)
                            <span class="bg-indigo-600 text-white text-xs font-bold rounded-full px-2 py-0.5 shrink-0">
                                {{ $convo['unread'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
