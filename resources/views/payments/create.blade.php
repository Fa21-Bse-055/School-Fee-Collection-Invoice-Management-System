@extends('layouts.app')

@section('content')
@if($invoice->status == 'Paid')
    <div class="alert alert-success">Invoice fully paid. No further payments allowed.</div>
@else
    <form method="POST" action="{{ route('payments.store', $invoice->id) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">
                Amount (Remaining: ${{ number_format($invoice->total_amount - $invoice->payments->sum('amount'), 2) }})
            </label>
            <input type="number" step="0.01" name="amount" 
                   max="{{ $invoice->total_amount - $invoice->payments->sum('amount') }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="method" class="form-select" required>
                <option value="">Select Method</option>
                <option value="Cash">Cash</option>
                <option value="Bank">Bank</option>
                <option value="Online">Online</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Note (Optional)</label>
            <textarea name="note" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save Payment</button>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endif
@endsection
