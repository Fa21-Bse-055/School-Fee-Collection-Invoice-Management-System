<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // View all students
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Create form
    public function create()
    {
        return view('students.create');
    }

    // Store student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'required|regex:/^[0-9]+$/',
            'age' => 'required'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

   public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'admission_no' => 'required|unique:students,admission_no,' . $student->id,
            'name' => 'required',
            'class' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|regex:/^[0-9]+$/',
            'age' => 'required'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function view($id)
{
    $student = Student::findOrFail($id);
    return view('students.view', compact('student'));
}

}
