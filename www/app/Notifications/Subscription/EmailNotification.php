<?php

declare(strict_types=1);

namespace App\Notifications\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class EmailNotification extends Notification
{
    use Queueable;

    /**
     * The first name of the subscriber.
     */
    private readonly string $firstName;

    /**
     * The last name of the subscriber.
     */
    private readonly string $lastName;

    /**
     * The role of the subscriber.
     */
    private readonly string $role;

    /**
     * Create a new notification instance.
     *
     * @param  string  $firstName  The first name.
     * @param  string  $lastName  The last name.
     * @param  string  $role  The role.
     */
    public function __construct(string $firstName, string $lastName, string $role)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->role = $role;
    }

    /**
     * Get the notification's delivery channels.
     *
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())->line(Str::of('Welcome, ')->append($this->role, ' ', $this->firstName, ' ', $this->lastName, '!'));
    }

    /**
     * Get the array representation of the notification.
     *
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
