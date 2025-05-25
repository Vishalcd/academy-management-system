@props(['icon' => false, 'id' => null, 'target' => null, 'type' => "primary", ''])

@if ($type === 'primary')
<button data-target="{{$target}}" id="{{$id}}"
    class="rounded-md px-4 h-10 gap-1 flex items-center justify-center flex-nowrap max-w-100 text-nowrap hover:bg-blue-400  transition-colors bg-blue-500 text-slate-100 font-semibold">
    @if($icon)
    <i class="ti ti-{{$icon}}"></i>
    @endif
    {{$slot}}
</button>
@else
<button id="btn-cancel" type='button' data-target="{{$target}}" id="{{$id}}"
    class="rounded-md px-4 h-10 gap-1 flex items-center justify-center hover:bg-slate-200 border  border-slate-200 transition-colors bg-slate-100 text-slate-800 font-semibold">
    @if($icon)
    <i class="ti ti-{{$icon}}"></i>
    @endif
    {{$slot}}
</button>
@endif