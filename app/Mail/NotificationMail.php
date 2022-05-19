<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $noty;
    public $first_variable;
    public $second_variable;
    public $third_variable;

    public function __construct($recipient, $noty, $first_variable, $second_variable, $third_variable)
    {
        $this->recipient = $recipient;
        $this->noty = $noty;
        $this->first_variable = $first_variable;
        $this->second_variable = $second_variable;
        $this->third_variable = $third_variable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->recipient,env('MAIL_FROM_NAME'))
        ->subject('Galveston Cup 2022')
        ->view('livewire.email.notificationmail')
        ->with($this->noty, $this->first_variable, $this->second_variable, $this->third_variable);
    }
}
