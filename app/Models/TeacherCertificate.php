<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TeacherCertificateFactory extends Factory
{
    use HasFactory;

    public function definition(): array
    {
        $teacher = User::where('role', 'teacher')->inRandomOrder()->first();

        return [
            'teacher_id' => $teacher?->id,
            'degree_name' => fake()->randomElement(['Cử nhân', 'Thạc sĩ', 'Tiến sĩ']),
            'institution' => fake()->company() . ' University',
            'year' => fake()->numberBetween(2000, 2005),
        ];
    }
}
