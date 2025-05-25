@props(['transaction' => null])

<x-table-row grid="transactions-grid">
    <x-number-container>{{$transaction->id}}</x-number-container>
    <x-number-container>{{formatCurrency($transaction->transaction_amount)}}</x-number-container>
    <x-pill :settle="true">{{ucfirst($transaction->transaction_method)}}</x-pill>
    <x-number-container>School Fees</x-number-container>
    <x-number-container>{{$transaction->created_at->format('d M, Y')}}</x-number-container>
    <x-number-container>{{$transaction->created_at->format('h:i A')}}</x-number-container>
</x-table-row>