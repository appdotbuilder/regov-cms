<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
        ];
    }

    /**
     * Indicate that the role is Main Admin.
     */
    public function mainAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Main Admin',
            'slug' => 'main-admin',
            'description' => 'Full system access and management permissions',
        ]);
    }

    /**
     * Indicate that the role is News Editor.
     */
    public function newsEditor(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'News Editor',
            'slug' => 'news-editor',
            'description' => 'Can create, edit and publish news articles',
        ]);
    }

    /**
     * Indicate that the role is Department Admin.
     */
    public function departmentAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Department Admin',
            'slug' => 'department-admin',
            'description' => 'Can manage department-specific content and services',
        ]);
    }
}