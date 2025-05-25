@props(['lable', 'icon', 'style'])

<div
    class="grid grid-cols-[auto_1fr] gap-x-4 grid-rows-[auto_1fr] bg-white rounded-lg border border-slate-200 px-4 py-4 pr-3 md:pr-6 xl:pr-12">
    <span
        class="row-start-1 -row-end-1 h-full border {{$style}} text-2xl aspect-square rounded-full flex items-center justify-center">
        <i class="ti ti-{{$icon}}"></i>
    </span>
    <div class="flex gap-2 text-sm items-center font-medium text-slate-500">
        {{$lable}}
    </div>
    <p class="col-start-2 -col-end-1 tracking-tight text-xl font-black font-mono whitespace-nowrap text-salte-800">
        {{$slot}}
    </p>
</div>