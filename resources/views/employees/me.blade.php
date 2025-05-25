<x-layout>

    <main>
        <div
            class="flex bg-white py-8 px-8 flex-col items-center justify-between rounded-xl border border-slate-200 mb-6 md:mb-12">
            <div
                class="flex w-full items-center justify-between py-4 gap-10 flex-col sm:flex-row md:flex-row lg:flex-col xl:flex-row">
                <x-user :huge="true" img="{{$employee->user->photo}}" alt_text="{{$employee->user->name}}"
                    description_text="{{$employee->user->email}}">
                    {{$employee->user->name}} - <span class=" font-mono text-blue-600">{{$employee->job_title}}</span>
                </x-user>

                <div class="grid grid-cols-2 gap-12 sm:gap-6 lg:gap-12 lg:grid-cols-4">
                    <x-detail-box icon="phone" title="Mobile no.">
                        <x-number-container>{{$employee->user->phone}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="moneybag" title="Total Salary">
                        <x-number-container>{{formatCurrency($employee->salary)}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="briefcase" title="Job Profession">
                        <x-number-container>{{$employee->job_title}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="calendar" title="Join Us">
                        <x-number-container>{{$employee->created_at->format('d M, Y')}}</x-number-container>
                    </x-detail-box>
                </div>
            </div>
        </div>

        <!-- Employee Transctions Table -->
        <div class="bg-white w-full rounded-xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-5 sm:md:px-10 flex-row gap-4">
                <div class="flex items-center gap-6">
                    <x-heading>Employee Fee</x-heading>
                </div>
            </div>

            <div class="overflow-auto w-full">
                <!-- Table Heading -->
                <x-table-heading grid="transactions-grid">
                    <p>#ID</p>
                    <p>Deposit Amount</p>
                    <p>Pending Amount</p>
                    <p>Type</p>
                    <p>Date</p>
                    <p>Time</p>
                </x-table-heading>


                @forelse ($transactions as $transaction)
                <x-employee-transaction :transaction="$transaction" />
                @empty
                <x-no-content>Transaction</x-no-content>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>