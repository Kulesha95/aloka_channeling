<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderCreated extends Notification 
{
    use Queueable;

    protected $purchaseOrderId, $pdf;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($purchaseOrderId, $pdf)
    {
        $this->purchaseOrderId = $purchaseOrderId;
        $this->pdf = $pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Purchase Order Created')
            ->greeting('Hello...!')
            ->line('We are writing to you to here by requesting to purchase the following items for ' . env('APP_NAME'))
            ->line('Please find the below purchase order.')
            ->action('View Online', route('documents.getPdf', ['type' => 'purchaseOrder', 'id' => $this->purchaseOrderId, 'action' => 'view']))
            ->line('Thank you for using our application!')
            ->attachData($this->pdf, 'Purchase_Order.pdf');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}