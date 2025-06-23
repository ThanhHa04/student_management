<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student_id = \App\Models\StudentProfile::all()->random()->id;
        $subject_id = \App\Models\Subject::all()->random()->id;
        // $existed = \App\Models\Score::where('student_id', $student_id)
        //     ->where('subject_id', $subject_id)->count();
        // if(!empty($existed)) {
        //     return null;
        // }
        return [
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'tp1' => fake()->numberBetween(0, 1000) / 100,
            'tp2' => fake()->numberBetween(0, 1000) / 100,
            'qt' => fake()->numberBetween(0, 1000) / 100,
            'ck' => fake()->numberBetween(0, 1000) / 100,
            'tk' => fake()->numberBetween(0, 1000) / 100,
        ];
    }
}
