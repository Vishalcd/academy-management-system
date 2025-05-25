@props(['url' => "#"])

<a href="{{$url}}">
    <button class="bg-white border border-slate-200 rounded-md flex items-center justify-center gap-1 px-2 h-8">
        {{$slot}}
    </button>
</a>