<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Main Admin',
                'slug' => 'main-admin',
                'description' => 'Full system access and management permissions. Can manage all content, users, and system settings.',
            ],
            [
                'name' => 'News Editor',
                'slug' => 'news-editor',
                'description' => 'Can create, edit, and publish news articles and announcements. Has access to media gallery.',
            ],
            [
                'name' => 'Department Admin',
                'slug' => 'department-admin',
                'description' => 'Can manage department-specific content, services, and events. Limited to assigned department.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}