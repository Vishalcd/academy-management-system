@props(['url', 'isLink' => false, 'icon'])

<a class="{{$isLink ? 'text-blue-500' : '' }}" href="{{$url}}">
    <li class="flex items-center gap-2"><i class="ti ti-{{$icon}}"></i>{{$slot}}</li>
</a>