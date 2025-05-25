@props(['url' => null])

<form action="{{$url}}" method="GET">
    <button class="flex items-center gap-1 font-semibold text-blue-500">
        {{$slot}}
    </button>
</form>