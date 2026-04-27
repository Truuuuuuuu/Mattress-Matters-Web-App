{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($movingOutTenants as $movingOutTenant)
        <x-move-out-notice-card :$movingOutTenant/>
    @empty
        <p>You have no moving out tenants </p>
    @endforelse
</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">Move-out list</th>
                <th class="hidden md:table-cell">Tenant</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden lg:table-cell">Notice filed</th>
                <th class="hidden md:table-cell">Move-out date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($movingOutTenants as $movingOutTenant)
                <x-move-out-notice-list :$movingOutTenant/>
            @empty
                <td colspan="5" class="text-center mt-10">No tenants are moving out out </td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
