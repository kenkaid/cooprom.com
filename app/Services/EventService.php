<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;

class EventService
{
    /**
     * Récupère les événements à venir.
     */
    public function getUpcomingEvents($perPage = 9, $type = null)
    {
        $query = Event::where('status', '!=', 'draft')
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date', 'asc');

        if ($type) {
            $query->where('type', $type);
        }

        return $query->paginate($perPage);
    }

    /**
     * Récupère les événements passés.
     */
    public function getPastEvents($perPage = 6)
    {
        return Event::where('status', '!=', 'draft')
            ->where(function($q) {
                $q->where('start_date', '<', Carbon::now())
                  ->orWhere('status', 'completed');
            })
            ->orderBy('start_date', 'desc')
            ->paginate($perPage);
    }

    /**
     * Récupère les événements à la une (featured).
     */
    public function getFeaturedEvents($limit = 3)
    {
        return Event::where('is_featured', true)
            ->where('status', '!=', 'draft')
            ->orderBy('start_date', 'asc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère un événement par son slug.
     */
    public function getEventBySlug($slug)
    {
        return Event::where('slug', $slug)
            ->where('status', '!=', 'draft')
            ->firstOrFail();
    }
}
