<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>

    <section class="py-10 px-15">
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
            <button class="btn join-item" onclick="setView('card')"><x-lucide-layout-grid class="h-4 w-4"/> Cards</button>
            <button class="btn join-item" onclick="setView('list')"><x-lucide-list class="h-4 w-4"/> List</button>
        </div>

        <!-- Card View -->
        <div id="card-view" class="grid grid-cols-4 gap-4">
            @forelse($myTenants as $myTenant)
                <x-tenant-card :$myTenant/>
            @empty
                <p>You have no tenants yet</p>
            @endforelse
        </div>

        <!-- List View -->
        <div id="list-view" class="hidden flex flex-col gap-2 ">
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



</x-layout>

<script>
    function setView(type) {
        document.getElementById('card-view').classList.toggle('hidden', type !== 'card');
        document.getElementById('list-view').classList.toggle('hidden', type !== 'list');
    }
</script>
