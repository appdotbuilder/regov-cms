<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(2, true),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => fake()->randomElement(['draft', 'published', 'expired']),
            'published_at' => fake()->optional(0.7)->dateTimeBetween('-7 days', 'now'),
            'expires_at' => fake()->optional(0.5)->dateTimeBetween('now', '+30 days'),
            'author_id' => User::factory(),
            'department_id' => fake()->optional(0.7)->randomElement([null, Department::factory()]),
        ];
    }

    /**
     * Indicate that the announcement is urgent.
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'urgent',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}