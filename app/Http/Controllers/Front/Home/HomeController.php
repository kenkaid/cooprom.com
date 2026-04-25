<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EventService;

class HomeController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        // Recherche d'utilisateur qui ont un role staff
        $staffUsers = User::role(['staff'])->get();

        // Récupération des événements pour la home
        $featuredEvents = $this->eventService->getFeaturedEvents(3);
        $upcomingEvents = $this->eventService->getUpcomingEvents(3);

        return view('front.pages.home', compact('staffUsers', 'featuredEvents', 'upcomingEvents'));
    }
}
