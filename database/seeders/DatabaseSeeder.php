<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Score;
use App\Models\StudentSubject;
use App\Models\TeacherSubject;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\TeacherCertificate;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Classroom::factory()->count(3)->create();

        User::factory()->count(15)->create([
            'role' => 'student'
        ]);

        User::factory()->count(5)->create([
            'role' => 'teacher'
        ]);

        // Các bảng khác
        Subject::factory()->count(5)->create();
        Score::factory()->count(20)->create();
        StudentSubject::factory()->count(30)->create();
        TeacherSubject::factory()->count(15)->create();
    }
}
