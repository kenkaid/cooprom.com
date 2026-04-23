<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class MemberGenericNotification extends Notification implements \Illuminate\Contracts\Broadcasting\ShouldBroadcast
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
        Log::info('[MemberGenericNotification] Instance créée', ['details' => $details]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        Log::info('[MemberGenericNotification] via appelé pour ' . get_class($notifiable) . ' ID: ' . ($notifiable->id ?? 'unknown'));

        $channels = ['database', 'broadcast'];

        if (!empty($notifiable->email)) {
            $channels[] = 'mail';
        } else {
            Log::warning('[MemberGenericNotification] Pas d\'email pour le notifiable ID: ' . ($notifiable->id ?? 'unknown') . ', canal mail ignoré.');
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $title = $this->details['title'] ?? 'Notification COOPROM';
        $message = $this->details['message'] ?? '';
        $url = $this->details['url'] ?? route('member.dashboard');
        $buttonText = $this->details['buttonText'] ?? 'Consulter mon espace';

        try {
            return (new MailMessage)
                ->subject($title)
                ->view('emails.notification', [
                    'notifTitle' => (string) $title,
                    'notifMessage' => (string) $message,
                    'url' => (string) $url,
                    'buttonText' => (string) $buttonText
                ]);
        } catch (\Exception $e) {
            Log::error('[MemberGenericNotification] Erreur dans toMail: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        Log::info('[MemberGenericNotification] toArray (database/broadcast) appelé');
        return [
            'title' => $this->details['title'] ?? 'Notification',
            'message' => $this->details['message'] ?? '',
            'icon' => $this->details['icon'] ?? 'fa-bell',
            'url' => $this->details['url'] ?? route('member.dashboard'),
        ];
    }
}
