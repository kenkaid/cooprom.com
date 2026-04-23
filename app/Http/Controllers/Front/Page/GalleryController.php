<?php

namespace App\Http\Controllers\Front\Page;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function photos()
    {
        // On récupère uniquement les fichiers (images) de la médiathèque
        $photos = MediaLibrary::where('type', 'file')
            ->where('is_active', true)
            ->latest()
            ->paginate(9); // Pagination par 9 (3 colonnes x 3 lignes)

        return view('front.pages.cooprom.gallery_photos', compact('photos'));
    }

    public function videos()
    {
        // On récupère les liens externes (youtube, facebook, vimeo)
        $videos = MediaLibrary::whereIn('type', ['youtube', 'facebook', 'vimeo'])
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('front.pages.cooprom.gallery_videos', compact('videos'));
    }
}
