<?php

namespace App\Http\Livewire;

use Stripe;
use Throwable;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Coach;
use App\Models\Payment;
use App\Models\Zipcode;
use Livewire\Component;
use App\Models\Category;
use App\Models\Promoter;
use App\Models\CostByTeam;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use App\Mail\MailNotification;

use App\Models\EmailNotification;
use Illuminate\Support\Facades\DB;
use App\Models\UserWithoutPayments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Traits\SettingsTrait;

class Payments extends Component
{
    use SettingsTrait;

    public $phone;
    public $price_total = 0;
    public $teams;
    public $amount;
    public $record_id, $record;
    public $user_id;
    public $description;
    public $success;
    public $currentPage = 1;
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
    public $user_without_payment;
    public $error_stripe = null;
    public $promoter_code = null;
    public $has_promoter_code = false;
    public $promoter_id = null;
    public $promoter = null;

    public function mount($promoter_code = null)
    {
        $this->promoter_code = $promoter_code;
        $this->promoter_id  =   null;

        $this->has_promoter_code = is_null($promoter_code) ? false : true;
        if ($this->has_promoter_code) {
            $this->promoter = $this->read_code_promoter($promoter_code);
            if ($this->promoter) {
                $this->promoter_id = $this->promoter->id;
            }
        }

        $this->readSettings();
        $this->fill_categories_and_max_allowed();
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
            'phone'     =>  'required|min:7|max:10',
            'email'     =>  'required|email',
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

    // Evaluá y en su caso  envía a donde corresponda

    public function render()
    {
        if ($this->has_promoter_code && !$this->promoter) {
            return view('livewire.payments.error_promoter');
        }
        return view('livewire.payments.new_payment');
    }

    public function makepayment(Request $request)
    {
        if (isset($request->promoter_id)) $this->promoter_id = $request->promoter_id;
        $this->charge = null;
        $this->error_stripe = null;
        $this->user_without_payment = UserWithoutPayments::findOrFail($request->id_user);
        $this->has_promoter_code = is_null($request->promoter_id) ? false : true;
        if ($this->has_promoter_code) {
            $this->promoter_code_id = Promoter::findOrFail($request->promoter_id);
        }
        // Procesar el pago
        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $this->charge = Stripe\Charge::create([
                "amount"        => $request->price_total * 100,
                "currency"      => "USD",
                "source"        => $request->stripeToken,
                "description"   => $request->name,
            ]);

            $this->useradd = User::where('email', $request->email)
                ->where('phone', $request->phone)
                ->first();
            if (!$this->useradd) {
                $this->create_user($request);
            }

            $payment = $this->create_payment($request);

            if ($payment) {
                $this->updateUserTokens($request);
                $this->create_Teamcategory($request, $payment);
                $this->sendMail($request);
                if ($this->user_without_payment) {
                    $this->user_without_payment->delete();   // Si existe en tabla temporal lo elimina
                }

                $this->send_notifications($this->useradd, 'noty_payment', $payment); // Notificación
                if ($this->has_promoter_code) {
                    $this->send_mail_to_promoter($payment);
                }
            }
        } catch (\Throwable $exception) {
            $this->send_notifications($this->user_without_payment, 'noty_without_payment', null, $request->price_total, $request->total_teams);
            $this->error_stripe = $exception->getMessage();
            if ($this->has_promoter_code) {
                return redirect()->route('error', [$this->error_stripe, $this->promoter_code_id->code]);
            } else {
                return redirect()->route('error', [$this->error_stripe]);
            }
        }
        sleep(1);
        return redirect()->route('confirmation');
    }


    public function create_user($request)
    {
        $this->useradd = User::updateOrCreate(['id' => $this->record_id], [
            'name'      => $this->user_without_payment->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password)
        ]);
        $coach = Coach::create([
            'name'      => $this->useradd->name,
            'phone'     => $this->useradd->phone,
            'user_id'   => $this->useradd->id
        ]);

