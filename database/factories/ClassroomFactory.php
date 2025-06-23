<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement([
                'Phân tích dữ liệu (N01)',
                'Mạng máy tính (N01)',
                'Web nâng cao (N01)',
                'C nâng cao (N01)',
                'Lập trình hướng đối tượng (N01)',
                'Cấu trúc dữ liệu và giải thuật (N01)',
                'Cơ sở dữ liệu (N01)',
                'Xác suất thống kê (N01)',
                'Khoa học trí tuệ nhân tạo (N01)',
            ]),
        ];
    }
}
