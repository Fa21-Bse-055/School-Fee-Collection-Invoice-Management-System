<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        return view('payments.create', compact('invoice'));
    }

public function store(Request $request, $invoice_id)
{
    $invoice = Invoice::with('payments')->findOrFail($invoice_id);

    // 1️⃣ Check if invoice is already fully paid
    if ($invoice->status === 'Paid') {
        return redirect()->back()->with('error', 'Invoice is already fully paid. No further payments allowed.');
    }

    // 2️⃣ Calculate remaining amount
    $totalPaid = $invoice->payments->sum('amount');
    $remaining = $invoice->total_amount - $totalPaid;

    // 3️⃣ Validate payment amount
    $request->validate([
        'amount' => "required|numeric|min:0.01|max:$remaining",
        'method' => 'required|in:Cash,Bank,Online',
        'note' => 'nullable|string',
    ], [
        'amount.max' => "The amount cannot exceed the remaining balance ($remaining)."
    ]);

    // 4️⃣ Record payment
    Payment::create([
        'invoice_id' => $invoice->id,
        'student_id' => $invoice->student_id,
        'amount' => $request->amount,
        'method' => $request->method,
        'note' => $request->note,
    ]);

    // 5️⃣ Update invoice status
    $totalPaid += $request->amount;
    if ($totalPaid >= $invoice->total_amount) {
        $invoice->status = 'Paid';
    } elseif ($totalPaid > 0) {
        $invoice->status = 'Partial';
    } else {
        $invoice->status = 'Pending';
    }
    $invoice->save();

    return redirect()->back()->with('success', 'Payment recorded successfully!');
}

}
