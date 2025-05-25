@props(['student' ])

<x-table-row grid='student-grid'>
    <x-number-container>#{{$student->id}}</x-number-container>
    <x-user img="{{$student->user->photo}}" alt_text="{{$student->user->name}}"
        description_text="{{$student->user->email}}">
        {{$student->user->name}} - <span
            class=" font-mono text-slate-600">{{$student->class}}-{{$student->section}}</span>
    </x-user>
    <x-make-call>{{$student->user->phone}}</x-make-call>
    <x-pill :settle="$student->fees_settle">{{$student->fees_settle ? 'Settled' : 'Not-Settled'}}</x-pill>
    <x-number-container>{{$student->user->created_at->format('d M, Y')}}</x-number-container>
    <x-button-link url="{{route('students.show', $student->id)}}" />
</x-table-row>