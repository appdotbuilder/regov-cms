<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GalleryController extends Controller
{
    /**
     * Display photo gallery.
     */
    public function index()
    {
        $photos = GalleryItem::active()
            ->where('type', 'photo')
            ->latest()
            ->paginate(24);

        return Inertia::render('gallery/photos', [
            'photos' => $photos
        ]);
    }

    /**
     * Display video gallery.
     */
    public function show()
    {
        $videos = GalleryItem::active()
            ->where('type', 'video')
            ->latest()
            ->paginate(12);

        return Inertia::render('gallery/videos', [
            'videos' => $videos
        ]);
    }
}