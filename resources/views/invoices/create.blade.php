@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="page-title mb-3">Create Invoice</h3>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <!-- Select Student -->
        <div class="mb-3">
            <label class="form-label">Select Student</label>
            <select name="student_id" id="student" class="form-select" required>
                <option value="">Choose student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->class }})</option>
                @endforeach
            </select>
        </div>

        <!-- Fee Types -->
        <div class="mb-3">
            <label class="form-label">Select Fee Types</label>
            <div id="fee-list" class="border rounded p-3" style="background:#fbfbfb">
                <!-- Fee checkboxes will appear here -->
            </div>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" id="status" name="status" class="form-control" readonly>
        </div>

        <!-- Buttons -->
        <button class="btn btn-success">Generate Invoice</button>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // Update Status based on due date
    function updateStatus() {
        var dateStr = $('#due_date').val(); // yyyy-mm-dd

        if (!dateStr) {
            $('#status').val('');
            return;
        }

        var parts = dateStr.split('-'); // ["yyyy","mm","dd"]
        if(parts.length !== 3) {
            $('#status').val('');
            return;
        }

        var year = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10) - 1; // JS month is 0-based
        var day = parseInt(parts[2], 10);

        var dueDate = new Date(year, month, day);
        dueDate.setHours(0,0,0,0);

        var today = new Date();
        today.setHours(0,0,0,0);

        if(dueDate > today) {
            $('#status').val('Pending');
        } else if(dueDate < today) {
            $('#status').val('Partial');
        } else {
            $('#status').val('Paid');
        }
    }

    // Trigger status update on input/change
    $('#due_date').on('input change', updateStatus);

    // Initialize status on page load
    updateStatus();

    // Load fees when student is selected
    $('#student').change(function() {
        var studentId = $(this).val();

        if(studentId) {
            $.get('/students/' + studentId + '/fees', function(data) {
                var html = '';
                data.forEach(function(fee) {
                    html += `<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fee_types[]" value="${fee.id}">
                                <label class="form-check-label">${fee.name} — $${parseFloat(fee.amount).toFixed(2)}</label>
                            </div>`;
                });
                $('#fee-list').html(html);
            });
        } else {
            $('#fee-list').html('');
        }
    });

});
</script>
@endsection
