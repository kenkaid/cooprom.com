<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;
use Cohensive\Embed\Facades\Embed;

class MediaLibraryController extends Controller
{
    public function index()
    {
        $mediaItems = MediaLibrary::latest()->paginate(12);
        return view('admin.media_library.index', compact('mediaItems'));
    }

    public function create()
    {
        return view('admin.media_library.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:file,youtube,facebook,vimeo',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:20480', // 20MB
            'external_url' => 'nullable|url|required_if:type,youtube,facebook,vimeo',
            'description' => 'nullable|string',
        ]);

        $mediaItem = MediaLibrary::create([
            'title' => $request->title,
            'type' => $request->type,
            'external_url' => $request->external_url,
            'description' => $request->description,
        ]);

        if ($request->hasFile('media_file')) {
            $mediaItem->addMediaFromRequest('media_file')->toMediaCollection('library');
        }

        return redirect()->route('admin.media-library.index')->with('success', 'Élément ajouté avec succès.');
    }

    public function show(MediaLibrary $mediaLibrary)
    {
        $embedHtml = null;
        if (in_array($mediaLibrary->type, ['youtube', 'facebook', 'vimeo']) && $mediaLibrary->external_url) {
            $embed = Embed::make($mediaLibrary->external_url)->parseUrl();
            if ($embed) {
                $embedHtml = $embed->getHtml();
            }
        }
        return view('admin.media_library.show', compact('mediaLibrary', 'embedHtml'));
    }

    public function edit(MediaLibrary $mediaLibrary)
    {
        return view('admin.media_library.edit', compact('mediaLibrary'));
    }

    public function update(Request $request, MediaLibrary $mediaLibrary)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:file,youtube,facebook,vimeo',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:20480',
            'external_url' => 'nullable|url|required_if:type,youtube,facebook,vimeo',
            'description' => 'nullable|string',
        ]);

        $mediaLibrary->update([
            'title' => $request->title,
            'type' => $request->type,
            'external_url' => $request->external_url,
            'description' => $request->description,
        ]);

        if ($request->hasFile('media_file')) {
            $mediaLibrary->clearMediaCollection('library');
            $mediaLibrary->addMediaFromRequest('media_file')->toMediaCollection('library');
        }

        return redirect()->route('admin.media-library.index')->with('success', 'Élément mis à jour avec succès.');
    }

    public function destroy(MediaLibrary $mediaLibrary)
    {
        $mediaLibrary->delete();
        return redirect()->route('admin.media-library.index')->with('success', 'Élément supprimé avec succès.');
    }
}
