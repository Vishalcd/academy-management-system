@props(['lable' => null, 'name', 'icon' => 'user', 'type' => 'text', 'id',
'placeholder' => null,'value'=> null, 'row' => true])

<div class="flex  {{$row === true ? 'items-center' : 'flex-col'}} gap-2 w-full">
    @if ($lable)
    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600" for="{{$id}}">
        <span class="text-lg"><i class="ti ti-{{$icon}}"></i></span>
        {{$lable}}
    </label>
    @endif

    <div class="w-full">
        <input
            class="@error($name) !border-red-300
            @enderror text-base font-medium placeholder:text-sm border px-2.5 h-10 w-full py-1.5  border-slate-200 rounded-md placeholder:text-slate-400 file:self-center file:bg-blue-200 file:px-2 file:h-full file:rounded-sm file:cursor-pointer file:font-semibold file:text-blue-500 file:mr-2 "
            type="{{$type}}" id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}"
            value="{{old($name, $value)}}" />
        @error($name)
        <p class="  mt-1 text-sm text-red-500">{{$message}}</p>
        @enderror
    </div>

</div>