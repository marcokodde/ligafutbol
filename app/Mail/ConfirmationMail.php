<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public function __construct($email)
    {
        $this->email = $email;
    }


    public function build()
    {
        $this->from($this->email)
        ->subject('A Registration Was Added!')
        ->view('livewire.email.sendmail');
    }
}
