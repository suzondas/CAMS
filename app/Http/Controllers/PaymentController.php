<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'bank_name' => 'required|string',
            'transaction_date' => 'required|date',
        ]);

        if ($request->transaction_id) {
            $transaction = Transactions::find($request->transaction_id);
        }

        $transaction->bank_name = $request->bank_name;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->transaction_status = 1;
        $transaction->save();

        return redirect()->route('moderator.index')->with('success', 'Payment updated successfully!');
    }
}
