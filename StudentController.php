<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::with('courses')->paginate(10));
    }

    public function show(Student $student)
    {
        return response()->json($student->load('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'university_id' => ['required','string','max:20','unique:students,university_id'],
            'name' => ['required','string','max:100'],
            'phone_number' => ['nullable','string','max:15'],
            'street' => ['nullable','string','max:100'],
            'city' => ['nullable','string','max:50'],
            'zip_code' => ['nullable','string','max:10'],
            'enrollment_date' => ['nullable','date'],
            'status' => ['nullable', Rule::in(['active','inactive','graduated'])],
        ]);

        $student = Student::create($data);
        return response()->json($student, 201);
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'university_id' => ['sometimes','required','string','max:20',Rule::unique('students','university_id')->ignore($student->student_id,'student_id')],
            'name' => ['sometimes','required','string','max:100'],
            'phone_number' => ['nullable','string','max:15'],
            'street' => ['nullable','string','max:100'],
            'city' => ['nullable','string','max:50'],
            'zip_code' => ['nullable','string','max:10'],
            'enrollment_date' => ['nullable','date'],
            'status' => ['nullable', Rule::in(['active','inactive','graduated'])],
        ]);

        $student->update($data);
        return response()->json($student->fresh());
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
