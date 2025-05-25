<?php

namespace App\Http\Controllers;

use App\Mail\FeeSubmitted;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        // Get filters from request
        $search = $request->input('search');
        $feeFilter = $request->input('fees_settle');  // Expected: 'complete', 'due', or null
        $classFilter = $request->input('class');      // Optional class filter
        $sectionFilter = $request->input('section');  // Optional section filter

        // Build the query
        $students = Student::with('user')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($search).'%'])
                        ->orWhereRaw('LOWER(email) LIKE ?', ['%'.strtolower($search).'%']);
                });
            })
            ->when($feeFilter, function ($query) use ($feeFilter) {
                $query->where('fees_settle', $feeFilter);
            })
            ->when($classFilter, function ($query) use ($classFilter) {
                $query->where('class', $classFilter);
            })
            ->when($sectionFilter, function ($query) use ($sectionFilter) {
                $query->where('section', $sectionFilter);
            })
            ->paginate(10)
            ->appends(request()->query()); // Preserve filters in pagination links


        $title = 'Students | Parishkar School Sds | Accounting
            Management System';

        return view("students.index", compact('students', 'search', 'title'));

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
            'total_fees' => 'required|integer',
            'class' => 'required|string',
            'section' => 'required|string',
            'created_at' => 'required',
        ]);

        // Set default password 
        $validatedData['password'] = Hash::make('password');

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password'],
        ]);

        // Create student record linked to user
        $user->student()->create([
            'user_id' => $user->id,
            'class' => $validatedData['class'],
            'section' => $validatedData['section'],
            'total_fees' => $validatedData['total_fees'],
            'created_at' => $validatedData['created_at'],
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get Student Detail & Transctions
        $student = Student::with(['user'])->findOrFail($id);
        $transactions = Transaction::where('user_id', $student->user->id)->get();

        return view('students.show')->with(['student' => $student, 'transactions' => $transactions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::with('user')->findOrFail($id); // get student + user

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email,'.$student->user->id,
            'phone' => 'required|integer',
            'total_fees' => 'required|integer',
            'class' => 'required|string',
            'section' => 'required|string',
            'created_at' => 'required|date',
        ]);

        // Update user
        $student->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Update student
        $student->update([
            'class' => $validatedData['class'],
            'section' => $validatedData['section'],
            'total_fees' => $validatedData['total_fees'],
            'created_at' => $validatedData['created_at'],
        ]);

        return redirect()->route('students.show', $student->id)->with('success', 'Student updated successfully.');
    }

    /**
     * Add Fee Transaction.
     */
    public function depositFee(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'transaction_amount' => 'required|numeric|min:1',
            'transaction_method' => 'required|string',
            'expense_id' => 'nullable',
        ]);
        // 1. Get student
        $student = Student::findOrFail($id);

        // 2.  get user id accociated with student
        $userId = $student->user_id;

        if ($student->fees_due <= 0) {
            return redirect("/students/$student->id#deposit-fee")->withErrors(['transaction_amount' => 'No remaining fee to be paid.'])
                ->withInput();
        }

        if ($validatedData['transaction_amount'] > $student->fees_due) {
            return redirect("/students/$student->id#deposit-fee")->withErrors(['transaction_amount' => 'Amount exceeds remaining fee (₹'.$student->fees_due.').'])
                ->withInput();
        }

        // 3. Create transaction
        Transaction::create([
            'user_id' => $userId,
            'transaction_amount' => $validatedData['transaction_amount'],
            'transaction_method' => $validatedData['transaction_method'],

            // when we submit fee we set transaction as deposit transaction
            'transaction_type' => 'deposit',

            // Used only to get school expense transctions not students and employees transctions
            'expense_id' => null,
        ]);


        // 3. Update remaining fee
        $student->fees_due -= $validatedData['transaction_amount'];
        if ($student->fees_due <= 0) {
            $student->fees_due = 0; // ensure it doesn't go negative
            $student->fees_settle = true;   // or true/1/etc.
        }
        $student->save();

        // Send Email to user
        $user = User::findOrFail($student->user_id);
        $data = [
            'name' => $user->name,
            'amount' => $validatedData['transaction_amount'],
            'class' => "$student->class - Section $student->section",
            'fees_due' => $student->fees_due,
        ];
        Mail::to($user->email)->send(new FeeSubmitted($data));

        // redirect to studnet page
        return redirect()->route('students.show', $student->id)->with('success', 'Fees Deposit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // Delete the resource
        $user = User::find($student->user_id);
        $user->delete();

        // redirect to all expenses page
        return redirect()->route('students.index')->with('success', 'Student Deleted successfully.');
    }

    /**
     * Show Login Student Profile 
     */
    public function showMe()
    {
        // get user from session
        $user = Auth::user(); // logged-in user

        // Get student & transactions record that matches user_id
        $student = Student::with('user')->where('user_id', $user->id)->first();
        $transactions = Transaction::where('user_id', $student->user->id)->get();


        return view('students.me')->with(['student' => $student, 'transactions' => $transactions]);
    }
}
