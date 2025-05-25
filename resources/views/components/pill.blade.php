@props(['settle' => false])

<p
    class="flex items-center min-w-fit w-30 justify-center  {{$settle ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800'}} rounded-full text-sm font-semibold px-4 text-nowrap leading-4 py-0.5">
    {{$slot}}
</p>