<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::active()
            ->with(['department'])
            ->orderBy('title')
            ->paginate(12);

        return Inertia::render('services/index', [
            'services' => $services
        ]);
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->active()
            ->with(['department'])
            ->firstOrFail();

        return Inertia::render('services/show', [
            'service' => $service
        ]);
    }
}