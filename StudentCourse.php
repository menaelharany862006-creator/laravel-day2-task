<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'student_course';
    protected $primaryKey = 'enrollment_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id', 'course_id', 'enrollment_date', 'grade', 'completion_status',
    ];

    protected $casts = ['enrollment_date' => 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}
