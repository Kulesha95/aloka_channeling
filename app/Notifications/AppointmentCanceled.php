<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\Exception;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCanceled extends Notification implements ShouldQueue
{
    use Queueable;

    protected $schedule, $exception;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule, Exception $exception)
    {
        $this->schedule = $schedule;
        $this->exception = $exception;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return env("SEND_SMS", false) ? ['mail', SmsChannel::class] : ['mail'];
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
            ->subject('Appointment Canceled')
            ->greeting('Hello ' . $notifiable->name . '...!')
            ->line('Your following appointment has been canceled due to an unavoidable reason.')
            ->line('Doctor - ' . $this->schedule->doctor->name)
            ->line('Channel Type - ' . $this->schedule->doctor->channelType->channel_type)
            ->line('Channeling Date - ' . $this->exception->date)
            ->line('We apologize for the inconvenience caused and we will be contact you soon to reschedule your appointment. Please feel free to contacting us for more information.')
            ->line('Thank you.');
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
     * Get the SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toSms($notifiable)
    {
        return "Your appointment for "
            . $this->schedule->doctor->name . " on "
            . $this->exception->date . " has been canceled due to an unavoidable reason. We apologize for the inconvenience caused and we will be contact you soon to reschedule your appointment..\n\n" . env('APP_NAME');
    }
}