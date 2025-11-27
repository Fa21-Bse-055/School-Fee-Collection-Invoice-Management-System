<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Student;
use App\Models\FeeType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
{
    $invoices = Invoice::with('student')->get();

    return view('invoices.index', compact('invoices'));
}


    public function create()
    {
        $students = Student::all(); 
        $feeTypes = FeeType::all();

        return view('invoices.create', compact('students', 'feeTypes'));
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'student_id' => 'required',
            'due_date' => 'required|date',
            'fee_types' => 'required|array',
        ]);

        // Generate invoice number
        $invoiceNo = 'INV-' . time();

        // Calculate total
        $total = 0;
        foreach ($request->fee_types as $ft) {
            $total += FeeType::find($ft)->amount;
        }

$dueDate = Carbon::parse($request->due_date);
$today = Carbon::today();

if ($dueDate->gt($today)) {
    $status = 'Pending';   // Future
} elseif ($dueDate->lt($today)) {
    $status = 'Partial';   // Past
} else {
    $status = 'Paid';      // Today
}

// Create invoice
$invoice = Invoice::create([
    'student_id' => $request->student_id,
    'invoice_number' => $invoiceNo,
    'due_date' => $request->due_date,
    'total_amount' => $total,
    'status' => $status,
]);

        // Add invoice items
        foreach ($request->fee_types as $ft) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'fee_type_id' => $ft,
                'amount' => FeeType::find($ft)->amount,
            ]);
        }

        return redirect()->back()->with('success', 'Invoice generated!');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Delete related invoice items
        InvoiceItem::where('invoice_id', $invoice->id)->delete();

        // Delete invoice
        $invoice->delete();

        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice deleted successfully.');
    }

    public function show($id)
{
    $invoice = Invoice::with('student', 'items.feeType', 'payments')->findOrFail($id);

    return view('invoices.show', compact('invoice'));
}

public function getClassFees(Student $student)
{
    // Get fees only for this student's class
    $fees = FeeType::where('class', $student->class)->get();
    
    // Return as JSON for AJAX
    return response()->json($fees);
}


}
