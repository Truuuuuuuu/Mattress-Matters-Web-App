{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($movingOutTenants as $movingOutTenant)
        <x-move-out-notice-card :$movingOutTenant/>
    @empty
        <div class="col-span-full flex flex-col items-center mx-auto  text-base-content/70 italic ">
            <img src="{{asset('images/move-out-notice.svg')}}" alt="Move-out" class="w-52 lg:w-64">
            <p class="text-base-content/70 text-center italic -mt-5">You have no moving out tenants</p>
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
                <tr>
                    <td colspan="5" class=" text-center text-base-content/70 italic">
                        <img src="{{asset('images/move-out-notice.svg')}}" alt="Empty record" class="w-52 lg:w-64 mx-auto ">
                        <p class="-mt-5">You have no moving out tenants</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
