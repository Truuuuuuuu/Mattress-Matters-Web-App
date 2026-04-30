@props([
    'tabs',
    'default',
    'showViewToggle' => false,
    'showSearchBar' => false,
    'title',
    'titleSubHeading' => ''
])

<div x-data="{ activeTab: '{{ $default }}', activeView: 'cards' }">
    {{--For large screen--}}
    <div class="hidden md:flex justify-between bg-base-100 rounded-3xl p-3 border border-base-300">

        {{-- Tab Buttons --}}
        <div class=" flex-1 flex justify-start items-center gap-2">
            @foreach ($tabs as $tab)
                <button
                    @click="activeTab = '{{ $tab }}'"
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

    {{--For small screen--}}
    <div class="md:hidden p-3 space-y-5" >
        @if($showSearchBar)
            <x-search-bar />
        @endif
        <div class="flex w-full justify-between items-center">
            <div>
                <h1 class="text-3xl text-primary font-semibold">{{$title}}</h1>
                <p class="font-semibold text-md text-base-content/70">{{$titleSubHeading}}</p>
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
        {{-- Tab Buttons --}}
        <div class="w-full bg-base-100 rounded-3xl p-4 flex justify-center items-center gap-2">
            @foreach ($tabs as $tab)
                <button
                    @click="activeTab = '{{ $tab }}'"
                    class="btn rounded-2xl btn-md capitalize"
                    :class="activeTab === '{{ $tab }}' ? 'btn-primary' : 'btn-ghost'">
                    {{ ucfirst($tab) }}
                </button>
            @endforeach
        </div>

        {{-- Right Side --}}

    </div>

    {{-- Panels --}}
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
