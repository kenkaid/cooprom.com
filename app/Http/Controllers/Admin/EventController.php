<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Notifications\EventRegistrationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:festival,exposition,seminaire,spectacle,foire,congres,autre',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,open_registration,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'technical_file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
            'budget_allocated' => 'nullable|numeric|min:0',
            'entry_fee' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events/images', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('technical_file')) {
            $filePath = $request->file('technical_file')->store('events/technical_files', 'public');
            $validated['technical_file'] = $filePath;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $participants = $event->users()->latest('event_user.created_at')->limit(5)->get();
        return view('admin.events.show', compact('event', 'participants'));
    }

    /**
     * Liste complète des participants avec pagination.
     */
    public function participants(Event $event)
    {
        $participants = $event->users()->latest('event_user.created_at')->paginate(20);
        return view('admin.events.participants', compact('event', 'participants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:festival,exposition,seminaire,spectacle,foire,congres,autre',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,open_registration,ongoing,completed,cancelled',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'technical_file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
            'budget_allocated' => 'nullable|numeric|min:0',
            'actual_expenses' => 'nullable|numeric|min:0',
            'entry_fee' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events/images', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('technical_file')) {
            $filePath = $request->file('technical_file')->store('events/technical_files', 'public');
            $validated['technical_file'] = $filePath;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement supprimé avec succès.');
    }

    /**
     * Met à jour le statut d'un participant à un événement.
     */
    public function updateParticipantStatus(Request $request, Event $event, $userId)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $event->users()->updateExistingPivot($userId, [
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);

        // Notification du client
        $user = User::findOrFail($userId);
        $user->notify(new EventRegistrationStatusUpdated($event, $validated['status']));

        return back()->with('success', 'Statut du participant mis à jour et client notifié.');
    }
}
