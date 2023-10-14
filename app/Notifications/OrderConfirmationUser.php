<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class OrderConfirmationUser extends Notification
{
    use Queueable;
    protected $user;
    protected $order;
    protected $item;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $order, $item)
    {
        $this->user = $user;
        $this->order = $order;
        $this->item = $item;
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
            ->subject("Order Placed Successfully")
            ->greeting("Hello " . $this->user->name . "!")
            ->line('Your order has been placed!')
            ->line('Order Details')
            ->line('Order Id: ' . $this->order->id)
            ->line('Item Name: ' . $this->item->name)
            ->line('Total amount: $' . $this->order->payment_amount);
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
