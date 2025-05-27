<div id="modal" class="fixed z-50 inset-0 bg-[rgba(0,0,0,0.80)] backdrop-blur-xs items-center  justify-center hidden">
    <div
        class=" h-dvh md:h-min md:rounded-lg md:w-fit w-full shadow-md overflow-hidden relative px-10 py-12  border border-slate-200 bg-slate-50 flex items-center justify-center">
        <button id="btn-close"
            class=" hover:rotate-90 hover:scale-105  transition-all absolute top-3 text-xl font-black right-3 bg-transparent outline-0 w-10 aspect-square rounded-sm flex items-center justify-center">
            <i class="ti ti-x "></i>
        </button>

        <div id="modal-container">
            <!-- {slot} -->
        </div>
    </div>
</div>