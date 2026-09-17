<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        return response()->json(Department::with(['chairman','teachers'])->paginate(10));
    }

    public function show(Department $department)
    {
        return response()->json($department->load(['chairman','teachers']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'department_name' => ['required','string','max:100','unique:departments,department_name'],
            'chairman_id' => ['nullable','integer','exists:teachers,teacher_id'],
        ]);

        return response()->json(Department::create($data), 201);
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'department_name' => ['sometimes','required','string','max:100',Rule::unique('departments','department_name')->ignore($department->department_id,'department_id')],
            'chairman_id' => ['nullable','integer','exists:teachers,teacher_id'],
        ]);

        $department->update($data);
        return response()->json($department->fresh());
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(['message' => 'Department deleted successfully']);
    }
}
