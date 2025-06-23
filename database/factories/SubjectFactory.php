<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $credits = fake()->numberBetween(2, 4);
        return [
            'name' => fake()->randomElement([
                'Phân tích dữ liệu',
                'Mạng máy tính',
                'Web nâng cao',
                'C nâng cao',
                'Lập trình hướng đối tượng',
                'Cấu trúc dữ liệu và giải thuật',
                'Cơ sở dữ liệu',
                'Xác suất thống kê',
                'Khoa học trí tuệ nhân tạo',
            ]),
            'code' => fake()->unique()->regexify('[A-Z0-9]{3}'),
            'semester' => fake()->numberBetween(1, 4),
            'credits' => $credits,
            'number_of_lessons' => $credits * 15,
        ];
    }
}
