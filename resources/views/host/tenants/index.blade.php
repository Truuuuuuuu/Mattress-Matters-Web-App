<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>

    <!-- name of each tab group should be unique -->
    <div class="tabs tabs-lift px-15 mt-5">
        <label class="tab">
            <input type="radio" name="my_tabs_4" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" /></svg>
            Active
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
            <section >
                <div class="flex justify-between ">
                    <div class="flex items-center ">
                        <h1 class="text-3xl font-semibold">My Tenants</h1>
                    </div>
                    <div>
                        <x-search-bar />
                    </div>
                </div>
                <!-- Toggle Buttons -->
                <div class="join mb-4 flex justify-end  mt-4">
                    <button class="btn join-item" onclick="setView1('card')"><x-lucide-layout-grid class="h-4 w-4"/> Cards</button>
                    <button class="btn join-item" onclick="setView1('list')"><x-lucide-list class="h-4 w-4"/> List</button>
                </div>

                <!-- Card View -->
                <div id="tenant-card-view" class="grid grid-cols-4 gap-4">
                    @forelse($myTenants as $myTenant)
                        <x-tenant-card :$myTenant/>
                    @empty
                        <p>You have no tenants yet</p>
                    @endforelse
                </div>

                <!-- List View -->
                <div id="tenant-list-view" class="hidden flex flex-col gap-2 ">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Listing</th>
                                <th>Monthly Rent</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($myTenants as $myTenant)
                                <x-tenant-list :$myTenant/>
                            @empty
                                <td colspan="5" class="text-center mt-10">No available tenants</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <label class="tab">
            <input type="radio" name="my_tabs_4"  checked="checked"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" /></svg>
            Moving Out
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
            <section>
                <div class="flex justify-between ">
                    <div class="flex items-center ">
                        <h1 class="text-3xl font-semibold">Move Out Notice</h1>
                    </div>
                    <div>
                        <x-search-bar />
                    </div>
                </div>
                <!-- Toggle Buttons -->
                <div class="join mb-4 flex justify-end  mt-4">
                    <button class="btn join-item" onclick="setView2('card')"><x-lucide-layout-grid class="h-4 w-4"/> Cards</button>
                    <button class="btn join-item" onclick="setView2('list')"><x-lucide-list class="h-4 w-4"/> List</button>
                </div>
                <!-- Card View -->
                <div id="move-out-card-view" class="grid grid-cols-4 gap-4">
                    @forelse($movingOutTenants as $movingOutTenant)
                        <x-move-out-notice-card :$movingOutTenant/>
                    @empty
                        <p>You have no moving out tenants </p>
                    @endforelse
                </div>

                <!-- List View -->
                <div id="move-out-list-view" class="hidden flex flex-col gap-2 ">
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
                                <td colspan="5" class="text-center mt-10">No moving out out tenants</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

        <label class="tab">
            <input type="radio" name="my_tabs_4" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
            History
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
            History
        </div>
    </div>


</x-layout>







<script>
    function setView1(type) {
        document.getElementById('tenant-card-view').classList.toggle('hidden', type !== 'card');
        document.getElementById('tenant-list-view').classList.toggle('hidden', type !== 'list');
    }

    function setView2(type) {
        document.getElementById('move-out-card-view').classList.toggle('hidden', type !== 'card');
        document.getElementById('move-out-list-view').classList.toggle('hidden', type !== 'list');
    }

</script>
