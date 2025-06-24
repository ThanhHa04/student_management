<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    use HasFactory;

    protected $table = 'classroom_student';

    protected $fillable = [
        'student_profile_id',
        'classroom_id',
    ];
    protected $primaryKey = 'id';
    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id', 'student_profile_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
