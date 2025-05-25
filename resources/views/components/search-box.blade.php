@props(['placeholder' => "Search by #ID", 'url' => '/'])

<div
    class="flex items-center gap-2 text-slate-600 border border-slate-200 h-10 px-4 focus-within:border-blue-300 rounded-full  w-fit">
    <span class="text-slate-300"><i class="ti ti-search"></i></span>
    <form method="GET" action="{{$url}}">
        <input class="py-1.5 w-40 bg-transparent !outline-0 font-base" name="search" value="{{ request('search') }}"
            type="text" placeholder="{{$placeholder}}" />
    </form>
</div>