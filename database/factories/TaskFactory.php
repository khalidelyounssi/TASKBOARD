<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4), // عنوان فيه 4 كلمات
            'description' => fake()->paragraph(2), // وصف فيه 2 فقرات
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'status' => fake()->randomElement(['Todo', 'In Progress', 'Done']),
            // تواريخ بين شهر فات وشهر جاي (باش يبان ليك Overdue)
            'deadline' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'user_id' => 1, // مبدئياً غانعطيوهم لليوزر رقم 1
        ];
    }
}