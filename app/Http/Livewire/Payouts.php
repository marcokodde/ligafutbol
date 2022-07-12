<?php

namespace App\Http\Livewire;

use Stripe;
use Throwable;
use Stripe\Charge;
use App\Models\Payment;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use App\Mail\MailNotification;
use App\Models\EmailNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Traits\SettingsTrait;

class Payouts extends Component
{
    use SettingsTrait;

    public $phone;
    public $price_team;
    public $teams;
    public $amount;
    public $record_id, $record;
    public $user_id;
    public $quantity_team;
    public $success;
    public $accept_terms;
    public $records;
    public $total_teams = 0;
    public $fullname;
    public $email;
    public $count = null;
    public $error_stripe = null;


    public function mount($number_teams=null, $price=null){
        $this->total_teams = $number_teams;
        $this->price_team = $price;
    }

    public function render()
    {
        return view('livewire.payouts.index');
    }


    /** Procesa el pago */
    public function makepayout(Request $request)
    {
        $this->charge = null;
        $this->error_stripe = null;
        // Procesar el pago
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $this->charge = Stripe\Charge::create([
                'amount' => $request->price_team * 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => $request->name,
            ]);
            $payment = Payment::create([
                'amount' => $request->price_team,
                'description' => $request->fullname,
                'user_id' => 1,
                'promoter_id' => null,
                'source' => $request->total_teams,
            ]);

            if ($payment) {
                $this->send_Mail_Confirmation($request->email, $request->price_team, $request->total_teams,  $token=null, $token_player=null);
                /* Correo para notificar a equipo Ahava */
                $users_to_notify = EmailNotification::where('noty_payment', 1)->get();
                if ($users_to_notify->count()) {
                    foreach ($users_to_notify as $user_to_notify) {
                        Mail::to($user_to_notify->email)
                                ->send(new MailNotification($user_to_notify->email,
                                                            $type="noty_payment",
                                                            $payment,
                                                            $user="null",
                                                            $amount="null",
                                                            $total_teams="null",
                                                            $this->error_stripe="null",
                                                            $promoter ="null"));
                    }
                }
                return redirect()->route('confirmation');
            }
        } catch (\Throwable $exception) {
            //$this->send_notifications($request->name, 'noty_without_payment', null, $request->price_team, $request->total_teams);
            $this->error_stripe = $exception->getMessage();
            return redirect()->route('error', [$this->error_stripe]);
        }
    }

    // Correo al usuario de confirmación
    public function send_Mail_Confirmation($email, $total, $total_teams, $token=null, $token_player=null) {
        return Mail::to($email)->send(new ConfirmationMail($email, $total, $total_teams, $token=null, $token_player=null));
    }
}