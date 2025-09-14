<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index()
    {
        $departments = Department::active()
            ->withCount(['news', 'services', 'events'])
            ->orderBy('name')
            ->paginate(12);

        return Inertia::render('departments/index', [
            'departments' => $departments
        ]);
    }

    /**
     * Display the specified department.
     */
    public function show(string $slug)
    {
        $department = Department::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $news = $department->news()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit(5)
            ->get();

        $services = $department->services()
            ->where('status', 'active')
            ->orderBy('title')
            ->get();

        $events = $department->events()
            ->where('start_date', '>', now())
            ->where('status', 'scheduled')
            ->orderBy('start_date')
            ->limit(3)
            ->get();

        return Inertia::render('departments/show', [
            'department' => $department,
            'news' => $news,
            'services' => $services,
            'events' => $events,
        ]);
    }
}