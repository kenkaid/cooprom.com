<?php

namespace App\Notifications;

use App\Models\VisaApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewTravelNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $visaApplication;

    /**
     * Create a new notification instance.
     */
    public function __construct(VisaApplication $visaApplication)
    {
        $this->visaApplication = $visaApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $userName = $this->visaApplication->user ? $this->visaApplication->user->name . ' ' . $this->visaApplication->user->last_name : 'Un membre';
        return [
            'title' => 'Nouvelle Demande de Voyage',
            'message' => $userName . ' a soumis une nouvelle demande de voyage/visa pour : ' . $this->visaApplication->country,
            'visa_application_id' => $this->visaApplication->id,
            'url' => route('admin.visa_applications.show', $this->visaApplication->uuid),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $userName = $this->visaApplication->user ? $this->visaApplication->user->name . ' ' . $this->visaApplication->user->last_name : 'Un membre';
        return new BroadcastMessage([
            'title' => 'Nouvelle Demande de Voyage',
            'message' => $userName . ' a soumis une nouvelle demande de voyage/visa pour : ' . $this->visaApplication->country,
        ]);
    }
}
