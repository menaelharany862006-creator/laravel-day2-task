<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    public $timestamps = false;

    protected $fillable = [
        'course_name', 'course_code', 'course_fee', 'semester', 'credits', 'created_at',
    ];

    protected $casts = [
        'course_fee' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'student_course',
            'course_id',
            'student_id',
            'course_id',
            'student_id'
        )->withPivot(['enrollment_id', 'enrollment_date', 'grade', 'completion_status']);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            Teacher::class,
            'course_teacher',
            'course_id',
            'teacher_id',
            'course_id',
            'teacher_id'
        )->withPivot(['assignment_id', 'academic_year', 'semester', 'assignment_date']);
    }

    public function teacherAssignments()
    {
        return $this->hasMany(CourseTeacher::class, 'course_id', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentCourse::class, 'course_id', 'course_id');
    }
}
