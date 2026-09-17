<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        return response()->json(Teacher::with(['department','courses'])->paginate(10));
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher->load(['department','courses']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'department_id' => ['required','integer','exists:departments,department_id'],
            'employment_type' => ['required',Rule::in(['full_time','part_time','visiting'])],
            'phone_number' => ['nullable','string','max:15'],
            'email' => ['nullable','email','max:100'],
            'hiring_date' => ['nullable','date'],
        ]);

        return response()->json(Teacher::create($data), 201);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => ['sometimes','required','string','max:100'],
            'department_id' => ['sometimes','required','integer','exists:departments,department_id'],
            'employment_type' => ['sometimes','required',Rule::in(['full_time','part_time','visiting'])],
            'phone_number' => ['nullable','string','max:15'],
            'email' => ['nullable','email','max:100'],
            'hiring_date' => ['nullable','date'],
        ]);

        $teacher->update($data);
        return response()->json($teacher->fresh());
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
