@props(['url'])

<div id="filter-box"
    class=" border bg-white border-slate-200 hidden rounded-lg p-4 z-30  shadow-2xl  absolute min-w-80 top-full my-4 right-0 sm:translate-x-1/2 sm:right-1/2 ">
    <div class="flex items-center justify-between text-slate-600 pb-2 border-b border-slate-100">
        <p class=" leading-0 text-lg tracking-tight text-slate-700 font-bold">All Filter</p>
        <button id="filter" class=" w-8 aspect-square rounded-sm flex items-center justify-center"><i
                class="ti ti-x"></i></button>
    </div>

    <form action="{{$url}}" method="GET">
        <div class="py-3">
            {{$slot}}
        </div>
        <div class="flex items-center justify-end gap-2 text-slate-600 pt-4 border-t border-slate-100">
            <x-button-primary type="secondary"><span class="leading-2 font-semibold">Clear</span>
            </x-button-primary>
            <x-button-primary><span class="leading-2 font-semibold">Apply Filter</span></x-button-primary>
        </div>
    </form>


</div>