<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessageCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $msg;

    public function __construct($name,$email,$msg)
    {
        //
        $this->name  = $name;
        $this->email = $email;
        $this->msg   = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.messages.created')
                    ->with([
                        'name'  => $this->name,
                        'email' => $this->email,
                        'msg'   => $this->msg,
                    ]);
    }
}
