@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="page-title">Students</h3>
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
    </div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Age</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->age }}</td>

                <td>
<button onclick="openView({{ $student->id }})" class="btn btn-sm">
    <img src="{{ asset('view.png') }}" width="20">
</button>

<button class="btn btn-sm" onclick="openEdit({{ $student->id }})">
    <img src="{{ asset('edit.png') }}" width="20">
</button>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm" onclick="return confirm('Delete student?')">
                            <img src="{{ asset('delete.png') }}" width="20">
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" id="viewModalContent">
          <!-- Data will load here -->
      </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" id="editModalContent">
          <!-- Data will load here -->
      </div>
  </div>
</div>


</div>
<script>
function openView(id) {
    $.get("/students/view/" + id, function(data) {
        $("#viewModalContent").html(data);
        $("#viewModal").modal("show");
    });
}

function openEdit(id) {
    $.get("/students/" + id + "/edit", function(data) {
        $("#editModalContent").html(data);
        $("#editModal").modal("show");
    });
}
</script>


@endsection
