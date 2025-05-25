<?php

namespace App\Http\Controllers;

use App\Mail\SalarySettled;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        //get search input & filter
        $search = $request->input('search');
        $salarySettled = $request->input('salary_settled');
        $jobTitle = $request->input('job_title');


        // Get All Employee
        $employees = Employee::with('user')->when($search, function ($query) use ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search).'%']);
            });
        })->when($salarySettled, function ($query) use ($salarySettled) {
            $query->where('salary_settled', $salarySettled);
        })->when($jobTitle, function ($query) use ($jobTitle) {
            $query->where('job_title', $jobTitle);
        })->paginate(10)->appends(request()->query()); // Preserve filters in pagination links

        // Render Employees page
        return view("employees.index", compact('employees', 'search'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|integer',
            'salary' => 'required|integer',
            'job_title' => 'required|string',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif,webp:max:10240',
        ]);

        // check for image
        if ($request->hasFile('photo')) {
            // store the file and get
            $path = $request->file("photo")->store('employees', 'public');

            // Add path to validated data
            $validatedData['photo'] = $path;
        }


        // Set default password 
        $validatedData['password'] = Hash::make('password');

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'photo' => $validatedData['photo'],
            'password' => $validatedData['password'],
            'role' => 'employee',
        ]);

        // Create employee record linked to user
        $user->employee()->create([
            'user_id' => $user->id,
            'salary' => $validatedData['salary'],
            'job_title' => $validatedData['job_title'],
            'last_paid' => null,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get Employee Detail
        $employee = Employee::with('user')->find($id);
        $transactions = Transaction::where('user_id', $employee->user->id)->get();


        return view('employees.show')->with(['employee' => $employee, 'transactions' => $transactions]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::with('user')->findOrFail($id); // get employee + user

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email,'.$employee->user->id,
            'phone' => 'required|integer',
            'salary' => 'required|integer',
            'job_title' => 'required|string',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp:max:10240',
        ]);

        // check for image
        if ($request->hasFile('photo')) {
            // store the file and get
            $path = $request->file("photo")->store('employees', 'public');

            // Add path to validated data
            // Update user with photo
            $validatedData['photo'] = $path;
            $employee->user->update([
                'photo' => $validatedData['photo'],
            ]);
        }

        // Update user
        $employee->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);


        // Update employee
        $employee->update([
            'salary' => $validatedData['salary'],
            'job_title' => $validatedData['job_title'],
        ]);

        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee updated successfully.');
    }

    /**
     * Add Salary Transaction.
     */
    public function depositSalary(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'transaction_amount' => 'required|numeric|min:1',
            'transaction_method' => 'required|string',
            'expense_id' => 'nullable',
        ]);
        // 1. Get Employee
        $employee = Employee::findOrFail($id);

        // 2.  get user id accociated with student
        $userId = $employee->user_id;

        if ($validatedData['transaction_amount'] > $employee->salary || $validatedData['transaction_amount'] < $employee->salary) {
            return redirect("/employees/$employee->id#deposit-salary")->withErrors(['transaction_amount' => 'Salary is not matching  (₹'.$employee->salary.').'])
                ->withInput();
        }

        // 3. Create transaction
        Transaction::create([
            'user_id' => $userId,
            'transaction_amount' => $validatedData['transaction_amount'],
            'transaction_method' => $validatedData['transaction_method'],
            'transaction_for' => 'employee_salary',

            // when we submit fee we set transaction as deposit transaction
            'transaction_type' => 'withdrawal',

            // Used only to get school expense transctions not students and employees transctions
            'expense_id' => null,
        ]);

        //  4. Update Employee Salary Status
        $employee->update(['salary_settled' => true, 'last_paid' => now()]);

        // 5. Send Email to user
        $user = User::findOrFail($employee->user_id);
        $data = [
            'name' => $user->name,
            'amount' => $validatedData['transaction_amount'],
            'month' => date('M'),
            'last_paid' => $employee->last_paid
        ];
        Mail::to($user->email)->send(new SalarySettled($data));


        // redirect to employee page
        return redirect()->route('employees.show', $employee->id)->with('success', 'Salary Settled successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        // Delete the resource
        $user = User::find($employee->user_id);
        $user->delete();

        // redirect to all expenses page
        return redirect()->route('employees.index')->with('success', 'Employee Deleted successfully.');
    }


    /**
     * Show Login Employee Profile 
     */
    public function showMe()
    {
        // get user from session
        $user = Auth::user(); // logged-in user

        // Get employee & transactions record that matches user_id
        $employee = Employee::with('user')->where('user_id', $user->id)->first();
        $transactions = Transaction::where('user_id', $employee->user->id)->get();


        return view('employees.me')->with(['employee' => $employee, 'transactions' => $transactions]);
    }
}
