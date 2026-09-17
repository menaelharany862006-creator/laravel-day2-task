<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentCourseController extends Controller
{
    public function index()
    {
        return response()->json(StudentCourse::with(['student','course'])->paginate(10));
    }

    public function show(StudentCourse $studentCourse)
    {
        return response()->json($studentCourse->load(['student','course']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required','integer','exists:students,student_id'],
            'course_id' => [
                'required','integer','exists:courses,course_id',
                Rule::unique('student_course','course_id')->where(
                    fn ($query) => $query->where('student_id', $request->student_id)
                ),
            ],
            'enrollment_date' => ['nullable','date'],
            'grade' => ['nullable','string','max:2'],
            'completion_status' => ['nullable',Rule::in(['enrolled','completed','dropped'])],
        ]);

        return response()->json(StudentCourse::create($data), 201);
    }

    public function update(Request $request, StudentCourse $studentCourse)
    {
        $data = $request->validate([
            'student_id' => ['sometimes','required','integer','exists:students,student_id'],
            'course_id' => ['sometimes','required','integer','exists:courses,course_id'],
            'enrollment_date' => ['nullable','date'],
            'grade' => ['nullable','string','max:2'],
            'completion_status' => ['nullable',Rule::in(['enrolled','completed','dropped'])],
        ]);

        $studentCourse->update($data);
        return response()->json($studentCourse->fresh());
    }

    public function destroy(StudentCourse $studentCourse)
    {
        $studentCourse->delete();
        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}
