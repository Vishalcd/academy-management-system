<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // Get year from query or default to current year
        $year = $request->get('year');
        $year = empty($year) ? now()->year : (int) $year;

        // Totals
        $totalFees = Transaction::where('transaction_for', 'student_fee')
            ->whereYear('created_at', $year)
            ->sum('transaction_amount');

        $totalSalary = Transaction::where('transaction_for', 'employee_salary')
            ->whereYear('created_at', $year)
            ->sum('transaction_amount');

        $totalExpense = Transaction::where('transaction_for', 'school_expense')
            ->whereYear('created_at', $year)
            ->sum('transaction_amount');

        $revenue = $totalFees - ($totalSalary + $totalExpense);

        // Last 8 Transactions
        $latestTransactions = Transaction::whereYear('created_at', $year)
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        // Doughnut Chart Data
        $doughnutData = [
            'Fee Deposit' => $totalFees,
            'Salary' => $totalSalary,
            'Expense' => $totalExpense,
        ];


        // Graph Data by Month for All Types
        $types = [
            'student_fee' => 'student_fee',
            'salary' => 'employee_salary',
            'expense' => 'school_expense',
        ];

        $graphData = [];

        foreach ($types as $key => $type) {
            $monthly = array_fill(1, 12, 0); // Jan to Dec default 0

            $results = Transaction::selectRaw('EXTRACT(MONTH FROM created_at) AS month, SUM(transaction_amount) AS total')
                ->where('transaction_for', $type)
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
                ->pluck('total', 'month');

            foreach ($results as $month => $total) {
                $monthly[(int) $month] = (float) $total;
            }

            $graphData[$key] = array_values($monthly); // 0-indexed array
        }

        return view('pages.index', [
            'title' => 'Overview | Parishkar School Sds | Accounting
            Management System',
            'totalFees' => $totalFees,
            'totalSalary' => $totalSalary,
            'totalExpense' => $totalExpense,
            'revenue' => $revenue,
            'latestTransactions' => $latestTransactions,
            'doughnutData' => $doughnutData,
            'graphData' => $graphData,
            'selectedYear' => $year,
        ]);

    }
}
