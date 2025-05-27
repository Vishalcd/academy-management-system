<x-layout>
    <x-slot name="title">Students</x-slot>
    {{-- add student form --}}
    <template id="add-student">
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Add New Student</x-heading>
            </div>

            <!-- Row Left -->
            <div class="grid gap-y-6">
                @csrf
                <x-input-box lable="Enter Full Name" name="name" id="name" placeholder="FullName" icon="user" />
                <x-input-box lable="Email Address" name="email" id="email" placeholder="your@mail.com" icon="mail" />
                <x-input-box lable="Phone Number" name="phone" id="phone" placeholder="xxxxx-xxxxx" icon="phone" />
            </div>

            <!-- Row Right -->
            <div class="grid gap-y-6">
                <x-input-box lable="Enter Total Fees" name="total_fees" id="total_fees"
                    placeholder="{{formatCurrency(30000)}}" icon="moneybag" />

                <x-input-box lable="Admission Date" type="date" name="created_at" id="created_at"
                    icon="calendar-event" />

                <!-- Input Row -->
                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600" for="class">
                        <span class="text-lg"><i class="ti ti-school"></i></span>
                        Class & Section
                    </label>
                    <div class="grid grid-cols-2 gap-2 w-full">
                        <x-select name="class" id="class"
                            :options="['1' => '1st','2' => '2nd','3' => '3rd','4' => '4th','5' => '5th','6' => '6th','7' => '7th','8' => '8th','9' => '9th','10' => '10th','11' => '11th','12' => '12th',]" />

                        <x-select name="section" id="section" :options="['A' => 'Section A','B'=> 'Section B','C' =>
                                                'Section C', ]" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Add Student</span></x-button-primary>
            </div>
        </form>
    </template>

    <main class="bg-white rounded-xl border border-slate-200 ">
        <!-- Page Details & Filters -->
        <div class="flex flex-col lg:flex-row gap-8 py-8 px-8 items-center justify-between">
            <div class="flex flex-col gap-1">
                <x-bread-crumb>
                    <a href="{{url("/students")}}">Student Fee</a>
                </x-bread-crumb>
                <x-heading>{{ request('search') ? 'Search Result for: ' . request('search') : 'All Students' }}
                </x-heading>
            </div>

            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="#add-student">
                    <x-button-primary icon="square-rounded-plus">Add Student
                    </x-button-primary>
                </a>
                <x-button-filter url="students.index">
                    {{-- Filter By Class & Section --}}
                    <x-filter-row lable="Class & Section">
                        <x-select name="class" id="class"
                            :options="['' => 'Select Class','Nurssery' => 'Nurssery','LKG' => 'LKG','UKG' => 'UKG', '1st' => '1st','2nd' => '2nd','3rd' => '3rd','4th' => '4th','5th' => '5th','6th' => '6th','7th' => '7th','8th' => '8th','9th' => '9th','10th' => '10th','11th' => '11th','12th' => '12th',]" />

                        <x-select name="section" id="section"
                            :options="['' => 'Select Section','A' => 'Section A','B'=> 'Section B','C' => 'Section C', ]" />
                    </x-filter-row>

                    {{-- Sort By --}}
                    <x-filter-row lable="Sort By">
                        <x-select name="fees_settle" id="sort"
                            :options="['' => 'All Students', 'true' => 'Fee Settled', 'false' => 'Fee Due']" />
                    </x-filter-row>
                </x-button-filter>
                <x-search-box :url="route('students.index')" placeholder="Search by Name.." />


            </div>
        </div>

        <!-- Table -->
        <div class=" grid overflow-auto whitespace-nowrap">
            <!-- Table Heading -->
            <x-table-heading grid='student-grid'>
                <p>#ID</p>
                <p>Details</p>
                <p>Phone</p>
                <p>Status</p>
                <p>Date</p>
                <p>&nbsp;</p>
            </x-table-heading>

            <!-- Table Rows Start -->
            @forelse ($students as $student)
            <x-student-row :student="$student" />
            @empty
            <x-no-content>Student</x-no-content>
            @endforelse
            <!-- Table Row End -->
        </div>
    </main>

    {{-- Pagination --}}
    {{ $students->links() }}
</x-layout>