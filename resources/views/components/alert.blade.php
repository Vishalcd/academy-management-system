@props(['type', 'message'])

@if (session()->has($type))
<div id="alert" class="fixed bottom-12 right-12 z-50 ">
    <div
        class="p-3 px-12 font-semibold tracking-tight {{$type ===  'success' ? 'text-green-600 border-green-600 bg-green-200' : 'text-red-600 border-red-600 bg-red-200'}} border shadow-md transition-all  ml-auto rounded flex items-center justify-center gap-2 w-max">
        <span class="flex items-center gap-1.5">{{$message}} <i
                class="ti ti-{{$type ===  'success' ? 'check' : 'x'}} text-xl"></i></span>
    </div>
</div>
@endif