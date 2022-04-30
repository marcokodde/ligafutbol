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
    public $total;
    public $total_teams;
    public $token;

    public function __construct($email, $total, $total_teams, $token)
    {
        $this->email = $email;
        $this->total = $total;
        $this->total_teams = $total_teams;
        $this->token = $token;

    }


    public function build()
    {
        $this->from($this->email)
        ->subject('A Registration Was Added!')
        ->view('livewire.email.sendmail')->with($this->total, $this->total_teams, $this->token);
    }
}