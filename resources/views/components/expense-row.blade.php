@props(['expense'])

<x-table-row grid='expense-grid'>
    <x-number-container>#{{$expense->id}}</x-number-container>
    <div class="flex flex-col gap-1 w-min">
        <p class="text-base font-bold tracking-tight leading-none text-slate-800">
            {{Str::limit($expense->title, 30)}}
        </p>
        <span
            class="truncate w-1/4 text-ellipsis leading-none font-semibold text-sm text-slate-600">{{Str::limit($expense->description,
            80)}}
        </span>
    </div>
    <x-number-container>{{formatCurrency($expense->unit_price)}}</x-number-container>
    <x-number-container>{{$expense->quantity}} Pc.</x-number-container>
    <x-number-container>{{formatCurrency($expense->total_price)}}</x-number-container>
    <x-number-container>{{$expense->created_at->format('d M, Y')}}</x-number-container>
    <x-button-link url="{{route('expenses.show', $expense->id)}}" />
</x-table-row>