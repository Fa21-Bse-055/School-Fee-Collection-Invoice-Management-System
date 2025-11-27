@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="page-title mb-3">Add Student</h3>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="row">
    <div class="col-md-6 mb-3">
    <label class="form-label">Admission Number</label>
    <input type="text" name="admission_no" class="form-control" value="" placeholder="Will be auto-generated" readonly>
</div>



            <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Student name" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Class</label>
                <input type="text" name="class" class="form-control" placeholder="e.g. 10th" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" 
       placeholder="03xxxxxxxxx" 
       required pattern="[0-9]+" 
       title="Numbers only">
            </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" placeholder="18"  required>
            </div>
        </div>

        <button class="btn btn-success">Save Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
