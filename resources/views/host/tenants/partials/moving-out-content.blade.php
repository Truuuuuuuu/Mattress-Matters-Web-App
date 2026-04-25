{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7" >
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
                <th>Tenant</th>
                <th>Listing</th>
                <th>Notice filed</th>
                <th>Move-out date</th>
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
