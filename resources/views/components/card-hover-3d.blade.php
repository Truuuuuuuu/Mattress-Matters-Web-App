@props(['monthly_revenue'])
<a href="#" class="hover-3d my-12 mx-2 cursor-pointer  w-full max-w-lg">

    <!-- content -->
    <div class="card w-full bg-black text-white bg-[radial-gradient(circle_at_bottom_left,#ffffff04_35%,transparent_36%),radial-gradient(circle_at_top_right,#ffffff04_35%,transparent_36%)] bg-size-[4.95em_4.95em]">
        <div class="card-body">
            <div class="flex justify-between mb-10">
                <div class="font-bold">MONTHLY REVENUE</div>
                <div class="text-5xl opacity-10">❁</div>
            </div>
            <div class="text-2xl mb-4 opacity-80">₱{{ number_format($monthly_revenue,2) }}</div>
            <div class="flex justify-between">

                <div>
                    <div class="text-xs opacity-20">CARD HOLDER</div>
                    @php
                        $parts = explode(' ', auth()->user()->name);
                        $first = strtoupper($parts[0] ?? '');
                        $middleInitial = isset($parts[1]) ? strtoupper($parts[1][0]) . '.' : '';
                        $lastInitial = isset($parts[2]) ? strtoupper($parts[2][0]) . '.' : '';
                    @endphp

                    <div>{{ $first }} {{ $middleInitial }} {{ $lastInitial }}</div>
                </div>
                <div>
                    <div class="text-xs opacity-20">DATE</div>
                    <div>{{ now()->format('m/d') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8 empty divs needed for the 3D effect -->
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</a>

