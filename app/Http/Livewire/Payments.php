<?php

namespace App\Http\Livewire;

use Stripe;
use Stripe\Charge;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Coach;
use App\Models\Payment;
use App\Models\Zipcode;
use Livewire\Component;
use App\Models\Category;
use App\Models\CostByTeam;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public $payment_record;
    public $pages = [];
    public $k;
    public $categories;
    public $values = array();
    public $quantity_teams = array();
    public $imports = array();
    public $categoriesIds = array();

    public $total_teams = 0;
    public $fullname;
    public $email;
    public $password;
    public $password_confirmation;
    public $category_id;

    protected $listeners = ['create_Teamcategory'];

    public function mount() {
        $this->categories = Category::all();
        $i=1;
        foreach($this->categories as $category) {
            $this->categoriesIds[$i] = $category->id;
            $i++;
        }

        $this->pages = [
            1 => [
                'heading' => __('Galveston Cup Registration System 2022'),

            ],
            2 => [
                'heading' => __('Galveston Cup Registration System 2022'),
            ]
        ];
    }

 /** Validaciones para Eventos, Usuarios, Payments */
    private $validationRules = [
            1 => [
                'quantity_teams' => 'required',
                'price_total'   => 'required',
            ],

            2 => [
                'fullname'  =>  'required',
                'phone'     =>  'required|min:10|max:12|unique:users',
                'email'     =>  'required|unique:users',
                'password'  =>  'required',
                'zipcode'   =>  'required',
            ],
        ];



    public function render() {
        return view('livewire.payments.new_payment');
    }

    public function makepayment(Request $request) {
       /*  Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->charge = null;
        $this->charge = Stripe\Charge::create ([
                "amount" => $request->price_total * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => $request->card_name
        ]); */
        $this->charge = 12;
        if (!is_null($this->charge)) {
            $this->createUser($request);
            $payment_record = $this->create_payment($request);
        } else {
            $this->store_message(__('Error to Process Payment.'));
        }
        return redirect()->route('team-categories');
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

    public function calculateTeams() {
        $this->reset(['price_total', 'total_teams']);
        //TODO recorrer cada categoria
        $i=0;
        foreach ($this->categoriesIds as $categoryId) {
            $i++;
            if(isset($this->quantity_teams[$i])){
                if(!$this->quantity_teams[$i] || $this->quantity_teams[$i]==''){
                    $this->quantity_teams[$i] = 0;
                }
                $this->total_teams = $this->total_teams + $this->quantity_teams[$i];
            } else {
                $this->quantity_teams[$i] = 0;
            }
        }
        if ($this->total_teams) {
            $this->calculate_prices();
        }
    }

    private function calculate_prices() {
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

    private function createUser($request){
        $this->user = User::create([
			'name'      => $request->fullname,
			'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'active'    =>  1,
            'token_register_teams' => bin2hex(random_bytes(20))
        ]);

        $coach = Coach::Create([
            'name'      => $request->fullname,
			'phone'     => $request->phone,
            'user_id'   => $this->user->id
		]);

        $this->user->save();
        $role_record = Role::where('name','coach')->first();
        if($role_record){
            $this->user->roles()->attach($role_record);
        }
    }

    private function create_payment(Request $request) {
        $payment= Payment::create([
            'description'   => $request->fullname,
            'amount'        => $request->price_total,
            'user_id'       => $this->user->id,
            'source'        => $request->total_teams,
        ]);
        $this->create_Teamcategory($request, $this->user->id, $payment);
    }

    public function create_Teamcategory($request, $user, $payment){
        $i=0;
        foreach ($request->categoriesIds as $categoryId => $value) {
            $i++;
            if (isset($request->quantity_teams[$i]) && $request->quantity_teams[$i] > 0) {
                TeamCategory::create([
                    'user_id'     => $user,
                    'category_id' => $value,
                    'payment_id'  => $payment->id,
                    'qty_teams'   => $request->quantity_teams[$i]
                ]);
            }
        }
    }

}
