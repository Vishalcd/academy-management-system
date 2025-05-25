@props(['name', 'id', 'options' => [], 'value'=> null])


<div class="relative w-full">
    <select name="{{$name}}" id="{{$id}}"
        class="w-full bg-transparent placeholder:text-slate-400 text-slate-600 text-sm border border-slate-200 rounded pl-8.5 h-10 pr-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 appearance-none cursor-pointer font-medium">
        @foreach ($options as $optionValue => $optionLable)
        <option value="{{$optionValue }}" {{ request($name)==$optionValue ? 'selected' : '' }} {{old($name,
            $value)==$optionValue ? 'selected' : '' }}>{{$optionLable}}
        </option>
        @endforeach
    </select>
    <i class="ti ti-selector h-5 w-5 ml-1 absolute top-3 left-2.5  text-slate-600"></i>
</div>