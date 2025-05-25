@props(['name','id', 'icon' => null, 'lable', 'placeholder', 'value' => null])

<div class="w-full">
    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 mb-2 text-slate-600" for="{{$id}}">
        <span class="text-lg"><i class="ti ti-{{$icon}}"></i></span>
        {{$lable}}
    </label>
    <textarea
        class="@error($name) !border-red-300
            @enderror text-base resize-none h-30 font-medium  placeholder:text-sm border px-4 w-full py-4 border-slate-200 rounded-md placeholder:text-slate-400  "
        name="{{$name}}" id="{{$id}}" placeholder="{{$placeholder}}">{{old($name, $value)}}</textarea>

    @error($name)
    <p class=" mt-1 text-sm text-red-500">{{$message}}</p>
    @enderror
</div>