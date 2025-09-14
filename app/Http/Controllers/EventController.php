<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::where('start_date', '>', now())
            ->where('status', 'scheduled')
            ->with(['department', 'creator'])
            ->orderBy('start_date')
            ->get();

        $featuredEvents = Event::where('start_date', '>', now())
            ->where('status', 'scheduled')
            ->where('is_featured', true)
            ->with(['department', 'creator'])
            ->orderBy('start_date')
            ->limit(3)
            ->get();

        return Inertia::render('events/index', [
            'events' => $events,
            'featuredEvents' => $featuredEvents,
        ]);
    }

    /**
     * Display the specified event.
     */
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)
            ->with(['department', 'creator'])
            ->firstOrFail();

        return Inertia::render('events/show', [
            'event' => $event
        ]);
    }
}