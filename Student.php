<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

    protected $fillable = [
        'university_id', 'name', 'phone_number', 'street', 'city',
        'zip_code', 'enrollment_date', 'status',
    ];

    protected $casts = [
        'enrollment_date' => 'datetime',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'student_course',
            'student_id',
            'course_id',
            'student_id',
            'course_id'
        )->withPivot(['enrollment_id', 'enrollment_date', 'grade', 'completion_status']);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentCourse::class, 'student_id', 'student_id');
    }
}
