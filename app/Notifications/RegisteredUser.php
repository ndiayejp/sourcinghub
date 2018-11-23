<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->success()
                    ->subject('Inscription sur le site')
                    ->line('Votre compte a bien été créé. Vueillez le confirmer en cliquant sur le lien ci-dessous.')
                    ->action('Confirmer votre compte', url("confirm/{$notifiable->id}/".urlencode($notifiable->confirmation_token)))
                    ->line("Une fois votre compte activé, vous allez recevoir un mail confirmant la validation de votre compte!")
                    ->line("Cordialement,")
                    ->line("L'équipe de support Sourcing-hub")
                    ->line("Vous n'êtes pas l'origine de cette demande ? Ignorez l'email.");
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
