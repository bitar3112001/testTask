<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'revenue_id' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);

        Payment::create([
            'revenue_id' => $request->revenue_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'date' => $request->date,
        ]);

        return redirect()->route('payments.create')->with('success', 'Payment created successfully.');
    }
}
