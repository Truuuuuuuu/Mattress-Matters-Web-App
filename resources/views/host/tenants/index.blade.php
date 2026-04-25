<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-5 py-7 bg-base-200">
        <div class="mb-5">
            <p class="text-xs font-semibold ">Tenant Overiew</p>
            <h1 class="text-4xl font-semibold">My Tenants</h1>
        </div>
        {{--Main tabs--}}
        <div x-data="{activeTab: 'active' , activeView: 'cards' }">
            <div class="flex justify-between bg-base-100 rounded-3xl p-3">
                <div class="flex-1 flex  justify-start items-center gap-2">
                    @foreach (['active', 'moving out', 'history'] as $tab)
                        <button
                            @click="activeTab = '{{ $tab }}'"
                            class="btn rounded-2xl btn-sm capitalize"
                            :class="activeTab === '{{ $tab }}'
                            ? 'btn-primary'
                            : 'btn-ghost'">
                            {{ ucfirst($tab) }}
                        </button>
                    @endforeach
                </div>
                <div class="flex-1  flex justify-end items-center ">
                    <x-search-bar/>
                    <div class="w-px h-full mx-5 bg-gray-300 mx-2"></div>
                    <div class="flex gap-2">
                        <div
                            @click="activeView = 'cards'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'cards' ? 'btn-primary' : 'btn-outline'">
                            <x-lucide-layout-grid class="w-5 h-5"/>
                        </div>
                        <div
                            @click="activeView = 'lists'"
                            class="btn rounded-2xl btn-md"
                            :class="activeView === 'lists' ? 'btn-primary' : 'btn-outline'">
                            <x-lucide-list class="w-5 h-5"/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Panels --}}
            <div class="mt-4">
                <div x-show="activeTab === 'active'" x-transition>
                    @include('host.tenants.partials.active-content')
                </div>

                <div x-show="activeTab === 'moving out'" x-transition>
                    @include('host.tenants.partials.moving-out-content')
                </div>

                <div x-show="activeTab === 'history'" x-transition>
                    @include('host.tenants.partials.history-content')
                </div>
            </div>
        </div>
    </div>


</x-layout>
