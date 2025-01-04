<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
    // Add this getter method
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Your Order Confirmation - Code: ' . $this->order->code)
            ->greeting('Hello ' . $this->order->first_name . ' ' . $this->order->last_name . ',')
            ->line('Thank you for your order! Below are the details of your order:')
            ->line('**Order Code:** ' . $this->order->code)
            ->line('**Payment Method:** ' . ucfirst($this->order->payment))
            ->line('**Shipping Address:** ' . $this->order->address . ', ' . $this->order->country)
            ->line('**Phone Number:** ' . $this->order->phone)
            ->line('**Order Note:** ' . ($this->order->note ?? 'No notes provided'))
            ->line('Here are the items in your order:')
            ->line('---');

        // Add product details
        foreach ($this->order->items as $item) {
            $mailMessage->line('**Product:** ' . $item->product->name)
                ->line('   Quantity: ' . $item->quantity)
                ->line('   Price per unit: $' . number_format($item->price, 2))
                ->line('   Total: $' . number_format($item->quantity * $item->price, 2))
                ->line('---');
        }

        $mailMessage->line('**Total Price:** $' . number_format($this->order->total_price, 2))
            ->line('We will process your order shortly. You will receive further updates via email.')
            ->line('Thank you for choosing our service!')
            ->salutation('Best regards, LBJ Jewelry Store');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->code,
            'total_price' => $this->order->total_price,
        ];
    }
}
