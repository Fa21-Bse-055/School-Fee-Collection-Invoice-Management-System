<div class="modal-header">
    <h5 class="modal-title">Student Details</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

    <h3 class="page-title mb-3">Student Details</h3>

    <div class="row">
        <div class="col-md-6 mb-3">
            <h5><strong>Admission Number:</strong></h5>
            <p>{{ $student->admission_no }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <h5><strong>Name:</strong></h5>
            <p>{{ $student->name }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <h5><strong>Class:</strong></h5>
            <p>{{ $student->class }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <h5><strong>Email:</strong></h5>
            <p>{{ $student->email }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <h5><strong>Phone:</strong></h5>
            <p>{{ $student->phone }}</p>
        </div>

         <div class="col-md-6 mb-3">
            <h5><strong>Age:</strong></h5>
            <p>{{ $student->age }}</p>
        </div>

        <div class="col-md-12 mt-4">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning ms-2">Edit Student</a>
        </div>
    </div>
</div>

