@props(['paginator'])

@if ($paginator->lastPage() > 1)
    <div class="join mt-6">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <button class="join-item btn btn-disabled">«</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn">«</a>
        @endif


        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
        @endphp

        {{-- Always show first page --}}
        @if ($current > 3)
            <a href="{{ $paginator->url(1) }}" class="join-item btn ">1</a>
        @endif

        {{-- Left dots --}}
        @if ($current > 4)
            <button class="join-item btn btn-disabled">...</button>
        @endif

        {{-- Pages around current --}}
        @for ($i = max(1, $current - 2); $i <= min($last, $current + 2); $i++)
            @if ($i == $current)
                <button class="join-item btn btn-active ">{{ $i }}</button>
            @else
                <a href="{{ $paginator->url($i) }}" class="join-item btn">{{ $i }}</a>
            @endif
        @endfor

        {{-- Right dots --}}
        @if ($current < $last - 3)
            <button class="join-item btn btn-disabled">...</button>
        @endif

        {{-- Always show last page --}}
        @if ($current < $last - 2)
            <a href="{{ $paginator->url($last) }}" class="join-item btn">{{ $last }}</a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn">»</a>
        @else
            <button class="join-item btn btn-disabled">»</button>
        @endif

    </div>
@endif
