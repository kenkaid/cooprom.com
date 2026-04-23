<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AdminGenericNotification extends Notification implements \Illuminate\Contracts\Broadcasting\ShouldBroadcast
{
    use Queueable;

    protected $details;

    /**
     * Create a new notification instance.
     *
     * @param array $details ['title', 'message', 'icon', 'url', 'buttonText']
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database', 'broadcast'];

        if (!empty($notifiable->email)) {
            $channels[] = 'mail';
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $title = $this->details['title'] ?? 'Alerte Administration COOPROM';
        $message = $this->details['message'] ?? '';
        $url = $this->details['url'] ?? route('admin.dashboard');
        $buttonText = $this->details['buttonText'] ?? 'Accéder au tableau de bord';

        return (new MailMessage)
            ->subject($title)
            ->view('emails.notification', [
                'notifTitle' => $title,
                'notifMessage' => $message,
                'url' => $url,
                'buttonText' => $buttonText
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->details['title'] ?? 'Notification Admin',
            'message' => $this->details['message'] ?? '',
            'icon' => $this->details['icon'] ?? 'bi-bell',
            'url' => $this->details['url'] ?? route('admin.dashboard'),
        ];
    }
}
