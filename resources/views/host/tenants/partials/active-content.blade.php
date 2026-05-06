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
        <div class="col-span-full  mx-auto  text-base-content/70 italic ">
            <img src="{{asset('images/tenants.svg')}}" alt="Tenants" class="w-32 lg:w-64">
            <p class="text-base-content/70 text-center italic -mt-5">You have no tenants yet</p>
        </div>
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
                <tr>
                    <td colspan="4" class=" text-center text-base-content/70 italic">
                        <img src="{{asset('images/tenants.svg')}}" alt="Empty record" class="w-24 lg:w-64 mx-auto ">
                        <p class="-mt-5">No available tenants</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
