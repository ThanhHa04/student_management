<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->belongsToMany(StudentProfile::class, 'classroom_student', 'classroom_id', 'student_profile_id ');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public $table = "classes";
}
