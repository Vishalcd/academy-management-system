<x-layout>

    {{-- edit expense form --}}
    <template id="edit-expense">
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
            @csrf
            @method('PUT')
            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Add New Expense</x-heading>
            </div>

            <!-- Row Left -->
            <div class="grid gap-y-6">

                <x-input-box lable="Enter Title" name="title" id="title" placeholder="Enter Expense Title"
                    icon="article" :value="old('title', $expense->title)" />
                <x-input-box lable="Unit Price" name="unit_price" id="unit_price" placeholder="₹100.00"
                    icon="cash-banknote" :value="old('unit_price', $expense->unit_price)" />

                <x-input-box lable="Total Unit" name="quantity" id="quantity" placeholder="Enter Total Unit"
                    icon="package" :value="old('quantity', $expense->quantity)" />

                <x-input-box lable="Total Price" name="total_price" id="total_price" placeholder="₹1,000.00"
                    icon="moneybag" :value="old('total_price', $expense->total_price)" />

            </div>

            <!-- Row Right -->
            <div class=" grid gap-y-6">
                <x-input-box lable="Recipt Image" type="file" name="photo" id="photo" icon="receipt-rupee"
                    :value="old('photo', $expense->photo)" />

                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="payment_settled">
                        <span class="text-lg"><i class="ti ti-chart-pie"></i></span>
                        Payment Status
                    </label>

                    <x-select name="payment_settled" id="payment_settled"
                        :options="['true' => 'Settle', 'false' => 'Not-Settled']"
                        :value="old('payment_settled', $expense->payment_settled)" />
                </div>

                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="payment_type">
                        <span class="text-lg"><i class="ti ti-credit-card"></i></span>
                        Payment Type
                    </label>

                    <x-select name="payment_type" id="payment_type" :options="['cash' => 'Cash', 'online' => 'Online']"
                        :value="old('payment_type', $expense->payment_type)" />
                </div>

                <x-input-box lable="Shop Name" type="shop_details" placeholder="Shop Name" name="shop_details"
                    id="shop_details" icon="building-store" :value="old('shop_details', $expense->shop_details)" />
            </div>

            <div class="col-start-1 -col-end-1 mt-2">
                <x-input-text-area lable="Description" icon="file-description" id="description" name="description"
                    placeholder="Enter breif description of school expense"
                    :value="old('description', $expense->description)" />
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Add Expense</span></x-button-primary>
            </div>
        </form>
    </template>

    {{-- delete expense form --}}
    <template id="delete-expense">
        <x-delete-box resource="Expense" />
    </template>

    <main>
        <!-- Slot -->
        <div
            class="flex bg-white py-8 px-8 flex-col items-center justify-between rounded-xl border border-slate-200 mb-6 md:mb-12">
            <div class="w-full flex items-center justify-between pb-6 mb-6 border-b border-slate-200">
                <div class="flex items-start md:items-center flex-col md:flex-row gap-2 md:gap-4">
                    <!-- Button Back -->
                    <x-button-back url="{{route('expenses.index')}}" />

                    <!-- Breadcrump -->
                    <x-bread-crumb>
                        <a class="after:content-['/'] after:ml-1" href="{{route('expenses.index')}}">All Expenses</a>
                        <a href="{{route('expenses.show', $expense->id)}}">{{$expense->id}}</a>
                    </x-bread-crumb>
                </div>

                <div class="flex items-center gap-2">
                    <x-button-small url="#edit-expense"><i class="ti ti-user-edit"></i> <span
                            class="leading-2 text-sm">Edit</span>
                    </x-button-small>

                    <x-button-small url="#delete-expense">
                        <i class="ti ti-trash"></i>
                    </x-button-small>
                </div>
            </div>

            <div
                class="w-full py-4 gap-6 md:gap-16 items-center justify-center h-full grid grid-cols-1 lg:grid-cols-[2fr_4fr]">
                <div class=" flex items-center justify-center">
                    <img class="aspect-video rounded-lg overflow-hidden bg-gray-300 object-cover object-center"
                        src="/storage/{{$expense->photo}}" alt="{{$expense->title}}"
                        onerror="this.onerror=null;this.src='/img/no_image.jpg';" />
                </div>

                <div class="flex flex-col h-full gap-10">
                    <div
                        class="grid justify-center grid-cols-2 md:grid-cols-4 gap-12 md:gap-6 lg:gap-12 order-2 lg:order-1">

                        <x-detail-box icon="hash" title="Serial No.">
                            <x-number-container>{{$expense->id}}</x-number-container>
                        </x-detail-box>

                        <x-detail-box icon="cash-banknote" title="Unit Price">
                            <x-number-container>{{formatCurrency($expense->unit_price)}}</x-number-container>
                        </x-detail-box>

                        <x-detail-box icon="box" title="Total Unit">
                            <x-number-container>{{$expense->quantity}} Pc.</x-number-container>
                        </x-detail-box>

                        <x-detail-box icon="moneybag" title="Total Price">
                            <x-number-container>{{formatCurrency($expense->total_price)}}</x-number-container>
                        </x-detail-box>
                    </div>

                    <div
                        class="grid justify-center grid-cols-2 md:grid-cols-4 gap-12 md:gap-6 lg:gap-12 order-3 lg:order-2">

                        <x-detail-box icon="chart-pie" title="Payment Status">
                            <x-pill>{{$expense->payment_settled ? "Settled" : "Not-Settled"}}</x-pill>
                        </x-detail-box>

                        <x-detail-box icon="calendar-stats" title="Date & Time">
                            <x-number-container>{{$expense->created_at->format('d M, Y')}}</x-number-container>
                        </x-detail-box>

                        <x-detail-box icon="credit-card" title="Payment Type">
                            <p class="font-semibold text-green-800 text-[17px]">{{$expense->payment_type}}</p>
                        </x-detail-box>

                        <x-detail-box icon="building-store" title="Shop Details">
                            <p class="font-bold w-3/4 text-slate-800 text-sm leading-3.5 tracking-tight text-wrap">
                                {{$expense->shop_details}}
                            </p>
                        </x-detail-box>
                    </div>

                    <div class="flex items-center gap-2 order-1 lg:order-3 justify-center lg:justify-start">
                        <button
                            class="rounded-md px-4 h-9 gap-1 flex items-center justify-center bg-blue-500 text-slate-100 font-semibold">
                            <i class="ti ti-receipt-rupee"></i> Download Recipt
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Transctions Table -->
        <div class="bg-white w-full rounded-xl border border-slate-200 overflow-hidden">
            <div class="flex items-center gap-6 py-5 px-10 mb-6 border-b w-full border-slate-200">
                <x-heading>Expense Details</x-heading>
            </div>

            <div class="px-10 pb-8">
                <h3 class="tracking-tight font-bold text-slate-500 text-xl mb-3">
                    {{$expense->title}}
                </h3>
                <p class="text-base text-slate-700 leading-6">
                    <span class="font-bold">Description: </span>{{$expense->description}}
                </p>
            </div>
        </div>
    </main>
</x-layout>