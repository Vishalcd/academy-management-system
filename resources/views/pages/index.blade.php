<x-layout>
    <main class="bg-white rounded-xl border p-4 md:p-8 border-slate-200">
        <!-- Page Details & Filters -->
        <div class="flex items-center justify-between mb-6 lg:mb-12">
            <div class="flex flex-col gap-1">
                <x-heading>Dashboard</x-heading>
            </div>
            <x-button-filter url="home">
                {{-- Filter By Year --}}
                <x-filter-row lable="Filter By Year">
                    <x-select name="year" id="year" :options="generateYearArray(2)" />
                </x-filter-row>
            </x-button-filter>
        </div>

        <!-- Dashboard -->
        <div class="relative border-slate-200">
            <!-- Recent Activity -->
            <div class="grid grid-cols-4 gap-4 xl:gap-8 ">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 xl:gap-8 col-start-1 w-full -col-end-1">
                    <!-- Card -->
                    <x-data-container lable="Fees Deposit" icon="cash-register"
                        style="border-green-200 bg-green-100 text-green-500">
                        {{formatCurrency($totalFees)}}
                    </x-data-container>

                    <!-- Card -->
                    <x-data-container lable="Salary Settled" icon="coin-rupee"
                        style="border-blue-200 bg-blue-100 text-blue-500">
                        {{formatCurrency($totalSalary)}}
                    </x-data-container>

                    <!-- Card -->
                    <x-data-container lable="All Expenses" icon="calendar-dollar"
                        style="border-red-200 bg-red-100 text-red-500">
                        {{formatCurrency($totalExpense)}}
                    </x-data-container>

                    <!-- Card -->
                    <x-data-container lable="Total Revenue" icon="coin-rupee"
                        style="border-yellow-200 bg-yellow-100 text-yellow-500">
                        {{formatCurrency($revenue)}}
                    </x-data-container>
                </div>


                {{-- Recent Activity --}}
                <div
                    class="bg-white col-start-1 -col-end-1 lg:col-start-1 lg:col-end-3  rounded-lg border px-2 py-6 border-slate-200">
                    <h2 class="font-bold text-xl text-slate-600 px-6 mb-4">Recent
                        Activity</h2>
                    <div class=" inline w-full justify-center ">

                        @forelse ($latestTransactions as $latestTransaction)
                        <x-activity-row :transaction="$latestTransaction" />
                        @empty
                        <x-no-content>Activity</x-no-content>
                        @endforelse
                    </div>

                </div>

                {{-- Donout Chart --}}
                <div
                    class="bg-white col-start-1 -col-end-1 lg:col-start-3 lg:-col-end-1  rounded-lg border px-2 py-6 border-slate-200">
                    <h2 class="font-bold text-xl text-slate-600 px-6 mb-4 ">Transaction Overview</h2>
                    @if ($doughnutData['Fee Deposit'] !== 0 || $doughnutData['Expense'] !== 0 ||
                    $doughnutData['Salary'] !==
                    0)
                    <div class="mx-auto w-4/5 ">
                        <canvas class="" id="myDoughnutChart" aria-label="Hello ARIA World" role="img"></canvas>
                    </div>
                    @else
                    <x-no-content>Data</x-no-content>
                    @endif

                </div>

                {{-- Graph Chart --}}
                <div class="bg-white col-start-1 -col-end-1 rounded-lg border px-6 h-[400px]  py-6 border-slate-200">
                    <h2 class="font-bold text-xl text-slate-600 px-6 ">Transactions from Jan 01 {{$selectedYear}} — Dec
                        31
                        {{$selectedYear}}
                    </h2>
                    <div class=" mx-auto h-75 w-full overflow-auto mt-6">
                        <canvas class="" id="myChart" aria-label="Hello ARIA World" role="img"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @section('scripts')
    <script>
        const doughnutData = @json($doughnutData);
        const graphData = @json($graphData);
    </script>
    @endsection
</x-layout>