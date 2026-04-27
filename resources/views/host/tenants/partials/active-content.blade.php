{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($myTenants as $myTenant)
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
        <x-tenant-card :$myTenant/>
    @empty
        <p>You have no tenants yet</p>
    @endforelse
</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">Tenant list</th>
                <th class="hidden md:table-cell">Name</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Monthly Rent</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($myTenants as $myTenant)
                <x-tenant-list :$myTenant/>
                <x-tenant-list :$myTenant/>
                <x-tenant-list :$myTenant/>
                <x-tenant-list :$myTenant/>
            @empty
                <td colspan="5" class="text-center mt-10">No available tenants</td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
