<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4), 
            'description' => fake()->paragraph(2), 
            'priority' => fake()->randomElement(['Low', 'Medium', 'High']),
            'status' => fake()->randomElement(['Todo', 'In Progress', 'Done']),
            'deadline' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'user_id' => 1, 
        ];
    }
}