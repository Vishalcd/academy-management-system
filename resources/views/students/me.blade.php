<x-layout>

    <x-slot name="title">Profile</x-slot>
    <main>
        <div
            class="flex bg-white py-8 px-8 flex-col items-center justify-between rounded-xl border border-slate-200 mb-6 md:mb-12">
            <div
                class="flex w-full items-center justify-between py-4 gap-10 flex-col sm:flex-row md:flex-row lg:flex-col xl:flex-row">
                <x-user :huge="true" img="{{$student->user->photo}}" alt_text="{{$student->user->name}}"
                    description_text="{{$student->user->email}}">
                    {{$student->user->name}} - <span
                        class=" font-mono text-blue-500">{{$student->class}}-{{$student->section}}</span>
                </x-user>

                <div class="grid grid-cols-2 gap-12 sm:gap-6 lg:gap-12 lg:grid-cols-4">
                    <x-detail-box icon="phone" title="Mobile no.">
                        <x-number-container>{{$student->user->phone}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="moneybag" title="Total Fees">
                        <x-number-container>{{formatCurrency($student->total_fees)}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="cash-banknote" title="Pending Fee">
                        <x-number-container>{{formatCurrency($student->fees_due)}}</x-number-container>
                    </x-detail-box>

                    <x-detail-box icon="chart-pie" title="Status">
                        <x-pill :settle="$student->fees_settle">{{$student->fees_settle ? 'Settled' : 'Not-Settled'}}
                        </x-pill>
                    </x-detail-box>
                </div>
            </div>
        </div>

        <!-- Student Transctions Table -->
        <div class="bg-white w-full rounded-xl border border-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-5 sm:md:px-10 flex-row gap-4">
                <x-heading>Student Fee</x-heading>
            </div>

            <div class=" overflow-auto w-full">
                <!-- Table Heading -->
                <x-table-heading grid="transactions-grid">
                    <p>#ID</p>
                    <p>Deposit Amount</p>
                    <p>Payment Method</p>
                    <p>Transction For</p>
                    <p>Date</p>
                    <p>Time</p>
                </x-table-heading>


                <!-- Table Rows Start -->
                @forelse ($transactions as $transaction)
                <x-student-transaction :transaction="$transaction" />
                @empty
                <x-no-content>Transaction</x-no-content>
                @endforelse
            </div>

        </div>
    </main>
</x-layout>