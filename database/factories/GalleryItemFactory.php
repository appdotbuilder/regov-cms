<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['photo', 'video']);
        
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->optional(0.7)->paragraph(),
            'type' => $type,
            'file_path' => $type === 'photo' ? '/images/gallery/photo-' . fake()->numberBetween(1, 100) . '.jpg' : '/videos/gallery/video-' . fake()->numberBetween(1, 20) . '.mp4',
            'thumbnail' => $type === 'video' ? '/images/thumbs/thumb-' . fake()->numberBetween(1, 20) . '.jpg' : null,
            'alt_text' => fake()->optional(0.8)->sentence(4),
            'status' => fake()->randomElement(['active', 'inactive']),
            'uploaded_by' => User::factory(),
            'department_id' => fake()->optional(0.6)->randomElement([null, Department::factory()]),
            'views_count' => fake()->numberBetween(0, 500),
        ];
    }

    /**
     * Indicate that the item is a photo.
     */
    public function photo(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'photo',
            'file_path' => '/images/gallery/photo-' . fake()->numberBetween(1, 100) . '.jpg',
            'thumbnail' => null,
        ]);
    }

    /**
     * Indicate that the item is a video.
     */
    public function video(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'video',
            'file_path' => '/videos/gallery/video-' . fake()->numberBetween(1, 20) . '.mp4',
            'thumbnail' => '/images/thumbs/thumb-' . fake()->numberBetween(1, 20) . '.jpg',
        ]);
    }
}