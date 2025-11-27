<div class="modal-header">
    <h5 class="modal-title">Edit Student</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

    <h3 class="page-title mb-3">Edit Student</h3>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
    <label class="form-label">Admission Number</label>
    <input type="text" name="admission_no" class="form-control" value="{{ $student->admission_no }}" required readonly>
</div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Class</label>
                <input type="text" name="class" value="{{ $student->class }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $student->email }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $student->phone }}" class="form-control" required>
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

