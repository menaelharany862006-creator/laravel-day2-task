<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'department_id', 'employment_type', 'phone_number', 'email', 'hiring_date',
    ];

    protected $casts = ['hiring_date' => 'datetime'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'course_teacher',
            'teacher_id',
            'course_id',
            'teacher_id',
            'course_id'
        )->withPivot(['assignment_id', 'academic_year', 'semester', 'assignment_date']);
    }

    public function courseAssignments()
    {
        return $this->hasMany(CourseTeacher::class, 'teacher_id', 'teacher_id');
    }

    public function chairedDepartments()
    {
        return $this->hasMany(Department::class, 'chairman_id', 'teacher_id');
    }
}
