{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7" >
    @forelse($moveOutHistory as $moveOutNoticeHistory)
        <x-move-out-notice-history-card :$moveOutNoticeHistory/>
    @empty
        <p class="col-span-full text-center">You have no history of move out notice</p>
    @endforelse
</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <!-- head -->
            <thead>
            <tr>
                <th class="w-2/3">Tenant</th>
                <th class="w-1/3"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($moveOutHistory as $moveOutNoticeHistory)
                <x-move-out-notice-history-list :$moveOutNoticeHistory/>
            @empty
                <td colspan="5" class="text-center mt-10 ">No history of move out notice </td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
