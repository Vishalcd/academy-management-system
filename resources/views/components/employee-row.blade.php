@props(['employee'])

<x-table-row grid='employee-grid'>
    <x-number-container>#{{$employee->id}}</x-number-container>

    <x-user img="{{$employee->user->photo}}" alt_text="{{$employee->user->name}}"
        description_text="{{$employee->job_title}}">
        {{$employee->user->name}}
    </x-user>
    <x-make-call>{{$employee->user->phone}}</x-make-call>
    <x-pill :settle="$employee->salary_settled">{{$employee->salary_settled ? 'Settled' : 'Not-Settled'}}</x-pill>
    <x-number-container>{{$employee->last_paid}}
    </x-number-container>
    <x-button-link url="{{route('employees.show', $employee->id)}}" />
</x-table-row>