<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Stripe;
use Throwable;
use Stripe\Charge;
use App\Models\Payment;
use Illuminate\Http\Request;
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


    public function mount(){
        $this->total_teams = 0;
        $this->price_team = 0;
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
                $this->send_Mail_Confirmation($request->email, $request->name, $request->price_team, $request->total_teams);
                //$this->send_notifications($request->name, 'noty_payment', $payment);
                return redirect()->route('confirmation');
            }
        } catch (\Throwable $exception) {
            //$this->send_notifications($request->name, 'noty_without_payment', null, $request->price_team, $request->total_teams);
            $this->error_stripe = $exception->getMessage();
            return redirect()->route('error', [$this->error_stripe]);
        }
    }

    // Correo al usuario de confirmación
    public function send_Mail_Confirmation($request_email, $request_name, $total = null, $total_teams = null)
    {
        $email = $request->email;
        $total = $request->name;
        $total_teams = $reques->total_teams;
        return Mail::to($email)->send(new ConfirmationMail($email, $total, $total_teams, $token, $token_player));
    }

    /** Envío de notificación a Email Notifications */
    /* public function send_notifications($user, $type = 'noty_payment', Payment $payment = null, $amount = null, $total_teams = null)
    {
        $users_to_notify = EmailNotification::where('noty_payment', 1)->get();
        $promoter = null;
        if ($users_to_notify->count()) {
            foreach ($users_to_notify as $user_to_notify) {
                Mail::to($user_to_notify->email)->send(new MailNotification($user_to_notify->email, $type, $payment, $user, $amount, $total_teams, $this->error_stripe, $promoter));
            }
        }
    } */

    public function increament() {
        $this->total_teams+=1;
        $sql ="SELECT cost FROM cost_by_teams WHERE " . $this->total_teams . ' BETWEEN min AND max';
        $this->records = DB::select($sql);
        if ($this->records) {
            foreach ($this->records as $record) {
                $this->price_team = round($this->total_teams * $record->cost-10, 2);
            }
        }
    }

    public function decreament() {
        if ($this->total_teams > 0) {
            $this->total_teams-=1;
            $sql ="SELECT cost FROM cost_by_teams WHERE " . $this->total_teams . ' BETWEEN min AND max';
            $this->records = DB::select($sql);
            if ($this->records) {
                foreach ($this->records as $record) {
                    $this->price_team = round($this->total_teams * $record->cost-10, 2);
                }
            }
        } else {
            $this->price_team = 0;
            $this->total_teams = 0;
        }
    }

}
