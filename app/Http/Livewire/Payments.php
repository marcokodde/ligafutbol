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
    public $apply_coupon = false;
    public $key_to_coupon = null;
    public $coupon_applied = false;
    public $amount_with_coupon = 0;
    public $new_user = false;
    public $user = null;
    public $same_phone_and_email = true;
    public $accept_terms;
    public $discount_by_team = 0;

    public function mount($promoter_code = null)
    {
        $this->promoter_code = $promoter_code;
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
            'phone'     =>  'required|unique:users|digits_between:7,10',
            'email'     =>  'required|unique:users',
        ],
        2 => [
            'quantity_teams' => 'required',
            'price_total'   => 'required',
        ],
        3 => [
            'password'  =>  'nullable|min:6',
            "password_confirmation" => "nullable|min:6|max:50|same:password",
        ]
    ];

    // Evaluá y en su caso  envía a donde corresponda
    public function render()
    {
        if ($this->has_promoter_code && !$this->promoter) {
            return view('livewire.payments.error_promoter');
        }
        return view('livewire.payments.new_payment');
    }


    /** Procesa el pago */
    public function makepayment(Request $request)
    {

        if (isset($request->promoter_id)) $this->promoter_id = $request->promoter_id;
        $procesado = false;
        $this->charge = null;
        $this->error_stripe = null;
        $this->user_without_payment = null;
        $this->has_promoter_code = null;
        $this->promoter_code_id = null;

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
            // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // $this->charge = Stripe\Charge::create([
            //         "amount"        => $request->price_total * 100,
            //         "currency"      => "USD",
            //         "source"        => $request->stripeToken,
            //         "description"   => $request->name,
            // ]);

            if ($this->charge) {
                if ($request->new_user) {
                    $this->useradd =  $this->create_user($request->password);
                    $this->create_coach($this->useradd);
                    $this->assign_coach_role($this->useradd);
                } else {
                    $this->useradd = User::findOrFail($request->user_id);
                    $this->user_without_payment = UserWithoutPayments::where('email', $this->useradd)
                        ->where('phone', $this->useradd)
                        ->first();
                }
                $payment = null;
                if (!$procesado) {
                    $payment = $this->create_payment(
                        $this->useradd,
                        $request->name,
                        $request->price_total,
                        $request->total_teams,
                        $request->promoter_id
                    );
                }
            }

            if ($payment) {
                $this->updateUserTokens();
                $this->create_Teamcategory($request, $payment);
                $this->sendMail($request);
                $this->user_without_payment->delete();                              // Se elimina de usuarios sin pago
                $this->send_notifications($this->useradd, 'noty_payment', $payment); // Notificación
                if ($this->has_promoter_code) {
                    $this->send_mail_to_promoter($payment);
                    if ($payment) {

                        $this->updateUserTokens($this->useradd);
                        $this->create_Teamcategory($this->useradd, $payment, $request);

                        $this->user_without_payment = UserWithoutPayments::where('email', $this->useradd->email)
                            ->where('phone', $this->useradd->phone)
                            ->first();
                        if ($this->user_without_payment) {
                            $this->user_without_payment->delete();                              // Se elimina de usuarios sin pago
                        }

                        $this->send_Mail_Confirmation($this->useradd, $request->price_total, $request->total_teams);

                        $this->send_notifications($this->useradd, 'noty_payment', $payment);      // Notificaciónes
                        $this->send_Mail_Confirmation($request);

                        $this->send_notifications($this->useradd, 'noty_payment', $payment); // Notificación

                        if ($this->has_promoter_code) {
                            $this->send_mail_to_promoter($payment);
                        }

                        $procesado = true;

                        return redirect()->route('confirmation');
                    }
                }
            }
        } catch (\Throwable $exception) {
            $this->send_notifications($this->user_without_payment, 'noty_without_payment', null, $request->price_total, $request->total_teams);
            //$this->send_notifications($this->user_without_payment,'noty_without_payment',null,$request->price_total,$request->total_teams);
            $this->send_notifications($this->user_without_payment, 'noty_without_payment', null, $request->price_total, $request->total_teams);
            $this->error_stripe = $exception->getMessage();
            if ($this->has_promoter_code) {
                return redirect()->route('error', [$this->error_stripe, $this->promoter_code_id->code]);
            } else {
                return redirect()->route('error', [$this->error_stripe]);
            }
        }
    }
    /** Valida Teléfono y correo */
    public function validate_phone_and_email()
    {
        $this->same_phone_and_email = false;

        if ($this->phone && $this->email) {

            $this->user = User::where('phone', $this->phone)
                ->orWhere('email', $this->email)->first();

            $this->same_phone_and_email = !$this->user;

            if ($this->user && $this->user->phone == $this->phone && $this->user->email == $this->email)
                $this->same_phone_and_email = true;
        }
    }


    /** Graba registro en tabla de Usuarios Sin pagos */
    public function create_user_without_payment()
    {

        $this->validate([
            'fullname'  =>  'required|min:3|max:50',
            'phone'     =>  'required|digits_between:7,10',
            'email'     =>  'required',
        ]);

        if ($exist_user_whithout_payment > 0) {
            UserWithoutPayments::where('email', $this->email)
                ->where('phone', $this->phone)
                ->update([
                    'name'  => $this->fullname,
                    'email' => $this->email,
                    'phone' => $this->phone
                ]);
            $this->user_without_payment = UserWithoutPayments::where('email', $this->email)->where('phone', $this->phone)->first();
        } else {
            $this->user_without_payment = UserWithoutPayments::create([
                'name'      => $this->fullname,
                'email'     => $this->email,
                'phone'     => $this->phone,
            ]);
            //Creacion de Notificacion cuando se creo un usuario.
            $this->send_notifications($this->user_without_payment, 'noty_create_user');
        }
        // Inicializa todo lo del cupón
        if ($this->general_settings->active_coupon) $this->reset_coupon();
        // ¿Ya existe el usuario sólo con el teléfono?

        $this->same_phone_and_email = true;

        $this->user = User::where('email', $this->email)->where('phone', $this->phone)->first();

        $this->new_user =  $this->user ? false : true;

        if ($this->user) {
            $this->new_user = false;
        } else {
            $this->new_user = true;
        }

        $exist_user_whithout_payment = UserWithoutPayments::where('email', $this->email)->where('phone', $this->phone)->count();

        if ($exist_user_whithout_payment > 0) {
            UserWithoutPayments::where('email', $this->email)
                ->where('phone', $this->phone)
                ->update([
                    'name'  => $this->fullname,
                    'email' => $this->email,
                    'phone' => $this->phone
                ]);
            $this->user_without_payment = UserWithoutPayments::where('email', $this->email)->where('phone', $this->phone)->first();
        } else {
            $this->user_without_payment = UserWithoutPayments::create([
                'name'      => $this->fullname,
                'email'     => $this->email,
                'phone'     => $this->phone,
            ]);
            //Creacion de Notificacion cuando se creo un usuario.
            $this->send_notifications($this->user_without_payment, 'noty_create_user');
        }
        if (!$this->user) {
            $this->user = $this->user_without_payment;
        }

        // Inicializa todo lo del cupón
        if ($this->general_settings->active_coupon) $this->reset_coupon();
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
        $this->create_user_without_payment();
    }

    private function reset_coupon()
    {
        $this->reset([
            'apply_coupon',
            'key_to_coupon',
            'coupon_applied',
            'amount_with_coupon',
        ]);
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
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
                    $this->apply_coupon($this->total_teams);
                }
            }
        }
    }

    private function create_user($request)
    {

        $this->useradd = User::Create([
            'name'      => $this->user_without_payment->name,
            'email'     => $this->user_without_payment->email,
            'phone'     => $this->user_without_payment->phone,
            'password'  => Hash::make($request->password)
        ]);

        $coach = Coach::create([
            'name'      => $this->useradd->name,
            'phone'     => $this->useradd->phone,
            'user_id'   => $this->useradd->id
        ]);

        $role_record = Role::where('name', 'coach')->first();
    }


    // Crea el usuario como Coach
    private function create_coach(User $user)
    {
        return Coach::create([
            'name'      => $user->name,
            'phone'     => $user->phone,
            'user_id'   => $user->id
        ]);
    }

    // Asigna rol de coach al usuario
    private function assign_coach_role(User $user)
    {
        $role_record = Role::where('name', 'coach')->first();
        if ($role_record) {
            $user->roles()->attach($role_record);
        }
    }


    // Actualiza Tokens del usuario
    public function updateUserTokens(User $user)
    {
        $user->update_token_register_teams();
        $user->update_token_register_players();
    }

    // Crea el pago
    private function create_payment(User $user, $name, $amount, $total_teams, $promoter_id = null)
    {

        return Payment::create([
            'amount'        => $amount,
            'description'   => $name,
            'user_id'       => $user->id,
            'promoter_id'   => $promoter_id,
            'source'        => $total_teams
        ]);
    }

    // Crea equipos x Categoría
    public function create_Teamcategory(User $user, $payment = null, $request = null)
    {
        $i = 0;
        foreach ($request->categoriesIds as $categoryId => $value) {
            if (isset($request->quantity_teams[$i]) && $request->quantity_teams[$i] > 0) {
                TeamCategory::create([
                    'user_id'     =>  $user->id,
                    'category_id' => $value,
                    'payment_id'  => $payment->id,
                    'qty_teams'   => $request->quantity_teams[$i]
                ]);
            }
            if ($this->categoriesIds && $this->quantity_teams) {
                foreach ($this->categoriesIds as $categoryId => $value) {
                    if (isset($this->quantity_teams[$i]) && $this->quantity_teams[$i] > 0) {
                        TeamCategory::create([
                            'user_id'     =>  $user->id,
                            'category_id' => $value,
                            'payment_id'  => null,
                            'qty_teams'   => $this->quantity_teams[$i]
                        ]);
                    }
                    $i++;
                }
            } else {
                foreach ($request->categoriesIds as $categoryId => $value) {
                    if (isset($request->quantity_teams[$i]) && $request->quantity_teams[$i] > 0) {
                        TeamCategory::create([
                            'user_id'     => $user->id,
                            'category_id' => $value,
                            'payment_id'  => $payment->id,
                            'qty_teams'   => $request->quantity_teams[$i]
                        ]);
                    }
                    $i++;
                }
            }
        }
    }

    // Correo al usuario de confirmación

    public function send_Mail_Confirmation(User $user, $total = null, $total_teams = null)
    {

        $email          =  $user->email;
        $token          =  $user->token_register_teams;
        $token_player   =  $user->token_register_players;
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


    public function send_mail_to_promoter($payment = null)
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

    public function validate_key_to_coupon()
    {
        $this->apply_coupon = strtolower(trim($this->key_to_coupon)) == strtolower(trim($this->general_settings->key_to_coupon));
    }

    public function apply_coupon($total_teams)
    {
        $this->coupon_applied = false;
        $this->amount_with_coupon = $this->price_total;
        //TODO: ¿Que método de descuento aplicar?
        if ($this->general_settings->active_coupon && $this->validate_key_to_coupon()) {
            $this->price_total = $this->price_total - $this->calculate_discount($total_teams, 'couppon');
        } else {
            $this->price_total = $this->price_total - $this->calculate_discount($total_teams);
            if ($this->calculate_discount($total_teams) > 0) {
                $this->coupon_applied = true;
            }
        }
    }


    // Importe a descontar del total
    private function calculate_discount($total_teams = 0, $type = 'cost_by_team')
    {

        // Rebajar el costo por equipo
        if ($type = 'cost_by_team') {
            if ($total_teams < 3) {
                $this->discount_by_team = 0;
                return 0;
            }

            if ($total_teams >= 3 && $total_teams <= 5) {
                $this->discount_by_team = 20;
                return 20 * $total_teams;
            }

            $this->discount_by_team = 25;
            return 25 * $total_teams;
        }


        // Importe fijo a descontar según cantidad de equipos
        if ($type = 'couppon') {
            switch ($total_teams) {
                case  1:
                    return 10;
                    break;
                case 2:
                    return 30;
                    break;
                case 3:
                    return 40;
                    break;
                case 4:
                    return 50;
                    break;
                default:
                    return 100;
            }
        }
    }

    // Registro por administración

    public function register_by_admin()
    {
        try {
            if ($this->new_user) {
                $this->useradd = $this->create_user($this->phone);
                $this->create_coach($this->useradd);
                $this->assign_coach_role($this->useradd);
            } else {
                $this->useradd  = User::where('email', $this->email)
                    ->where('phone', $this->phone)
                    ->first();
                $this->user_without_payment  = UserWithoutPayments::where('email', $this->email)
                    ->where('phone', $this->phone)
                    ->first();
            }

            $this->updateUserTokens($this->useradd);
            $this->create_Teamcategory($this->useradd, null, null);

            if ($this->user_without_payment) {
                $this->user_without_payment->delete();   // Se elimina de usuarios sin pago
            }


            $this->send_Mail_Confirmation($this->useradd, $this->price_total, $this->total_teams);

            return redirect()->route('dashboard');
        } catch (\Throwable $exception) {

            $this->send_notifications($this->user_without_payment, 'noty_without_payment', null, $this->price_total, $this->total_teams);
            $this->error = $exception->getMessage();
            return redirect()->route('error', [$this->error]);
        }
    }
}
