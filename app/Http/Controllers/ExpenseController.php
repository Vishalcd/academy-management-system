<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search and sort inputs
        $search = $request->get('search');
        $sort = $request->get('sort');

        // Build base query
        $query = Expense::query();

        // Apply search filter (modify columns as per your table structure)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ILIKE', "%$search%")
                    ->orWhere('description', 'ILIKE', "%$search%")
                    ->orWhere('category', 'ILIKE', "%$search%");
            });
        }

        // Apply sorting
        if ($sort === 'low_to_high') {
            $query->orderBy('total_price', 'asc');
        } elseif ($sort === 'high_to_low') {
            $query->orderBy('total_price', 'desc');
        } else {
            $query->latest(); // Default sort
        }

        // Get paginated results with filters in pagination links
        $expenses = $query->paginate(10)->appends($request->query());

        // Return view
        return view("expenses.index", compact('expenses', 'search', 'sort'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|integer',
            'total_price' => 'required|integer',
            'quantity' => 'required|integer',
            'shop_details' => 'required|string',
            'payment_type' => 'required',
            'payment_settled' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif,webp:max:10240',
        ]);

        // check for image
        if ($request->hasFile('photo')) {
            // store the file and get
            $path = $request->file("photo")->store('recipts', 'public');

            // Add path to validated data
            $validatedData['photo'] = $path;
        }

        // Submit to database
        $expense = Expense::create($validatedData);

        // Store Transaction
        Transaction::create([
            'expense_id' => $expense->id,
            'transaction_amount' => $validatedData['total_price'],
            'transaction_method' => $validatedData['payment_type'],
            'transaction_type' => 'withdrawal',
            'transaction_for' => 'school_expense',

            // Used only to get students and employees transctions not school expense transctions
            'user_id' => null,
        ]);

        // redirect to all expense page
        return redirect()->route('expenses.index')->with('success', 'Expense Added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        // Render Expense page
        return view("expenses.show")->with('expense', $expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        // validate data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|integer',
            'total_price' => 'required|integer',
            'quantity' => 'required|integer',
            'shop_details' => 'required|string',
            'payment_type' => 'required',
            'payment_settled' => 'required',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp:max:10240',
        ]);

        // check for image
        if ($request->hasFile('photo')) {
            // delete old photo
            Storage::delete('public/recipts/'.basename($expense->photo));

            // store the file and get
            $path = $request->file("photo")->store('recipts', 'public');

            // Add path to validated data
            $validatedData['photo'] = $path;
        }

        // Submit to database
        $expense->update($validatedData);

        // redirect to expense page
        return redirect()->route('expenses.show', $expense->id)->with('success', 'Expense Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        // delete image before deleting resource
        Storage::delete('public/storage/recipts/'.$expense->photo);

        // Delete the resource
        $expense->delete();

        // redirect to all expenses page
        return redirect()->route('expenses.index')->with('success', 'Expense Deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function downloadRecipt(string $id)
    {

    }
}
