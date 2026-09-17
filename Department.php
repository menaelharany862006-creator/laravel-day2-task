<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'department_id';
    public $timestamps = false;

    protected $fillable = ['department_name', 'chairman_id', 'created_at'];

    protected $casts = ['created_at' => 'datetime'];

    public function chairman()
    {
        return $this->belongsTo(Teacher::class, 'chairman_id', 'teacher_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'department_id', 'department_id');
    }
}
