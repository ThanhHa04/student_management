<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',           
    'teacher_id',   
    'phone_number',                 
    'password',      
    ];

    public function user() {
        return $this->hasOne(User::class, 'profile_id');
    }

    public $table = "teacher_profiles";
}
