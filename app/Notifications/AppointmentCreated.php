<?php

namespace App\Notifications;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class AppointmentCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return env("SEND_SMS", false) ? ['mail', 'nexmo'] : ['mail'];
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
            ->subject('Appointment Created')
            ->greeting('Hello ' . $notifiable->name . '...!')
            ->line('Your appointment is successfully created.')
            ->line('Doctor - ' . $this->appointment->schedule->doctor->name)
            ->line('Channel Type - ' . $this->appointment->schedule->doctor->channelType->channel_type)
            ->line('Channeling Date - ' . $this->appointment->date)
            ->line('Channeling Number - ' . str_pad($this->appointment->number, 2, '0', STR_PAD_LEFT))
            ->line('Estimated Time - ' . Carbon::createFromFormat("H:i:s", $this->appointment->time)->format("h:i A"))
            ->line('Reference Number - ' . $this->appointment->date .
                "/SCH" . str_pad($this->appointment->schedule_id, 5, '0', STR_PAD_LEFT)  .
                "/" . str_pad($this->appointment->number, 2, '0', STR_PAD_LEFT))
            ->line('Channeling Fee - ' . "Rs.  " . number_format($this->appointment->schedule->channeling_fee, 2))
            ->line('Thank you for contacting  ' . env('APP_NAME') . '.');
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

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content("Your appointment is successfully created for "
                . $this->appointment->schedule->doctor->name . " on "
                . $this->appointment->date . " at "
                . $this->appointment->time_text . ". Your channeling number is "
                . str_pad($this->appointment->number, 2, '0', STR_PAD_LEFT) . ".     ");
    }
}