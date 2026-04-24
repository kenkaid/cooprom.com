<?php

namespace App\Notifications;

use App\Models\Production;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewProductionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $production;

    /**
     * Create a new notification instance.
     */
    public function __construct(Production $production)
    {
        $this->production = $production;
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
        $userName = $this->production->user ? $this->production->user->name . ' ' . $this->production->user->last_name : 'Un membre';
        return [
            'title' => 'Nouvelle Production',
            'message' => $userName . ' a créé un nouveau projet de production : ' . $this->production->title,
            'production_id' => $this->production->id,
            'url' => route('admin.productions.show', $this->production->uuid),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $userName = $this->production->user ? $this->production->user->name . ' ' . $this->production->user->last_name : 'Un membre';
        return new BroadcastMessage([
            'title' => 'Nouvelle Production',
            'message' => $userName . ' a créé un nouveau projet de production : ' . $this->production->title,
        ]);
    }
}
