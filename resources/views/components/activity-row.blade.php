@props(['transaction'])


<div class="flex items-center gap-4 justify-between px-3 md:px-6 border-b py-4 border-slate-200">
    <div class="px-4 leading-5 flex items-center justify-center w-30 text-nowrap  rounded-full text-xs text-center font-medium
    @if ($transaction->transaction_for === 'student_fee')
        bg-green-700 text-green-100
    @endif  
    @if ($transaction->transaction_for === 'employee_salary')
    bg-yellow-700 text-white
    @endif 

    @if ($transaction->transaction_for === 'school_expense')
    bg-red-700 text-red-100
    @endif
    ">
        {{ucwords(str_replace('_', ' ', $transaction->transaction_for))}}
    </div>

    <x-number-container>{{formatCurrency($transaction->transaction_amount)}}</x-number-container>
    <p class=" text-green-700 font-medium w-10 text-sm ">{{ucfirst($transaction->transaction_method)}}</p>
    <x-number-container>{{$transaction->created_at->format('d M, Y')}}</x-number-container>
</div>