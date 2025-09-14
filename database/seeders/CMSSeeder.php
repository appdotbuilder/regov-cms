<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Department;
use App\Models\Event;
use App\Models\News;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $admin = User::firstOrCreate(
            ['email' => 'admin@regional.gov'],
            [
                'name' => 'System Administrator',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $editor = User::firstOrCreate(
            ['email' => 'editor@regional.gov'],
            [
                'name' => 'News Editor',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Get departments
        $departments = Department::all();
        
        if ($departments->isEmpty()) {
            $this->call(DepartmentSeeder::class);
            $departments = Department::all();
        }

        // Create sample news articles
        $newsArticles = [
            [
                'title' => 'New Community Center Opens Downtown',
                'excerpt' => 'A state-of-the-art community center featuring modern facilities and programs for all ages.',
                'content' => 'The Regional Government is proud to announce the opening of our new community center located in the heart of downtown. This $5 million facility includes a gymnasium, meeting rooms, computer lab, and youth center. The facility will host various programs including fitness classes, educational workshops, and community events. Mayor John Smith will cut the ribbon at the grand opening ceremony this Saturday at 10 AM.',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Road Construction Project on Main Street',
                'excerpt' => 'Major infrastructure improvements planned for Main Street with temporary traffic diversions.',
                'content' => 'The Public Works Department will begin a major road reconstruction project on Main Street starting next Monday. The project includes new asphalt, improved drainage, and upgraded traffic signals. Motorists should expect delays and are advised to use alternate routes. The project is expected to be completed within 6 weeks. We apologize for any inconvenience during this improvement period.',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Annual Health Fair This Weekend',
                'excerpt' => 'Free health screenings, vaccinations, and wellness programs available to all residents.',
                'content' => 'Join us for the annual Regional Health Fair this Saturday from 9 AM to 4 PM at the Regional Community Center. Free services include blood pressure screenings, cholesterol tests, vision screenings, and flu vaccinations. Local healthcare providers will offer consultations and wellness information. Children\'s activities and healthy cooking demonstrations will also be available.',
                'status' => 'published',
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($newsArticles as $article) {
            $article['slug'] = Str::slug($article['title']);
            $article['author_id'] = $editor->id;
            $article['department_id'] = $departments->random()->id;
            $article['views_count'] = random_int(50, 500);

            News::firstOrCreate(['slug' => $article['slug']], $article);
        }

        // Create sample announcements
        $announcements = [
            [
                'title' => 'City Hall Closed for Holiday',
                'content' => 'City Hall will be closed on Monday, December 25th for the Christmas holiday. Emergency services remain available.',
                'priority' => 'medium',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Water Service Interruption Notice',
                'content' => 'Water service will be temporarily interrupted on Elm Street between 8 AM and 2 PM on Tuesday for maintenance.',
                'priority' => 'high',
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($announcements as $announcement) {
            $announcement['author_id'] = $admin->id;
            $announcement['department_id'] = $departments->random()->id;

            Announcement::create($announcement);
        }

        // Create sample services
        $services = [
            [
                'title' => 'Business License Application',
                'description' => 'Apply for a new business license or renew an existing one.',
                'requirements' => "Required documents:\n• Completed application form\n• Proof of insurance\n• Zoning compliance certificate\n• Application fee payment",
                'process_steps' => "1. Complete application form\n2. Submit required documents\n3. Schedule inspection (if required)\n4. Pay fees\n5. Receive license",
                'fee' => 150.00,
                'processing_time' => '5-7 business days',
                'contact_person' => 'Maria Rodriguez',
                'contact_email' => 'business@regional.gov',
                'contact_phone' => '+1 (555) 123-9876',
                'status' => 'active',
            ],
            [
                'title' => 'Building Permit',
                'description' => 'Obtain permits for construction, renovation, or building modifications.',
                'requirements' => "Required documents:\n• Building plans and blueprints\n• Site survey\n• Engineering reports (if applicable)\n• Environmental impact assessment",
                'process_steps' => "1. Submit application and plans\n2. Plan review by building department\n3. Address any revisions\n4. Pay permit fees\n5. Schedule inspections\n6. Receive permit",
                'fee' => 250.00,
                'processing_time' => '2-4 weeks',
                'contact_person' => 'David Chen',
                'contact_email' => 'permits@regional.gov',
                'contact_phone' => '+1 (555) 234-8765',
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            $service['slug'] = Str::slug($service['title']);
            $service['department_id'] = $departments->where('name', 'Planning and Development')->first()->id ?? $departments->first()->id;

            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }

        // Create sample events
        $events = [
            [
                'title' => 'Town Hall Meeting - Budget Discussion',
                'description' => 'Join us for a public discussion about the upcoming fiscal year budget. Your input is valuable.',
                'start_date' => now()->addDays(7)->setHour(19)->setMinute(0),
                'end_date' => now()->addDays(7)->setHour(21)->setMinute(0),
                'location' => 'City Council Chambers, City Hall',
                'organizer' => 'Office of the Mayor',
                'contact_email' => 'townhall@regional.gov',
                'contact_phone' => '+1 (555) 123-4567',
                'is_featured' => true,
                'status' => 'scheduled',
            ],
            [
                'title' => 'Community Cleanup Day',
                'description' => 'Help keep our community beautiful! Volunteers needed for neighborhood cleanup activities.',
                'start_date' => now()->addDays(14)->setHour(9)->setMinute(0),
                'end_date' => now()->addDays(14)->setHour(15)->setMinute(0),
                'location' => 'Various locations (registration required)',
                'organizer' => 'Environmental Services',
                'contact_email' => 'cleanup@regional.gov',
                'contact_phone' => '+1 (555) 345-6789',
                'is_featured' => false,
                'status' => 'scheduled',
            ],
        ];

        foreach ($events as $event) {
            $event['slug'] = Str::slug($event['title']);
            $event['created_by'] = $admin->id;
            $event['department_id'] = $departments->random()->id;

            Event::firstOrCreate(['slug' => $event['slug']], $event);
        }
    }
}