@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="page-title">Invoices</h3>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">+ Create Invoice</a>
    </div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Invoice No</th>
                <th>Student</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Due Date</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->invoice_no }}</td>
                <td>{{ $invoice->student->name }}</td>
                <td>${{ number_format($invoice->total_amount, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : ($invoice->status=='Partial'?'warning':'danger') }}">
                        {{ $invoice->status }}
                    </span>
                </td>
                <td>{{ $invoice->due_date }}</td>

                <td>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete invoice?')">Delete</button>
                    </form>
                    <form action="{{ route('payments.create', $invoice->id) }}" method="GET" class="d-inline">
                        @csrf @method('GET')
                        <button class="btn btn-light btn-sm">Update Payment</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
