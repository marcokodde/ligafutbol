<?php

namespace App\Http\Livewire;

use Stripe;
use Throwable;
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
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Traits\SettingsTrait;

class Payments extends Component
{
    use SettingsTrait;

    public $phone;
    public $price_total=0;
    public $teams;
    public $number;
    public $amount;
    public $state;
    public $record_id,$record;
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
    public $max_by_category = array();
    public $records;
    public $total_teams = 0;
    public $fullname;
    public $email;
    public $password;
    public $password_confirmation;
    public $category_id;
    public $useradd;
    public $error_stripe;

    protected $listeners = ['AddUser'];

    public function mount() {
        $this->readSettings();
        $this->fill_categories_and_max_allowed();
        //dd('Categorieas',$this->categories,'Ids Categorías',$this->categoriesIds,'Equipos máximo x Categoria',$this->max_by_category);
        $this->step = 0;
        $this->pages = [
            1 => [
                'heading' => __('Galveston Cup Registration System 2022'),

            ],
            2 => [
                'heading' => __('Galveston Cup Registration System 2022'),
            ],
            3 => [
                'heading' => __('Galveston Cup Registration System 2022'),
            ]
        ];
    }

 /** Validaciones para Eventos, Usuarios, Payments */
    private $validationRules = [
            1 => [
                'fullname'  =>  'required',
                'phone'     =>  'required|min:7|max:10|unique:users',
                'email'     =>  'required|unique:users',
            ],
            2 => [
                'quantity_teams' => 'required',
                'price_total'   => 'required',
            ],
            3 => [
                'password'  =>  'nullable|min:6',
                "password_confirmation" => "nullable|min:6|max:50|same:password",
            ],
        ];



    public function render() {
        return view('livewire.payments.new_payment');
    }

    public function makepayment(Request $request) {
        $this->charge = null;
        $this->error_stripe = null;
        $this->read_user($request);
        if ($this->user) {
            $this->user->update_password($request->password);
            // Procesa el pago
            try {

                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $this->charge = Stripe\Charge::create([
                        "amount" => $request->price_total * 100,
                        "currency" => "USD",
                        "source" => $request->stripeToken,
                        "description" => $request->name,
                ]);

                $this->updateUserTokens($request);
                $this->create_payment($request);
                $this->sendMail($request);

            } catch (\Throwable $exception) {
                $this->error_stripe = $exception->getMessage();
                return redirect()->route('error', [$this->error_stripe]);
            }
        }
        sleep(1);
        return redirect()->route('confirmation');
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

    public function resetSuccess() {
        $this->reset('success');
    }

    // Cuenta y calcula el total de equipos
    public function countTeams() {
        $this->reset(['price_total', 'total_teams']);

        for($i=0;$i<=count($this->quantity_teams);$i++) {

            if (isset($this->quantity_teams[$i])) {

                if(isset($this->max_by_category[$i])){
                    if($this->quantity_teams[$i] > $this->max_by_category[$i]){
                        $this->quantity_teams[$i] = $this->max_by_category[$i];
                    }
                }else{
                    if($this->quantity_teams[$i] > $this->general_settings->max_teams_by_category){
                        $this->quantity_teams[$i] = $this->general_settings->max_teams_by_category;
                    }
                }

                if(!$this->quantity_teams[$i] || $this->quantity_teams[$i]=='') {
                    $this->quantity_teams[$i] = null;
                }
                $this->total_teams = $this->total_teams + $this->quantity_teams[$i];
            }
        }
        if ($this->total_teams) {
            $this->calculate_prices();
        }
    }

    private function calculate_prices() {
        if($this->total_teams){
            $sql ="SELECT cost FROM cost_by_teams WHERE " . $this->total_teams . ' BETWEEN min AND max';
            $this->records = DB::select($sql);
            if ($this->records) {
                foreach ($this->records as $record) {
                    $this->price_total = round($this->total_teams * $record->cost, 2);
                }
            }
        }
    }

    public function AddUser() {
        $this->validate([
            'fullname'  =>  'required|min:3|max:50',
            'phone'     =>  'required|unique:users',
            'email'     =>  'required|unique:users',
		]);

        $this->useradd = User::updateOrCreate(['id' => $this->record_id], [
			'name'      => $this->fullname,
			'email'     => $this->email,
            'phone'     => $this->phone,
            'password' => $this->phone,
        ]);
        $coach = Coach::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->fullname,
			'phone'     => $this->phone,
            'user_id'   => $this->useradd->id
		]);

        $role_record = Role::where('name','coach')->first();
        if($role_record){
            $this->useradd->roles()->attach($role_record);
        }
    }


    // Lee el usuario

    private function read_user($request){
        $this->user = User::findOrFail( $request->id_user);
    }

    private function updateUserTokens($request){
        $this->user->update_token_register_teams();
        $this->user->update_token_register_players();
    }

    private function create_payment(Request $request) {
        $payment= Payment::create([
            'description'   => $request->name,
            'amount'        => $request->price_total,
            'user_id'       => $request->id_user,
            'source'        => $request->total_teams,
        ]);
        $this->create_Teamcategory($request, $payment);
    }

    public function create_Teamcategory($request, $payment){
        $i=0;
        foreach ($request->categoriesIds as $categoryId => $value) {
              if (isset($request->quantity_teams[$i]) && $request->quantity_teams[$i] > 0) {
                TeamCategory::create([
                    'user_id'     => $request->id_user,
                    'category_id' => $value,
                    'payment_id'  => $payment->id,
                    'qty_teams'   => $request->quantity_teams[$i]
                ]);
            }
            $i++;
        }
    }

    public function sendMail($request) {

        $email      = $this->user->email;
        $total      = $request->price_total;
        $total_teams=$request->total_teams;
        $token      =$this->user->token_register_teams;
        $token_player = $this->user->token_register_players;
        return Mail::to($email)
            ->send(new ConfirmationMail
            ($email, $total, $total_teams, $token, $token_player));
    }

    /** Ve que categorías tienen disponbilidad de equipos y calcula el máximo */
    private function fill_categories_and_max_allowed(){
        $this->filter_categories();
        $this->read_categories();

        // Llena arreglo para la vista
        $i=0;
        foreach($this->categories as $record){
            $this->categoriesIds[$i] = $record->id;
            $i++;
        }

        // Llena array de cantidades
        $i=0;

        foreach($this->categories as $record){
            $this->quantity_teams[$i] = '';
            $i++;
        }

    }

    // Cuenta equipos por categoría y agrega a array las que tengan disponbilidad
    private function filter_categories(){
               // Primero
        $teams_by_category = TeamCategory::groupBy('category_id')
                                        ->select('category_id')
                                        ->selectRaw('sum(qty_teams) as teams')
                                        ->orderby('category_id')
                                        ->get();

        if ($teams_by_category) {
            $i=0;
            foreach ($teams_by_category as $team_by_category) {
                if ($team_by_category->teams < $this->general_settings->max_teams_by_category) {
                    $this->categoriesIds[$i] = $team_by_category->category_id;
                    $this->max_by_category[$i] = $this->general_settings->max_teams_by_category - $team_by_category->teams;
                    $i++;
                }
            }
        }
    }

    private function read_categories(){
        $this->categories = Category::whereIn('id',$this->categoriesIds)
                                    ->OrwhereDoesntHave('teams_categories')
                                    ->get();
    }
}
