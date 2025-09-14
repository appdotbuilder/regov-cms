<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisitorStat>
 */
class VisitorStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pages = [
            '/',
            '/news',
            '/services',
            '/departments',
            '/events',
            '/gallery',
            '/contact',
        ];

        return [
            'date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'page_url' => fake()->randomElement($pages),
            'page_title' => fake()->sentence(4),
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'referrer' => fake()->optional(0.6)->url(),
            'session_duration' => fake()->numberBetween(30, 3600), // 30 seconds to 1 hour
        ];
    }
}