<x-layout>
    <x-slot name="title">Student {{$student->user->name}}</x-slot>
    {{-- edit student form --}}
    <template id="edit-student">
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            @csrf
            @method('PUT')
            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Edit Student</x-heading>
            </div>

            <!-- Row Left -->
            <div class="grid gap-y-6">
                <x-input-box lable="Enter Full Name" :value="old('name', $student->user->name)" name="name" id="name"
                    placeholder="FullName" icon="user" />
                <x-input-box lable="Email Address" :value="old('email', $student->user->email)" name="email" id="email"
                    placeholder="your@mail.com" icon="mail" />
                <x-input-box lable="Phone Number" :value="old('phone', $student->user->phone)" name="phone" id="phone"
                    placeholder="xxxxx-xxxxx" icon="phone" />
            </div>

            <!-- Row Right -->
            <div class="grid gap-y-6">
                <x-input-box lable="Enter Total Fees" :value="old('total_fees', $student->total_fees)" name="total_fees"
                    id="total_fees" placeholder="{{formatCurrency(30000)}}" icon="moneybag" />

                <x-input-box lable="Admission Date" :value="old('created_at', $student->created_at->format('Y-m-d'))"
                    type="date" name="created_at" id="created_at" icon="calendar-event" />

                <!-- Input Row -->
                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600" for="class">
                        <span class="text-lg"><i class="ti ti-school"></i></span>
                        Class & Section
                    </label>
                    <div class="grid grid-cols-2 gap-2 w-full">
                        <x-select :value="old('class', $student->class)" name="class" id="class"
                            :options="['1' => '1st','2' => '2nd','3' => '3rd','4' => '4th','5' => '5th','6' => '6th','7' => '7th','8' => '8th','9' => '9th','10' => '10th','11' => '11th','12' => '12th',]" />

                        <x-select :value="old('section', $student->section)" name="section" id="section"
                            :options="['A' => 'Section A','B'=> 'Section B','C' => 'Section C', ]" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Edit Student</span></x-button-primary>
            </div>
        </form>
    </template>

    {{-- delete student form --}}
    <template id="delete-student">
        <x-delete-box resource="Student" />
    </template>

    {{-- submit Deposit Fee form --}}
    <template id="deposit-fee">
        <form method="POST" action="/students/{{$student->id}}/deposit-fees" class="grid gap-x-8 gap-y-4">
            @csrf
            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Deposit Fees</x-heading>
            </div>

            <!-- Row Left -->
            <div class="grid gap-y-6">
                <x-input-box lable="Enter Deposit Fee" name="transaction_amount" id="transaction_amount"
                    placeholder="₹10,000.00" icon="moneybag" />
                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="transaction_method">
                        <span class="text-lg"><i class="ti ti-credit-card"></i></span>
                        Payment Method
                    </label>

                    <x-select name="transaction_method" id="transaction_method"
                        :options="['cash' => 'Cash', 'online' => 'Online' ]" />
                </div>
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Deposit Fees</span></x-button-primary>
            </div>
        </form>
    </template>

    <main>
        <div
            class="flex bg-white py-8 px-8 flex-col items-center justify-between rounded-xl border border-slate-200 mb-6 md:mb-12">
            <div class="w-full flex items-center justify-between pb-6 mb-6 border-b border-slate-200">
                <div class="flex items-start md:items-center flex-col md:flex-row gap-2 md:gap-4">
                    <!-- Button Back -->
                    <x-button-back url="{{route('students.index')}}" />

                    <!-- Breadcrump -->
                    <x-bread-crumb>
                        <a class="after:content-['/'] after:ml-1" href="{{route('students.index')}}">All Students</a>
                        <a href="{{route('students.show', $student->id)}}">{{$student->id}}</a>
                    </x-bread-crumb>
                </div>

                <div class="flex items-center gap-2">
                    <x-button-small url="#edit-student"><i class="ti ti-user-edit"></i> <span
                            class="leading-2 text-sm">Edit</span>
                    </x-button-small>

                    <x-button-small url="#delete-student">
                        <i class="ti ti-trash"></i>
                    </x-button-small>
                </div>
            </div>

            <div
                class="flex w-full items-center justify-between py-4 gap-10 flex-col sm:flex-row md:flex-row lg:flex-col xl:flex-row">
                <x-user :huge="true" img="{{$student->user->photo}}" alt_text="{{$student->user->name}}"
                    description_text="{{$student->user->email}}">
                    {{$student->user->name}} - <span
                        class=" font-mono text-blue-500">{{$student->class}}-{{$student->section}}</span>
                </x-user>

                <div class="grid grid-cols-2 gap-12 sm:gap-6 lg:gap-12 lg:grid-cols-4">
                    <x-detail-box icon="phone" title="Mobile no.">
                        <x-make-call>{{$student->user->phone}}</x-make-call>
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
                @if (!$student->fees_settle)
                <a href="#deposit-fee">
                    <x-button-primary>
                        <i class="ti ti-square-rounded-plus"></i> Deposit Fee
                    </x-button-primary>
                </a>
                @endif
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