        $role_record = Role::where('name', 'coach')->first();
        if ($role_record) {
            $this->useradd->roles()->attach($role_record);
        }
    }

    public function create_payment($request)
    {
        if ($this->has_promoter_code) {
            $promoter_id = $request->promoter_id;
        } else {
            $promoter_id = null;
        }
        Payment::create([
            'amount'        => $request->price_total,
            'description'   => $request->name,
            'user_id'       => $this->useradd->id,
            'promoter_id'   => $promoter_id,
            'source'        => $request->total_teams
        ]);
    }

    /** Funciones para multi steps */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->validationRules[$this->currentPage]);
    }

    public function goToNextPage()
    {
        $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToNextPage_and_create_user_without()
    {
        $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;

        $this->user_without_payment = User::where('email', $this->email)
            ->where('phone', $this->phone)
            ->first();

        if (!$this->user_without_payment) {
            $this->user_without_payment = UserWithoutPayments::where('email', $this->email)->where('phone', $this->phone)->first();
        }

        if ($this->user_without_payment) {
            $this->user_without_payment->update_Name($this->fullname);
        } else {
            $this->create_user_without_payment();
            //$this->send_notifications($this->user_without_payment,'noty_create_user');
        }
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }


    /** Graba registro en tabla de Usuarios Sin pagos */
    public function create_user_without_payment()
    {
        $this->validate([
            'fullname'  =>  'required|min:3|max:50',
            'phone'     =>  'required|min:7|max:10',
            'email'     =>  'required|email',
        ]);

        $this->user_without_payment =  UserWithoutPayments::create([
            'name'      => $this->fullname,
            'email'     => $this->email,
            'phone'     => $this->phone,
        ]);
    }

    public function resetSuccess()
    {
        $this->reset('success');
    }

    // Cuenta y calcula el total de equipos
    public function countTeams()
    {
        $this->reset(['price_total', 'total_teams']);

        for ($i = 0; $i <= count($this->quantity_teams); $i++) {

            if (isset($this->quantity_teams[$i])) {

                if (isset($this->max_by_category[$i])) {
                    if ($this->quantity_teams[$i] > $this->max_by_category[$i]) {
                        $this->quantity_teams[$i] = $this->max_by_category[$i];
                    }
                } else {
                    if ($this->quantity_teams[$i] > $this->general_settings->max_teams_by_category) {
                        $this->quantity_teams[$i] = $this->general_settings->max_teams_by_category;
                    }
                }

                if (!$this->quantity_teams[$i] || $this->quantity_teams[$i] == '') {
                    $this->quantity_teams[$i] = null;
                }
                $this->total_teams = $this->total_teams + $this->quantity_teams[$i];
            }
        }
        if ($this->total_teams) {
            $this->calculate_prices();
        }
    }

    private function calculate_prices()
    {
        if ($this->total_teams) {
            $sql = "SELECT cost FROM cost_by_teams WHERE " . $this->total_teams . ' BETWEEN min AND max';
            $this->records = DB::select($sql);
            if ($this->records) {
                foreach ($this->records as $record) {
                    $this->price_total = round($this->total_teams * $record->cost, 2);
                }
            }
        }
    }

    public function updateUserTokens($request)
    {
        $this->useradd->update_token_register_teams();
        $this->useradd->update_token_register_players();
    }

    public function create_Teamcategory($request, $payment)
    {
        $i = 0;
        foreach ($request->categoriesIds as $categoryId => $value) {
            if (isset($request->quantity_teams[$i]) && $request->quantity_teams[$i] > 0) {
                TeamCategory::create([
                    'user_id'     =>  $this->useradd->id,
                    'category_id' => $value,
                    'payment_id'  => $payment->id,
                    'qty_teams'   => $request->quantity_teams[$i]
                ]);
            }
            $i++;
        }
    }

    // Correo al usuario de confirmación
    public function sendMail($request)
    {
        $email          =  $this->useradd->email;
        $total          =  $request->price_total;
        $total_teams    =  $request->total_teams;
        $token          =  $this->useradd->token_register_teams;
        $token_player   =  $this->useradd->token_register_players;
        return Mail::to($email)
            ->send(new ConfirmationMail($email, $total, $total_teams, $token, $token_player));
    }

    /** Ve que categorías tienen disponbilidad de equipos y calcula el máximo */
    private function fill_categories_and_max_allowed()
    {
        $this->filter_categories();
        $this->read_categories();

        // Llena arreglo para la vista
        $i = 0;
        foreach ($this->categories as $record) {
            $this->categoriesIds[$i] = $record->id;
            $i++;
        }

        // Llena array de cantidades
        $i = 0;

        foreach ($this->categories as $record) {
            $this->quantity_teams[$i] = '';
            $i++;
        }
    }

    // Cuenta equipos por categoría y agrega a array las que tengan disponbilidad
    private function filter_categories()
    {
        // Primero
        $teams_by_category = TeamCategory::groupBy('category_id')
            ->select('category_id')
            ->selectRaw('sum(qty_teams) as teams')
            ->orderby('category_id')
            ->get();

        if ($teams_by_category) {
            $i = 0;
            foreach ($teams_by_category as $team_by_category) {
                if ($team_by_category->teams < $this->general_settings->max_teams_by_category) {
                    $this->categoriesIds[$i] = $team_by_category->category_id;
                    $this->max_by_category[$i] = $this->general_settings->max_teams_by_category - $team_by_category->teams;
                    $i++;
                }
            }
        }
    }

    private function read_categories()
    {
        $this->categories = Category::whereIn('id', $this->categoriesIds)
            ->OrwhereDoesntHave('teams_categories')
            ->get();
    }


    /** Envío de notificación a Email Notifications */
    public function send_notifications($user, $type = 'noty_create_user', Payment $payment = null, $amount = null, $total_teams = null)
    {
        switch ($type) {
            case 'noty_create_user':
                $users_to_notify = EmailNotification::where('noty_create_user', 1)->get();
                break;
            case 'noty_payment':
                $users_to_notify = EmailNotification::where('noty_payment', 1)->get();
                break;
            case 'noty_without_payment':
                $users_to_notify = EmailNotification::where('noty_without_payment', 1)->get();
                break;
        }
        if (!is_null($this->promoter_id)) {
            $promoter = Promoter::findOrFail($this->promoter_id);
        } else {
            $promoter = null;
        }

        if ($users_to_notify->count()) {
            foreach ($users_to_notify as $user_to_notify) {
                Mail::to($user_to_notify->email)
                    ->send(new MailNotification(
                        $user_to_notify->email,
                        $type,
                        $payment,
                        $user,
                        $amount,
                        $total_teams,
                        $this->error_stripe,
                        $promoter
                    ));
            }
        }
    }

    public function send_mail_to_promoter($payment)
    {
        Mail::to($this->promoter_code_id->email)
            ->send(new MailNotification(
                $this->promoter_code_id->email,
                "noty_payment",
                $payment,
                $this->useradd,
                null,
                null,
                null,
                $this->promoter_code_id
            ));
    }

    public function read_code_promoter($promoter_code)
    {
        return Promoter::where('code', $promoter_code)->first();
    }
}