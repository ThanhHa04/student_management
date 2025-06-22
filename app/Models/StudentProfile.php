<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'dob',
        'student_id',
        'class_id',
    ];

    public function class() {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'profile_id');
    }
    public function subjects() {
    
      return $this->belongsToMany(Subject::class, 'student_subject');
    }
    public function studentSubjects() {
      return $this->hasMany(StudentSubject::class, 'student_id');
   }
    public $table = "student_profiles";
}
