<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseTeacherController extends Controller
{
    public function index()
    {
        return response()->json(CourseTeacher::with(['course','teacher'])->paginate(10));
    }

    public function show(CourseTeacher $courseTeacher)
    {
        return response()->json($courseTeacher->load(['course','teacher']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['required','integer','exists:courses,course_id'],
            'teacher_id' => ['required','integer','exists:teachers,teacher_id'],
            'academic_year' => [
                'nullable','string','max:9',
                Rule::unique('course_teacher','academic_year')->where(fn ($q) =>
                    $q->where('course_id',$request->course_id)
                      ->where('teacher_id',$request->teacher_id)
                ),
            ],
            'semester' => ['nullable','integer'],
            'assignment_date' => ['nullable','date'],
        ]);

        return response()->json(CourseTeacher::create($data), 201);
    }

    public function update(Request $request, CourseTeacher $courseTeacher)
    {
        $data = $request->validate([
            'course_id' => ['sometimes','required','integer','exists:courses,course_id'],
            'teacher_id' => ['sometimes','required','integer','exists:teachers,teacher_id'],
            'academic_year' => ['nullable','string','max:9'],
            'semester' => ['nullable','integer'],
            'assignment_date' => ['nullable','date'],
        ]);

        $courseTeacher->update($data);
        return response()->json($courseTeacher->fresh());
    }

    public function destroy(CourseTeacher $courseTeacher)
    {
        $courseTeacher->delete();
        return response()->json(['message' => 'Course-teacher assignment deleted successfully']);
    }
}
