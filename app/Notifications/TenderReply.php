<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TenderReply extends Notification
{
    use Queueable;
    private $tender;

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
        return ['mail','database'];
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
            ->subject(__("Réponse à une demande de devis"))
            ->greeting('Bonjour,' . $notifiable->name)
            ->line("Titre de la demande de devis: " . $this->tender->name)
            ->action("Voir la demande", url('/quotations'))
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

    public static function toText($data)
    {

        return "Votre demande de devis " . ' ' . $data['name'].' '. 'à reçu une offre';
    }
}
