<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTeacher extends Model
{
    protected $table = 'course_teacher';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    protected $fillable = [
        'course_id', 'teacher_id', 'academic_year', 'semester', 'assignment_date',
    ];

    protected $casts = ['assignment_date' => 'datetime'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}
