<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['pdf', 'doc', 'docx', 'xlsx', 'txt'];
        $fileType = fake()->randomElement($types);
        
        return [
            'title' => fake()->sentence(4) . ' Document',
            'description' => fake()->optional(0.8)->paragraph(),
            'file_path' => '/documents/' . fake()->slug() . '.' . $fileType,
            'file_name' => fake()->slug() . '.' . $fileType,
            'file_type' => $fileType,
            'file_size' => fake()->numberBetween(1024, 5242880), // 1KB to 5MB
            'category' => fake()->randomElement(['form', 'policy', 'report', 'manual', 'other']),
            'access_level' => fake()->randomElement(['public', 'restricted', 'internal']),
            'status' => fake()->randomElement(['active', 'archived']),
            'uploaded_by' => User::factory(),
            'department_id' => fake()->optional(0.7)->randomElement([null, Department::factory()]),
            'downloads_count' => fake()->numberBetween(0, 1000),
        ];
    }

    /**
     * Indicate that the document is public.
     */
    public function publicAccess(): static
    {
        return $this->state(fn (array $attributes) => [
            'access_level' => 'public',
            'status' => 'active',
        ]);
    }
}