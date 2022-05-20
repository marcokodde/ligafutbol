<?php

namespace App\Mail;

use App\Models\Payment;
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
    public $user_phone;
    public $user_email;
    public $activity;

    public function __construct($email,$type=null,Payment $payment=null,$user,$amount=null,$total_teams=null)
    {
        $this->email    = $email;
        $this->type     = $type;
        $this->payment  = $payment;
        $this->user     = $user;
        $this->amount    = $amount;
        $this->total_teams= $total_teams;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->type) {
            case 'noty_create_user':
                $this->activity = __('Someone Got Into The System');
                break;
            case 'create_payment':
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
            $this->amout        = $this->payment->amount;
            $this->total_teams  = $this->payment->source;
        }


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
                           $this->total_teams
                        );


    }
}
