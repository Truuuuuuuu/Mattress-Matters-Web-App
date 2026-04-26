@props([
    'tabs',
    'default',
    'showViewToggle' => false,
])

<div x-data="{ activeTab: '{{ $default }}', activeView: 'cards' }">
    <div class="flex justify-between bg-base-100 rounded-3xl p-3 border border-base-300">

        {{-- Tab Buttons --}}
        <div class="flex-1 flex justify-start items-center gap-2">
            @foreach ($tabs as $tab)
                <button
                    @click="activeTab = '{{ $tab }}'"
                    class="btn rounded-2xl btn-sm capitalize"
                    :class="activeTab === '{{ $tab }}' ? 'btn-primary' : 'btn-ghost'">
                    {{ ucfirst($tab) }}
                </button>
            @endforeach
        </div>

        {{-- Right Side --}}
        <div class="flex-1 flex justify-end items-center">
            <x-search-bar />

            @if ($showViewToggle)
                <div class="w-px h-full bg-gray-300 mx-5"></div>
                <div class="flex gap-2">
                    <button @click="activeView = 'cards'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'cards' ? 'btn-primary' : 'btn-outline'">
                        <x-lucide-layout-grid class="w-5 h-5" />
                    </button>
                    <button @click="activeView = 'lists'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'lists' ? 'btn-primary' : 'btn-outline'">
                        <x-lucide-list class="w-5 h-5" />
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Panels --}}
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
