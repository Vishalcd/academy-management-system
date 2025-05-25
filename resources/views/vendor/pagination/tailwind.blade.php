@if ($paginator->hasPages())
<nav class="flex justify-center items-center gap-2 my-6 text-sm font-medium" role="navigation">
    {{-- Pre Link --}}
    @if ($paginator->onFirstPage())
    <button disabled class="bg-white opacity-70 border border-slate-200 rounded-md">
        <span class="flex items-center justify-center px-4 h-8 leading-2">
            <i class="ti ti-chevron-left"></i> Prev
        </span>
    </button>
    @else
    <button class="bg-white hover:bg-blue-500 hover:text-slate-100 border border-slate-200 rounded-md">
        <a class="flex items-center justify-center px-4 h-8 leading-2" href="{{$paginator->previousPageUrl()}}">
            <i class="ti ti-chevron-left"></i> Prev
        </a>
    </button>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element )
    {{-- Three Dot Sperator --}}
    @if (is_string($element))
    <span class="flex items-center justify-center px-3 rounded-md leading-2 h-8 bg-white border border-slate-200">
        {{$element}}
    </span>
    @endif
    {{-- Array of links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url )
    @if ($page == $paginator->currentPage())
    <span
        class="flex items-center justify-center px-3 rounded-md leading-2 h-8 bg-blue-500 text-white border border-slate-200">
        {{$page}}
    </span>
    @else
    <a class="flex items-center justify-center px-3 rounded-md leading-2 h-8 hover:bg-blue-500 hover:text-slate-100 bg-white border border-slate-200"
        href="{{$url}}">
        {{$page}}
    </a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- next Link --}}
    @if ($paginator->onLastPage())
    <button disabled class="bg-white opacity-70 border border-slate-200 rounded-md">
        <span class="flex items-center justify-center px-4 h-8 leading-2">
            Next <i class="ti ti-chevron-right"></i>
        </span>
    </button>
    @else
    <button class="bg-white hover:bg-blue-500 hover:text-slate-100 border border-slate-200 rounded-md">
        <a class="flex items-center justify-center px-4 h-8 leading-2" href="{{$paginator->nextPageUrl()}}">
            Next <i class="ti ti-chevron-right"></i>
        </a>
    </button>
    @endif
</nav>
@else
@endif