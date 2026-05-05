<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Liste des événements.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $events = $this->eventService->getUpcomingEvents(9, $type);
        $pastEvents = $this->eventService->getPastEvents(3);
        $featuredEvents = $this->eventService->getFeaturedEvents(3);

        return view('front.events.index', compact('events', 'pastEvents', 'featuredEvents'));
    }

    /**
     * Détails d'un événement.
     */
    public function show($slug)
    {
        $event = $this->eventService->getEventBySlug($slug);
        $upcomingEvents = $this->eventService->getUpcomingEvents(3);

        $registration = null;
        if (auth()->check()) {
            $registration = auth()->user()->events()
                ->where('event_id', $event->id)
                ->first();
        }

        $isRegistered = !is_null($registration);
        $registrationStatus = $registration ? $registration->pivot->status : null;

        return view('front.events.show', compact('event', 'upcomingEvents', 'isRegistered', 'registrationStatus'));
    }

    /**
     * Téléchargement du pass membre pour l'événement.
     */
    public function downloadPass($slug)
    {
        $event = $this->eventService->getEventBySlug($slug);

        // Vérifier si l'événement est passé
        if ($event->start_date->isPast() || $event->status === 'completed') {
            return back()->with('error', 'Le pass n\'est plus disponible car l\'événement est terminé.');
        }

        $user = auth()->user();

        $registration = $user->events()
            ->where('event_id', $event->id)
            ->where('event_user.status', 'confirmed')
            ->firstOrFail();

        $pdf = Pdf::loadView('front.events.pass', compact('event', 'user', 'registration'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Pass-' . Str::slug($event->title) . '.pdf');
    }

    /**
     * Inscription d'un membre à un événement.
     */
    public function register(Request $request, $slug)
    {
        $event = $this->eventService->getEventBySlug($slug);

        if (!$event->canRegister()) {
            if ($event->isPast()) {
                return back()->with('error', 'Cet événement est déjà passé.');
            }
            if ($event->status !== 'open_registration') {
                return back()->with('error', 'Les inscriptions ne sont pas ouvertes pour cet événement.');
            }
            if ($event->isFull()) {
                return back()->with('error', 'Désolé, cet événement est complet.');
            }
        }

        $user = auth()->user();

        if ($user->events()->where('event_id', $event->id)->exists()) {
            return back()->with('warning', 'Vous êtes déjà inscrit à cet événement.');
        }

        $user->events()->attach($event->id, [
            'notes' => $request->input('notes'),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Votre demande d\'inscription a été enregistrée avec succès !');
    }
}
