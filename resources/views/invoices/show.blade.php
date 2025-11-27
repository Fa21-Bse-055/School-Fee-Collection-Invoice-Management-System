@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="page-title mb-3">Invoice #{{ $invoice->invoice_number }}</h3>
    <p><strong>Student:</strong> {{ $invoice->student->name }} ({{ $invoice->student->class }})</p>
    <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
    <p><strong>Status:</strong> {{ $invoice->status }}</p>

    <h5>Fee Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fee Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $item->feeType->name }}</td>
                <td>${{ number_format($item->amount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">Payments</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Method</th>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->payments as $payment)
            <tr>
                <td>${{ number_format($payment->amount,2) }}</td>
                <td>{{ $payment->method }}</td>
                <td>{{ $payment->note ?? '-' }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-end mt-3">Total: ${{ number_format($invoice->total_amount, 2) }}</h4>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('payments.create', $invoice->id) }}" class="btn btn-success mt-3">Add Payment</a>
</div>
@endsection
