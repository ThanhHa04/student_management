<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
    'dob',
    'phone_number',
    'teacher_id',
    ];

    public function user() {
        return $this->hasOne(User::class, 'profile_id');
    }

    public $table = "teacher_profiles";
}
