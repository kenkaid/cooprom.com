<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventRegistrationStatusUpdated extends Notification
{
    use Queueable;

    protected $event;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Event $event, $status)
    {
        $this->event = $event;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusLabel = [
            'confirmed' => 'confirmée',
            'cancelled' => 'annulée',
            'pending' => 'mise en attente',
        ];

        $label = $statusLabel[$this->status] ?? $this->status;
        $icon = $this->status === 'confirmed' ? 'fa-check-circle' : ($this->status === 'cancelled' ? 'fa-times-circle' : 'fa-info-circle');

        return [
            'title' => 'Inscription Événement',
            'message' => "Votre inscription à l'événement \"{$this->event->title}\" a été {$label}.",
            'event_id' => $this->event->id,
            'status' => $this->status,
            'icon' => $icon,
            'link' => route('events.show', $this->event->slug),
        ];
    }
}
