@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="page-title mb-3">{{ isset($feeType) ? 'Edit Fee Type' : 'Add Fee Type' }}</h3>

    <form action="{{ isset($feeType) ? route('fee_types.update', $feeType->id) : route('fee_types.store') }}" method="POST">
        @csrf
        @if(isset($feeType))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Fee Name</label>
            <input type="text" name="name" class="form-control" value="{{ $feeType->name ?? old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $feeType->amount ?? old('amount') }}" required>
        </div>

<div class="mb-3">
    <label class="form-label">Class</label>
    <select name="class" class="form-select" required>
        <option value="">Select Class</option>
        @foreach(['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th'] as $class)
            <option value="{{ $class }}" {{ (isset($feeType) && $feeType->class == $class) ? 'selected' : '' }}>
                {{ $class }}
            </option>
        @endforeach
    </select>
</div>


<div id="fee-list"></div>

        <button class="btn btn-success">{{ isset($feeType) ? 'Update Fee' : 'Add Fee' }}</button>
        <a href="{{ route('fee_types.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<script>
$('#student').change(function() {
    var studentId = $(this).val();
    $.get('/students/' + studentId + '/fees', function(data) {
        var html = '';
        data.forEach(function(fee) {
            html += `<div class="form-check">
                        <input class="form-check-input" type="checkbox" name="fee_types[]" value="${fee.id}">
                        <label class="form-check-label">${fee.name} — $${fee.amount}</label>
                    </div>`;
        });
        $('#fee-list').html(html);
    });
});
</script>
@endsection
