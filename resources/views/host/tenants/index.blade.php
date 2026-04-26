<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-5 py-7 bg-base-200">
        <div class="mb-5">
            <h1 class="text-4xl font-semibold">My Tenants</h1>
            <p class="text-xs font-semibold ">Manage your tenants and keep track of their boarding details </p>
        </div>
        <x-tabs :tabs="['active', 'moving out', 'history']" default="active" :showViewToggle="true">

            <x-tab-panel name="active">
                @include('host.tenants.partials.active-content')
            </x-tab-panel>

            <x-tab-panel name="moving out">
                @include('host.tenants.partials.moving-out-content')
            </x-tab-panel>

            <x-tab-panel name="history">
                @include('host.tenants.partials.history-content')
            </x-tab-panel>

        </x-tabs>
    </div>


</x-layout>
