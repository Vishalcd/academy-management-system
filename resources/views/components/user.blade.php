@props(['img', 'alt_text' => 'User Default Picture', 'description_text' => null, 'huge' =>
false ])

@if ($huge)
<div class="flex items-center gap-4">
    <div class="w-16 aspect-square overflow-hidden rounded-full"><img class=" h-full bg-blue-50 w-full"
            src="/storage/{{$img}}" alt="{{$alt_text}}" onerror="this.onerror=null;this.src='/img/default_user.jpg';" />
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-lg font-bold tracking-tight leading-4 text-slate-800">
            {{$slot}}
        </p>
        <span class="leading-4 text-base text-slate-600">{{$description_text}}</span>
    </div>
</div>
@else
<div class="flex items-center gap-2">
    <div class="w-10 aspect-square overflow-hidden  rounded-full"><img class=" h-full bg-blue-50 w-full"
            src="/storage/{{$img}}" alt="{{$alt_text}}" onerror="this.onerror=null;this.src='/img/default_user.jpg';" />
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-base font-bold tracking-tight leading-4 text-slate-800">
            {{$slot}}
        </p>
        <span class="leading-4 text-sm text-slate-600">{{$description_text}}</span>
    </div>
</div>
@endif