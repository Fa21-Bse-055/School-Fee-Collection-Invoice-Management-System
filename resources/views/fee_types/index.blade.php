@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="page-title mb-3">Fee Types</h3>

    <a href="{{ route('fee_types.create') }}" class="btn btn-primary mb-3">Add New Fee Type</a>

    <table class="table table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fee_types as $fee)
            <tr>
                <td>{{ $fee->name }}</td>
                <td>${{ number_format($fee->amount, 2) }}</td>
                <td>{{ $fee->class }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
