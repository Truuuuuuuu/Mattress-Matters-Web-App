{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($tenantHistory as $history)
        <x-tenant-history-card :$history/>
    @empty
        <div class="col-span-full   flex flex-col items-center mx-auto mt-10 text-base-content/70 italic ">
            <img src="{{asset('images/empty-record.svg')}}" alt="Empty record" class="w-32 lg:w-42">
            <p class="text-base-content/70 text-center italic mt-3">You have no history of tenants</p>
        </div>
    @endforelse
</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">History</th>
                <th class="w-1/4 hidden md:table-cell">Tenant</th>
                <th class="w-1/2 hidden md:table-cell">Listing</th>
                <th class="w-1/4 hidden md:table-cell">Rental Period</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($tenantHistory as $history)
                <x-tenant-history-list :$history/>
            @empty
                <tr >
                    <td colspan="3" class=" text-center text-base-content/70 italic">
                        <img src="{{asset('images/empty-record.svg')}}" alt="Empty record" class="w-32 lg:w-42 mx-auto ">
                        <p >You have no history of tenants</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{$tenantHistory->links()}}
