<x-layout>
    <x-slot name="title">Settings</x-slot>
    <main>
        <!-- Slot -->
        <div class="bg-white p-4 md:p-8 rounded-xl border border-slate-200 mb-12">
            <div class="w-full flex items-center justify-between mb-8">
                <div class="flex items-start md:items-center flex-col md:flex-row gap-2 md:gap-4">
                    <!-- Button Back -->
                    <x-button-back url="/" />

                    <!-- Breadcrump -->
                    <x-bread-crumb>
                        <a href="{{route('settings.index')}}">Settings</a>
                    </x-bread-crumb>
                </div>

                <span class="font-semibold text-slate-400 text-xs md:text-sm">Last Update
                    {{Auth::user()->updated_at->format('d M
                    Y, h:i
                    A')}}</span>
            </div>


            {{-- Admin Settings --}}
            <div class="w-full mt-8 pb-6">
                <x-heading>Account Information</x-heading>
                <p class="text-slate-600 text-sm">Update your photo and personal details here.</p>
            </div>

            <!-- SettingForm -->
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Input Row -->
                <div class="flex flex-col md:flex-row  items-start md:items-center border-t py-6 px-4 border-slate-100">
                    <div class="flex items-center gap-1 min-w-45">
                        <span><i class="ti ti-user-circle"></i></span>
                        <label class="font-medium text-sm text-slate-600" for="name">Update FullName</label>
                    </div>

                    <div class="flex flex-col w-80 max-w-full max-h-full">

                        <x-input-box name="name" id="name" :value="old('name', Auth::user()->name)"
                            placeholder="Enter Your FullName" />
                    </div>
                </div>

                <!-- Input Row -->
                <div
                    class="flex flex-col md:flex-row  items-start md:items-center border-t border-b py-6 px-4 border-slate-100">
                    <div class="flex items-center gap-1 min-w-45">
                        <span><i class="ti ti-phone"></i></span>
                        <label class="font-medium text-sm text-slate-600" for="phone">Update Number</label>
                    </div>

                    <div class="flex flex-col w-80 max-w-full max-h-full">
                        <x-input-box id='phone' name="phone" id="phone" :value="old('phone', Auth::user()->phone)"
                            placeholder="Enter Your Phone Number" />
                    </div>
                </div>

                <!-- Input Row -->
                <div class="flex flex-col md:flex-row  items-start md:items-center border-b py-6 px-4 border-slate-100">
                    <div class="flex items-center gap-1 min-w-45">
                        <span><i class="ti ti-photo"></i></span>
                        <label class="font-medium text-sm  text-slate-600" for="photo">Upload Profile
                            Photo</label>
                    </div>

                    <div class="flex flex-col w-80 max-w-full max-h-full">

                        <x-input-box id="photo" type="file" :value="old('photo', Auth::user()->photo)" name="photo"
                            id="photo" />
                    </div>
                </div>

                <!-- Input Submit -->
                <div class="flex items-center gap-2 mt-6">
                    <button
                        class="rounded-md px-4 h-9 gap-1 flex items-center justify-center bg-blue-500 text-slate-100 font-semibold">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </main>
</x-layout>