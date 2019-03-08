<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Notifications\AssignPost;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignPost extends Notification
{
    use Queueable;

    private $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        //
        $this->post = $post;
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
            ->subject(__("Attribution appel d'offre"))
            ->greeting('Bonjour,' . $notifiable->name)
            ->line("l'appel d'offre: " . $this->post->name)
            ->line("vous a été attribué, rendez-vous sur")
            ->action("Voir l'offre", url('/posts'))
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
            'name' => $this->post->name
        ];
    }

    public static function toText($data)
    {

        return "l'appel d'offre vous a été attribué" . ' ' . $data['name'];
    }
}
