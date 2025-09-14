<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+90 days');
        
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(3),
            'start_date' => $startDate,
            'end_date' => fake()->optional(0.7)->dateTimeBetween($startDate, '+7 days'),
            'location' => fake()->address(),
            'organizer' => fake()->company(),
            'contact_email' => fake()->email(),
            'contact_phone' => fake()->phoneNumber(),
            'is_featured' => fake()->boolean(20),
            'status' => fake()->randomElement(['scheduled', 'ongoing', 'completed', 'cancelled']),
            'created_by' => User::factory(),
            'department_id' => fake()->optional(0.8)->randomElement([null, Department::factory()]),
        ];
    }

    /**
     * Indicate that the event is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'status' => 'scheduled',
        ]);
    }

    /**
     * Indicate that the event is upcoming.
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => fake()->dateTimeBetween('+1 day', '+60 days'),
            'status' => 'scheduled',
        ]);
    }
}