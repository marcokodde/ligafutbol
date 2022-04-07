<?php

namespace App\Http\Livewire;

use App\Excellsus\Models\Role;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;


class Users extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $name, $email, $password, $phone,$active,$password_confirmation;
    public $roles,$role_id;

    /*+-------------------------+
      | Inicializa Componante   |
      +-------------------------+
    */

	public function mount() {
        $this->authorize('hasaccess', 'users.index');
        $this->manage_title = __('Manage') . ' ' . __('Users');
        $this->create_button_label = "Create User";
        $this->search_label = "Name or Email";
        $this->readRoles();
    }

    // Lee los roles para SELECT en formulario
    private function readRoles(){
        if(Auth::user()->IsAdmin()){
            $this->roles = Role::orderBy('name')->get();
        }
    }

	/**
	 * Busca y regresa vista con usuarios
	 */

	public function render() {
        $searchTerm = '%' . $this->search . '%';

        if(Auth::user()->IsAdmin()){
            return view('livewire.index', [
                'records' => User::Search($searchTerm)->paginate($this->pagination),
            ]);
        }


	}

	/**
	 * Inicializa variables de registro
	 */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name','email','phone','password','active']);
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
            'phone'                 => 'required|max:15',
            'password_confirmation' =>'required_with:password'
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
            'active'    =>$this->active ? 1 : 0,
        ]);
        $user->roles()->sync($this->role_id);

        $user->save();
        return $user;
    }
    /**+-------------------+
     * | Actualizar Usuario  |
     * +---------------------+
     */

    private function updateUser(){
        $user = User::findOrFail($this->record_id);
        $user->update([
            'name'  => $this->name,
            'email' => $this->email,
            'phone'  => $this->phone,
            'active' => $$this->active ? 1 : 0,
        ]);

        if($this->password){
            $user->update([
                'password' => Hash::make($this->password),
            ]);
        }
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
        $this->active       = $record->active;
        $this->role_id      = $record->user_role_id();
		$this->openModal();

	}

}
