<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $total;
    public $total_teams;
    public $token;
    public $token_player;

    public function __construct($email, $total, $total_teams, $token, $token_player)
    {
        $this->email = $email;
        $this->total = $total;
        $this->total_teams = $total_teams;
        $this->token = $token;
        $this->token_player = $token_player;
    }


    public function build()
    {

        if(App::isLocale('en')) {
            $this->from($this->email,env('MAIL_FROM_NAME'))
                ->subject('Welcome to Galveston Cup 2022')
                ->view('livewire.email.sendmail')->with($this->total, $this->total_teams, $this->token, $this->token_player);
        }else {
            $this->from($this->email,env('MAIL_FROM_NAME'))
            ->subject('Bienvenido a la Galveston Cup 2022')
            ->view('livewire.email.sendmail')->with($this->total, $this->total_teams, $this->token, $this->token_player);
        }
    }
}
