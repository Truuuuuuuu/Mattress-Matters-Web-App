<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>

    <!-- name of each tab group should be unique -->
    <div class="tabs tabs-lift px-15 mt-5">
        <label class="tab">
            <input type="radio" name="my_tabs_4" checked="checked"/>
            <span class="size-2 rounded-full bg-success mr-3"></span>
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
            <input type="radio" name="my_tabs_4"  />
            <x-lucide-log-out class="size-4 mr-3 text-warning" />
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
                                <td colspan="5" class="text-center mt-10">No tenants are moving out out </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

        <label class="tab">
            <input type="radio" name="my_tabs_4" />
            <x-lucide-history class="size-4 mr-3 text-base-content"/>
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
