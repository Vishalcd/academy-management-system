@props(['icon'=> null, 'title'=> null])

<div class="flex flex-col gap-1">
    <p class="text-slate-600 font-medium text-sm tracking-tight flex items-center gap-1">
        <span><i class="ti ti-{{$icon}}"></i></span> {{$title}}
    </p>
    {{$slot}}
</div>