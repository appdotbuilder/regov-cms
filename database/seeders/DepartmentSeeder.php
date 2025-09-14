<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Office of the Mayor',
                'description' => 'The executive office responsible for city leadership and administration.',
                'head_name' => 'Mayor John Smith',
                'contact_email' => 'mayor@regional.gov',
                'contact_phone' => '+1 (555) 123-4567',
                'address' => 'City Hall, 123 Main Street, Regional City',
            ],
            [
                'name' => 'Public Works Department',
                'description' => 'Maintains city infrastructure, roads, water systems, and public facilities.',
                'head_name' => 'Director Sarah Johnson',
                'contact_email' => 'publicworks@regional.gov',
                'contact_phone' => '+1 (555) 234-5678',
                'address' => 'Public Works Building, 456 Industrial Ave',
            ],
            [
                'name' => 'Health and Social Services',
                'description' => 'Provides healthcare programs, social assistance, and community health services.',
                'head_name' => 'Dr. Michael Brown',
                'contact_email' => 'health@regional.gov',
                'contact_phone' => '+1 (555) 345-6789',
                'address' => 'Health Services Center, 789 Wellness Drive',
            ],
            [
                'name' => 'Education Department',
                'description' => 'Oversees public education, school programs, and educational initiatives.',
                'head_name' => 'Superintendent Lisa Davis',
                'contact_email' => 'education@regional.gov',
                'contact_phone' => '+1 (555) 456-7890',
                'address' => 'Education Administration Building, 321 School Street',
            ],
            [
                'name' => 'Planning and Development',
                'description' => 'Manages urban planning, zoning, building permits, and economic development.',
                'head_name' => 'Director Robert Wilson',
                'contact_email' => 'planning@regional.gov',
                'contact_phone' => '+1 (555) 567-8901',
                'address' => 'Planning Office, 654 Development Plaza',
            ],
            [
                'name' => 'Public Safety',
                'description' => 'Coordinates police, fire, emergency services, and public safety initiatives.',
                'head_name' => 'Chief Jennifer Garcia',
                'contact_email' => 'safety@regional.gov',
                'contact_phone' => '+1 (555) 678-9012',
                'address' => 'Public Safety Building, 987 Security Boulevard',
            ],
        ];

        foreach ($departments as $dept) {
            $dept['slug'] = Str::slug($dept['name']);
            $dept['status'] = 'active';
            
            Department::firstOrCreate(['slug' => $dept['slug']], $dept);
        }
    }
}