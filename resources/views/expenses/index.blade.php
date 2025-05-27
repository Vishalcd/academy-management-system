<x-layout>
    <x-slot name="title">Expenses</x-slot>
    {{-- add expense form --}}
    <template id="add-expense">
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Add New Expense</x-heading>
            </div>

            <!-- Row Left -->
            <div class="grid gap-y-6">
                @csrf
                <x-input-box lable="Enter Title" name="title" id="title" placeholder="Enter Expense Title"
                    icon="article" />
                <x-input-box lable="Unit Price" name="unit_price" id="unit_price" placeholder="{{formatCurrency(1000)}}"
                    icon="cash-banknote" />

                <x-input-box lable="Total Unit" name="quantity" id="quantity" placeholder="Enter Total Unit"
                    icon="package" />

                <x-input-box lable="Total Price" name="total_price" id="total_price"
                    placeholder="{{formatCurrency(10000)}}" icon="moneybag" />

            </div>

            <!-- Row Right -->
            <div class="grid gap-y-6">
                <x-input-box lable="Recipt Image" type="file" name="photo" id="photo" icon="receipt-rupee" />

                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="payment_settled">
                        <span class="text-lg"><i class="ti ti-chart-pie"></i></span>
                        Payment Status
                    </label>

                    <x-select name="payment_settled" id="payment_settled"
                        :options="['true' => 'Settle', 'false' => 'Not-Settled']" />
                </div>

                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="payment_type">
                        <span class="text-lg"><i class="ti ti-credit-card"></i></span>
                        Payment Type
                    </label>

                    <x-select name="payment_type" id="payment_type"
                        :options="['cash' => 'Cash', 'online' => 'Online']" />
                </div>

                <x-input-box lable="Shop Name" type="shop_details" placeholder="Shop Name" name="shop_details"
                    id="shop_details" icon="building-store" />
            </div>

            <div class="col-start-1 -col-end-1 mt-2">
                <x-input-text-area lable="Description" icon="file-description" id="description" name="description"
                    placeholder="Enter breif description of expense" />
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Add Expense</span></x-button-primary>
            </div>
        </form>
    </template>

    <main class="bg-white rounded-xl border border-slate-200">
        <!-- Page Details & Filters -->
        <div class="flex flex-col lg:flex-row gap-8 py-8 px-8 items-center justify-between">
            <div class="flex flex-col gap-1">
                <x-bread-crumb>
                    <a href="{{url("/expenses")}}">Expenses</a>
                </x-bread-crumb>
                <x-heading>{{ request('search') ? 'Search Result for: ' . request('search') : 'Expenses' }}
                </x-heading>
            </div>

            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="#add-expense">
                    <x-button-primary icon="square-rounded-plus">Add Expense
                    </x-button-primary>
                </a>
                <x-button-filter url="expenses.index">
                    {{-- Sort By Low-to-High Expense --}}
                    <x-filter-row lable="Sort By Expense">
                        <x-select name="sort" id="sort"
                            :options="['' => 'All Expense','low_to_high' => 'Expense Low to High','high_to_low' => 'Expense High to Low']" />
                    </x-filter-row>

                </x-button-filter>
                <x-search-box :url="route('expenses.index')" placeholder="Search by Name.." />
            </div>
        </div>

        <!-- Table -->
        <div class="grid overflow-auto whitespace-nowrap">
            <!-- Table Heading -->
            <x-table-heading grid='expense-grid'>
                <p>S.no</p>
                <p>Expense Details</p>
                <p>Unit Price</p>
                <p>Quantity</p>
                <p>Total Price</p>
                <p>Date</p>
                <p>&nbsp;</p>
            </x-table-heading>

            <!-- Table Rows Start -->
            @forelse ($expenses as $expense)
            <x-expense-row :expense="$expense" />
            @empty
            <x-no-content>Expense</x-no-content>
            @endforelse
            <!-- Table Row End -->
        </div>
    </main>

    {{-- Pagination --}}
    {{ $expenses->links() }}
</x-layout>