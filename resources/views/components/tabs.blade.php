@props([
    'tabs',
    'default',
    'showViewToggle' => false,
    'showSearchBar' => false,
    'title',
    'titleSubHeading' => ''
])

<div x-data="{
    activeTab: new URLSearchParams(window.location.search).get('tab') || '{{ $default }}',
    activeView: 'cards',
    setTab(tab) {
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.location.href = url.toString();
    }
}">
    {{-- For large screen --}}
    <div class="hidden md:flex justify-between bg-base-100 rounded-3xl p-3 backdrop-blur-lg
            border border-white/20 shadow-xs">

        {{-- Tab Buttons --}}
        <div class="flex-1 flex justify-start items-center gap-2">
            @foreach ($tabs as $tab)
                <button
                    @click="setTab('{{ $tab }}')"
                    class="btn rounded-2xl btn-sm capitalize line-clamp-1"
                    :class="activeTab === '{{ $tab }}' ? 'btn-primary' : 'btn-ghost'">
                    {{ ucfirst($tab) }}
                </button>
            @endforeach
        </div>

        {{-- Right Side --}}
        <div class="flex-1 flex justify-end items-center">
            @if($showSearchBar)
                <x-search-bar />
            @endif

            @if ($showViewToggle)
                <div class="w-px h-full bg-gray-300 mx-5"></div>
                <div class="flex gap-2">
                    <button @click="activeView = 'cards'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'cards' ? 'btn-primary' : 'btn-ghost'">
                        <x-lucide-layout-grid class="w-5 h-5" />
                    </button>
                    <button @click="activeView = 'lists'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'lists' ? 'btn-primary' : 'btn-ghost'">
                        <x-lucide-list class="w-5 h-5" />
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- For small screen --}}
    <div class="md:hidden p-3 space-y-5">
        @if($showSearchBar)
            <x-search-bar />
        @endif
        <div class="flex w-full justify-between items-center">
            <div>
                <h1 class="text-3xl text-primary font-semibold">{{ $title }}</h1>
                <p class="font-semibold text-md text-base-content/70">{{ $titleSubHeading }}</p>
            </div>
            @if ($showViewToggle)
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

        {{-- Mobile Tab Buttons --}}
        <div class="w-full bg-base-100 rounded-3xl p-4 grid grid-cols-2 gap-2">
            @foreach ($tabs as $tab)
                <button
                    @click="setTab('{{ $tab }}')"
                    class="btn rounded-2xl btn-md capitalize"
                    :class="activeTab === '{{ $tab }}' ? 'btn-primary' : 'btn-ghost'">
                    {{ ucfirst($tab) }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Panels --}}
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
