<?php

namespace App\Http\Livewire;


use App\Models\Role;
use App\Models\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Traits\CrudTrait;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Users extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name, $email, $password, $phone,$active,$password_confirmation;
    public $roles,$role_id, $token;

    /*+-------------------------+
      | Inicializa Componante   |
      +-------------------------+
    */

	public function mount($token=null) {
        $this->authorize('hasaccess', 'users.index');
        $this->manage_title = __('Manage') . ' ' . __('Users');
        $this->create_button_label = "Create User";
        $this->search_label = "Name or Email";
        $this->view_form = 'livewire.users.form';
        $this->view_table = 'livewire.users.table';
        $this->view_list  = 'livewire.users.list';
        $this->readRoles();
        $this->token = $token;
        if ($this->token == "token") {
            $this->manage_title = __('Coach List');
        }
    }


	/**
	 * Busca y regresa vista con usuarios
	 */

	public function render() {
        $this->pagination = 12;

        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('User')
                                                        : __('Create') . ' ' . __('User');


        if($this->token){
            $records = User::wherehas('roles',function($query){
                $query->where('name','coach');
            })->paginate($this->pagination);
        }

        $searchTerm = '%' . $this->search . '%';
        if ($this->token == "token") {
            return view('livewire.users.show_tokens', [
                'records' => $records,
            ]);
        }

        if ($this->token == "token_list") {
            return view('livewire.users.show_coaches_list', [
                'records' => $records,
            ]);
        }

        if(Auth::user()->IsAdmin()){
            return view('livewire.index', [
                'records' => User::Search($searchTerm)->paginate($this->pagination),
            ]);
        }


	}

    // Lee los roles para SELECT en formulario
    private function readRoles(){
        if(Auth::user()->IsAdmin()){
            $this->roles = Role::orderBy('name')->get();
        }
    }

	/**
	 * Inicializa variables de registro
	 */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','email','password','password_confirmation','role_id','active']);
	}

	/**+------------------------------------+
	 * | Valida - Crea - Actuzliza Usuario  |
	 * +------------------------------------+
	 */

	public function store() {

        $this->validateUser();
        if($this->record_id){
            $user = $this->updateUser();
        }else{
            $user = $this->createUser();
        }
        $this->create_button_label = __('Create') . ' ' . __('User');
        $this->store_message(__('User'));
	}

    /**+----------------+
     * | Validación     |
     * +----------------+
     */
    private function validateUser(){

        $this->validate([
            'name'                  => 'required|min:3|max:50',
            'email'                 => 'required|email|unique:users,email,' . $this->record_id,
            'role_id'               => 'required|exists:roles,id',
            'phone'                 => 'required|min:7|max:12',
            'password'              => 'required|min:6|max:15',
            'password_confirmation' => 'nullable|min:6|max:50|same:password',
		]);
    }
    /**+----------------+
     * | Crear Usuario  |
     * +----------------+
     */

    private function createUser(){
        $user = User::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'password'  => Hash::make($this->password),
            'active'    => $this->active ? 1 : 0,
        ]);
        $user->roles()->sync($this->role_id);
        $user->save();
    }
    /**+-------------------+
     * | Actualizar Usuario  |
     * +---------------------+
     */

    private function updateUser(){
        $user = User::findOrFail($this->record_id);
        $user->update([
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'password'  =>  Hash::make($this->password),
            'active'    => $this->active ? 1 : 0,
        ]);
        $user->roles()->sync($this->role_id);
        $user->save();
        return $user;
    }

	/**
	 * Mueve datos del registro a las variables
	 */

	public function edit(User $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('User');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->email        = $record->email;
        $this->phone        = $record->phone;
        $this->password     = $record->password;
        $this->active       = $record->active;

        foreach($record->roles as $role){
            $this->role_id      = $role->id;
        }
		$this->openModal();
	}
}
