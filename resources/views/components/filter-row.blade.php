@props(['lable'])

<div class="flex flex-col gap-1 px-2 py-2">
    <p class="flex items-center gap-0.5 font-bold text-slate-500 tracking-tight text-sm">{{$lable}}</p>
    <div class="flex items-center gap-2">
        {{$slot}}
    </div>
</div>