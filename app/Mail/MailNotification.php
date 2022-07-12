<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\Promoter;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $email;
    public $type;
    public $payment;
    public $user;
    public $amount;
    public $total_teams;
    public $user_name;
    public $name;
    public $user_phone;
    public $user_email;
    public $activity;
    public $stripe_error = null;
    public $promoter=null;

    /*+---------------------------------------------------------+
      |                 PARAMETROS                              |
      +-----------------+---------------------------------------+
      | $email          | Correo destinatario                   |
      | $type           | Motivo                                |
      | $payment        | Registro del pago                     |
      | $user           | Datos del usuario que hace el pago    |
      | $amount         | Importe                               |
      | $total_teams    | Total de Equipos                      |
      | $stripe_error   | Error de stripe                       |
      | $promoter       | Promotor                              |
      +---------------------------------------------------------+
    */

    public function __construct($email, $type=null, Payment $payment=null, $user=null, $amount=null, $total_teams=null, $stripe_error=null, $promoter=null)
    {
        $this->email        = $email;
        $this->type         = $type;
        $this->payment      = $payment;
        $this->user         = $user;
        $this->amount       = $amount;
        $this->total_teams  = $total_teams;
        $this->stripe_error = $stripe_error;
        $this->promoter     = $promoter;

    }

    /*+------------------------------------------+
      | Construye el correo a partir de la vista |
      +------------------------------------------+
    */

    public function build()
    {
        switch ($this->type) {
            case 'noty_create_user':
                $this->activity = __('Someone Got Into The System');
                break;
            case 'noty_payment':
                $this->activity = __('A Payment Has Been Recorded');
                break;
            case 'noty_without_payment':
                $this->activity = __('There was an error in a payment attempt');
                break;
        }
        $this->user_name    = $this->user->name;
        $this->user_phone   = $this->user->phone;
        $this->user_email   = $this->user->email;

        if(!is_null($this->payment)){
            $this->name         = $this->payment->description;
            $this->amount       = $this->payment->amount;
            $this->total_teams  = $this->payment->source;
        }

        if ($this->user) {
            $this->from($this->email,env('MAIL_FROM_NAME'))
            ->subject('Galveston Cup 2022' . ' ' . $this->activity)
            ->view('livewire.email.mail_notification')
            ->with($this->activity,
                $this->user_name,
                $this->user_phone,
                $this->user_email,
                $this->type,
                $this->payment,
                $this->amount,
                $this->total_teams,
                $this->stripe_error,
                $this->promoter
            );
        } else {
            $this->from($this->email,env('MAIL_FROM_NAME'))
            ->subject('Galveston Cup 2022' . ' ' . $this->activity)
            ->view('livewire.email.mail_notification_payout')
            ->with($this->activity,
                $this->type,
                $this->name,
                $this->payment,
                $this->amount,
                $this->total_teams
            );
        }
    }
}
