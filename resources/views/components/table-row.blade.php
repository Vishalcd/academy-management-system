@props(['grid' => null])

<div class="grid {{$grid}} py-4 px-5 md:py-4 md:px-10  items-center border-t border-slate-200">
    {{$slot}}
</div>