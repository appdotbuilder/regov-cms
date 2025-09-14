<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3) . ' Service',
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(3),
            'requirements' => fake()->paragraphs(2, true),
            'process_steps' => fake()->paragraphs(3, true),
            'fee' => fake()->optional(0.6)->randomFloat(2, 10, 500),
            'processing_time' => fake()->randomElement(['1-2 business days', '3-5 business days', '1-2 weeks', '2-4 weeks']),
            'contact_person' => fake()->name(),
            'contact_email' => fake()->email(),
            'contact_phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']),
            'department_id' => Department::factory(),
        ];
    }

    /**
     * Indicate that the service is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}