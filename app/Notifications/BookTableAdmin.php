<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookTableAdmin extends Notification
{
    use Queueable;
    protected $details;
    /**
     * Create a new notification instance.
     */
    public function __construct($details)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Book table request')
            ->line('Book Table Request details')
            ->line('Name: ' . $this->details->name)
            ->line('Phone: ' . $this->details->phone)
            ->line('Email: ' . $this->details->email)
            ->line('Person: ' . $this->details->person)
            ->line('Date: ' . $this->details->reservation_date)
            ->line('Time: ' . $this->details->time)
            ->line('Message: ' . $this->details->message);
    }

    /**
     * Get the array representation of the notification.
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
