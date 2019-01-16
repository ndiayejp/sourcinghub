<?php

namespace App\Notifications;

use App\Tender;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InviteProviderNotify extends Notification
{
    use Queueable;

    public $tender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tender)
    {
        //
        $this->tender = $tender;
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
                    ->subject(__("Nouvelle demande de quotation"))
                    ->line(__("Vous êtes invité à répondre à la demande de quotation."))
                    ->line('Titre de la demande : ' . $this->tender->name)
                    ->action("Voir la demande", url('/'))
                    ->line("Merci d'utiliser Sourcing Hub!");
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
            'name' => $this->tender->name
             
        ];
    }
}
