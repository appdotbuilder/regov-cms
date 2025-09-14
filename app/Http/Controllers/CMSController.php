<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Department;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\News;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CMSController extends Controller
{
    /**
     * Display the CMS homepage with latest content.
     */
    public function index()
    {
        $latestNews = News::published()
            ->with(['author', 'department'])
            ->latest('published_at')
            ->limit(6)
            ->get();

        $urgentAnnouncements = Announcement::active()
            ->where('priority', 'urgent')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $upcomingEvents = Event::where('start_date', '>', now())
            ->where('status', 'scheduled')
            ->with(['department', 'creator'])
            ->orderBy('start_date')
            ->limit(4)
            ->get();

        $departments = Department::active()
            ->orderBy('name')
            ->get();

        $stats = [
            'news_count' => News::published()->count(),
            'services_count' => Service::active()->count(),
            'departments_count' => Department::active()->count(),
            'upcoming_events' => Event::where('start_date', '>', now())
                ->where('status', 'scheduled')
                ->count(),
        ];

        return Inertia::render('welcome', [
            'latestNews' => $latestNews,
            'urgentAnnouncements' => $urgentAnnouncements,
            'upcomingEvents' => $upcomingEvents,
            'departments' => $departments,
            'stats' => $stats,
        ]);
    }


}