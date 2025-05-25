<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Console\Command;

class CheckEmployeeSalaryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if salary is paid to each employee for the current month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $year = $now->year;
        $month = $now->month;

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $hasSalary = Transaction::where('user_id', $employee->user_id)
                ->where('transaction_for', 'employee_salary')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->exists();

            $employee->salary_settled = $hasSalary;
            $employee->save();
        }

        $this->info('Salary status checked for all employees.');
    }
}
