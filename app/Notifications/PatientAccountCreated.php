<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientAccountCreated extends Notification implements ShouldQueue
{
    use Queueable;

    private $password = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password = null)
    {
        $this->password = $password;
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

        if (isset($password)) {
            return (new MailMessage)
                ->subject('Patient Account Created')
                ->greeting('Hello ' . $notifiable->name . '...!')
                ->line('Welcome to the ' . env('APP_NAME') . '. Please log in to the system and update your profile.')
                ->line('Username - ' . $notifiable->username)
                ->line('Password - ' . $this->password)
                ->line('Thank you for using our application!');
        } else {
            return (new MailMessage)
                ->subject('Patient Account Created')
                ->greeting('Hello ' . $notifiable->name . '...!')
                ->line('Welcome to the ' . env('APP_NAME') . '. Please log in to the system and update your profile.')
                ->line('Thank you for using our application!');
        }
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