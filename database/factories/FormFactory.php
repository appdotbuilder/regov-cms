<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3) . ' Form',
            'slug' => fake()->slug(),
            'description' => fake()->optional(0.8)->paragraph(),
            'fields' => [
                [
                    'name' => 'full_name',
                    'label' => 'Full Name',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'email',
                    'label' => 'Email Address',
                    'type' => 'email',
                    'required' => true,
                ],
                [
                    'name' => 'phone',
                    'label' => 'Phone Number',
                    'type' => 'tel',
                    'required' => false,
                ],
                [
                    'name' => 'message',
                    'label' => 'Message',
                    'type' => 'textarea',
                    'required' => true,
                ],
            ],
            'submit_email' => fake()->optional(0.8)->email(),
            'success_message' => fake()->optional(0.7)->sentence(8),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_by' => User::factory(),
            'department_id' => fake()->optional(0.7)->randomElement([null, Department::factory()]),
            'submissions_count' => fake()->numberBetween(0, 200),
        ];
    }

    /**
     * Indicate that the form is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}