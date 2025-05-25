@props(['resource'])

<form method="POST" class="">
    @csrf
    @method('DELETE')
    <div class="flex items-center mb-4 text-4xl justify-center text-red-500"><i class="ti ti-alert-triangle"></i></div>
    <h4 class="text-center text-2xl mb-2 font-bold text-slate-700">Delete {{$resource}}</h4>
    <p class=" text-center w-3/4 mx-auto font-normal text-slate-700 mb-6">
        You're going to delete the {{$resource}}. Are you sure?
    </p>
    <div class="grid grid-cols-2 gap-3">
        <button id="btn-cancel" type="button"
            class=" rounded-md bg-slate-100 h-10 px-4 flex font-medium items-center justify-center ">
            No, Keep it.
        </button>
        <button type="submit"
            class=" bg-red-500 text-slate-100 font-medium rounded-md h-10 px-4 flex items-center justify-center ">
            Yes, Delete!
        </button>
    </div>
</form>