@props(['grid' => null])

<div class="grid {{$grid}} bg-slate-600 font-medium md:py-2.5 py-2   md:px-10 px-5 text-slate-100 min-w-fit">
    {{$slot}}
</div>