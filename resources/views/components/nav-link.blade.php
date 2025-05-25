@props(['url' => "/", 'active'=> false, 'icon'])

<li class="h-full flex items-stretch">
    <a class="self-center h-full hover:text-slate-800 transition-colors flex gap-2 items-center px-2 {{$active ? "
        border-b-3 text-slate-800 border-blue-500" : "" }}" href="{{$url}}"><i class="ti ti-{{$icon}}"></i>
        {{$slot}}</a>
</li>