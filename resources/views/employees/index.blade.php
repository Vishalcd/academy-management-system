<x-layout>
    {{-- add employee form --}}
    <template id="add-employee">
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
            @csrf

            <div class="col-start-1 -col-end-1 mb-3">
                <x-heading>Add New employee</x-heading>
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
                <x-input-box lable="Enter Salary" name="salary" id="salary" placeholder="₹ 10,000.00" icon="moneybag" />

                <!-- Input Row -->
                <div class="flex items-center gap-2">
                    <label class="font-medium text-sm flex items-center gap-1.5 min-w-40 text-slate-600"
                        for="job_title">
                        <span class="text-lg"><i class="ti ti-briefcase"></i></span>
                        Job Title
                    </label>

                    <x-select name="job_title" id="job_title"
                        :options="['Teacher' => 'Teacher', 'Clerk' => 'Clerk', 'Security Guard' => 'Security Guard', 'Bus Driver' => 'Bus Driver', 'Receptionist' => 'Receptionist',]" />
                </div>

                <x-input-box lable="Upload Image" type="file" name="photo" id="photo" icon="photo-up" />
            </div>

            <!-- Actions -->
            <div class="col-start-1 -col-end-1 flex items-center gap-3 mt-4">
                <x-button-primary type="secondary"><span class="leading-2 font-semibold">Cancel</span>
                </x-button-primary>
                <x-button-primary><span class="leading-2 font-semibold">Add Employee</span></x-button-primary>
            </div>
        </form>
    </template>

    <main class="bg-white rounded-xl border border-slate-200">
        <!-- Page Details & Filters -->
        <div class="flex flex-col lg:flex-row gap-8 py-8 px-8 items-center justify-between">
            <div class="flex flex-col gap-1">
                <x-bread-crumb>
                    <a href="{{url("/employees")}}">Employees</a>
                </x-bread-crumb>
                <x-heading>{{ request('search') ? 'Search Result for: ' . request('search') : 'Employees Salary' }}
                </x-heading>
            </div>

            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="#add-employee">
                    <x-button-primary icon="square-rounded-plus">Add Employee
                    </x-button-primary>
                </a>
                <x-button-filter url="employees.index">
                    {{-- Filter By Job Title & Salry Status --}}
                    <x-filter-row lable="Profession & Salary">
                        <x-select name="job_title" id="job_title"
                            :options="['' => 'All Employees','Teacher' => 'Teacher', 'Clerk' => 'Clerk', 'Security Guard'=> 'Security Guard', 'Bus Driver'=> 'Bus Driver', 'Receptionist'=> 'Receptionist']" />

                        <x-select name="salary_settled" id="salary_settled"
                            :options="[''=> 'Salary','false'=> 'Salary Due', 'true'=> 'Salary Settled']" />
                    </x-filter-row>

                </x-button-filter>
                <x-search-box :url="route('employees.index')" placeholder="Search by Name.." />
            </div>
        </div>

        <!-- Table -->
        <div class="grid overflow-auto whitespace-nowrap">
            <!-- Table Heading -->
            <x-table-heading grid="employee-grid">
                <p>#ID</p>
                <p>Details</p>
                <p>Phone</p>
                <p>Salary Status</p>
                <p>Last Paid Time & Date</p>
                <p>&nbsp;</p>
            </x-table-heading>

            <!-- Table Rows Start -->
            @forelse ($employees as $employee)
            <x-employee-row :employee="$employee" />
            @empty
            <x-no-content>Employee</x-no-content>
            @endforelse
            <!-- Table Row End -->
        </div>
    </main>

    {{-- Pagination --}}
    {{ $employees->links() }}
</x-layout>