<x-layout>
    <x-slot:heading>My Unit</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto lg:px-5 ">
        @if($myUnit?->reservation?->status === 'checked_in')
            <div class="drawer lg:drawer-open" x-data="{ activeSection: 'overview' }">
                <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Navbar -->
                    <nav class="navbar w-full bg-base-300">
                        <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
                            <!-- Sidebar toggle icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4"><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path><path d="M9 4v16"></path><path d="M14 10l2 2l-2 2"></path></svg>
                        </label>
                        <div class="px-4 font-bold">Current Stay</div>
                    </nav>
                    <!-- Page content here -->
                    <div class="p-4 lg:flex flex-col gap-3">
                        {{--Main section--}}
                        <div x-show="activeSection === 'overview'">
                            @include('tenant.myUnit.overview')
                        </div>
                        <div x-show="activeSection === 'payments'">
                            @include('tenant.myUnit.soa')
                        </div>
                        <div x-show="activeSection === 'rules'">
                            @include('tenant.myUnit.rules')
                        </div>
                    </div>
                </div>

                <div class="drawer-side is-drawer-close:overflow-visible">
                    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="flex pt-15 min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
                        <!-- Sidebar content here -->
                        <ul class="menu w-full grow">
                            <!-- List item -->
                            <li>
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Overview"  :class="{ 'active': activeSection === 'overview' }" @click="activeSection = 'overview'">
                                    <!-- Overview icon -->
                                    <x-lucide-layout-dashboard class="w-4 h-4 my-1.5"/>
                                    <span class="is-drawer-close:hidden">Overview</span>
                                </button>
                            </li>

                            <!-- List item -->
                            <li>
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Payments"  :class="{ 'active': activeSection === 'payments' }" @click="activeSection = 'payments'">
                                    <!-- Payments icon -->
                                    <x-lucide-hand-coins class="w-4 h-4 my-1.5"/>
                                    <span class="is-drawer-close:hidden">Payments</span>
                                </button>
                            </li>
                            <!-- List item -->
                            <li>
                                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Rules & Amenities" :class="{ 'active': activeSection === 'rules' }" @click="activeSection = 'rules'">
                                    <!-- Rules & Amenities icon -->
                                    <x-lucide-scroll class="w-4 h-4 my-1.5"/>
                                    <span class="is-drawer-close:hidden">Rules & Amenities</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>





    @else
        <div class=" flex mt-20 justify-center items-center">
            Don't have active rental yet.
        </div>
    @endif

 {{--   <div class="{{!$myUnit ? 'h-0' : 'h-24'}}">

    </div>--}}
</x-layout>
