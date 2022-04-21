<?php

namespace App\Http\Livewire;

use Stripe;
use Stripe\Charge;
use App\Models\Team;
use App\Models\Payment;
use App\Models\Zipcode;
use Livewire\Component;
use App\Models\CostByTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Payments extends Component
{

    public $phone;
    public $price_total=0;
    public $teams;
    public $number;
    public $amount;
    public $state;
    public $zipcode;
    public $address;
    public $user_id;
    public $description;
    public $success;
    public $currentPage = 1;
    public $selectedteams = array();
    public $total_teams;
    public $payment_record;
    public $pages = [];

    public function mount() {
        $this->step = 0;
        $this->teams = Team::UserId()->where('enabled', 0)->get();
        $this->pages = [
            1 => [
                'heading' => __('Detail of equipment and payments'),

            ],
            2 => [
                'heading' => __('Payment Details'),
            ]
        ];

    }
 /** Validaciones para Eventos, Usuarios, Payments */
    private $validationRules = [
            1 => [
                'selectedteams' => 'required',
                'price_total'   => 'required',
            ],

            2 => [
                'description' =>'required',
                'amount' =>     'required',
                'phone' =>      'required|min:10|max:12',
                'address' =>    'required',
                'zipcode' =>    'required',
            ],
        ];



    public function render()
    {
        return view('livewire.payments.new_payment');
    }

    private function create_payment(Request $request) {
        return Payment::create([
            'description'   => $request->name,
            'amount'        => $request->price_total,
            'user_id'       => Auth::user()->id,
            'source'        => $request->selectedteams,
            'address'       => $request->address,
            'zipcode'       => $request->zipcode,
            'phone'         => $request->phone
        ]);
    }

    private function update_Teams(Request $request) {
        $teams = explode(',', $request->selectedteams );
        foreach ($teams as $value) {
            Team::where('id', $value)->update([
                'payment_id' => $this->payment_record->id,
                'enabled'    => 1
            ]);
        }
    }

    public function makepayment(Request $request) {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->charge = null;
        $this->charge = Stripe\Charge::create ([
                "amount" => $request->price_total * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => $request->name
        ]);

        if (!is_null($this->charge)) {
            $this->payment_record = $this->create_payment($request);
            $this->update_Teams($request);
        } else {
            $this->store_message(__('Error to Process Payment.'));
        }
        return redirect()->route('teams');
    }

    public function read_zipcode() {
        $this->state ='';
        if ($this->zipcode) {
            $zipcode = Zipcode::where('zipcode','=',$this->zipcode)->first();
            if ($zipcode) {
                $this->state = $zipcode->town . ',' . $zipcode->state;
            } else {
                $this->zipcode = 0;
                $this->state = __('Zipcode does not Exists');
            }
        } else {
            $this->zipcode = 0;
            $this->state = __('Zipcode does not Exists');
        }
    }

    /** Funciones para multi steps */
    public function updated($propertyName) {
        $this->validateOnly($propertyName, $this->validationRules[$this->currentPage]);
    }

    public function goToNextPage() {
        $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToPreviousPage() {
        $this->currentPage--;
    }

    public function submit(Request $request) {
        $rules = collect($this->validationRules)->collapse()->toArray();
    }

    public function resetSuccess() {
        $this->reset('success');
    }

    public function countCheck() {
        $this->reset(['price_total']);
        $this->total_teams = count($this->selectedteams);
        if($this->total_teams){
            $sql ="SELECT cost FROM cost_by_teams WHERE " . $this->total_teams . ' BETWEEN min AND max';
            $records = DB::select($sql);
            if ($records) {
                foreach ($records as $record) {
                    $this->price_total = round($this->total_teams * $record->cost, 2);
                }
            }


        }
    }
}
