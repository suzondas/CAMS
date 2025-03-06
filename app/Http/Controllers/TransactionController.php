<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transactions::with('user')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        return view('transactions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'transaction_date' => 'nullable|date',
            'transaction_number' => 'required|string|max:255',
            'transaction_amount' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'transaction_status' => 'required|integer|in:0,1'
        ]);

        Transactions::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
    }

    public function edit(Transactions $transaction)
    {
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transactions $transaction)
    {
        $request->validate([
            'transaction_type' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'transaction_date' => 'nullable|date',
            'transaction_number' => 'required|string|max:255',
            'transaction_amount' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'transaction_status' => 'required|integer|in:0,1'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transactions $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
