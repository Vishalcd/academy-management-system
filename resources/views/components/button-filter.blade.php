@props(['url'])

<div class="relative">
    <button id="filter"
        class="bg-white border h-10 font-medium text-slate-600 border-slate-200 rounded-md flex items-center justify-center gap-1 px-4 ">
        <i class="ti ti-adjustments"></i> Filters
    </button>

    <x-filter-box :url="route($url)">{{$slot}}</x-filter-box>
</div>