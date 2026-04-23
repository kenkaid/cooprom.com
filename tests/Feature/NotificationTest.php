<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\MemberGenericNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_generic_notification_sends()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $details = [
            'title' => 'Test Title',
            'message' => 'Test Message',
            'url' => 'http://localhost/test',
            'buttonText' => 'Click Me'
        ];

        $user->notify(new MemberGenericNotification($details));

        Notification::assertSentTo(
            [$user], MemberGenericNotification::class
        );
    }

    public function test_member_generic_notification_content()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $details = [
            'title' => 'Test Title',
            'message' => 'Test Message',
            'url' => 'http://localhost/test',
            'buttonText' => 'Click Me'
        ];

        $notification = new MemberGenericNotification($details);
        $mailData = $notification->toMail($user);

        $this->assertEquals('Test Title', $mailData->subject);
        $this->assertEquals('emails.notification', $mailData->view);
        $this->assertEquals($details['title'], $mailData->viewData['title']);
        $this->assertEquals($details['message'], $mailData->viewData['message']);
        $this->assertEquals($details['url'], $mailData->viewData['url']);
        $this->assertEquals($details['buttonText'], $mailData->viewData['buttonText']);
    }
}
