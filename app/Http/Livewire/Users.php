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

    public $name, $email, $password, $active,$password_confirmation;
    public $roles,$role_id,$members,$member_id;
    public $member_auth_user;
    public $show_member = false;
    private $member;

    /*+-------------------------+
      | Inicializa Componante   |
      +-------------------------+
    */
	public function mount() {
        $this->authorize('hasaccess', 'users.index');
        $this->manage_title = "Manage Users";
        $this->create_button_label = "Create User";
        $this->search_label = "Name or Email";
        $this->member = null;
        $this->members = null;
        $this->readRoles();
    }

    // Lee los roles para SELECT en formulario
    private function readRoles(){
        if(Auth::user()->IsAdmin()){
            $this->roles = Role::whereIn('id', [1, 2,3])->get();
        }

        if(Auth::user()->IsManager()){
            $this->roles = Role::whereIn('id', [3,4])->get();
        }
    }

	/**
	 * Busca y regresa vista con usuarios
	 */

	public function render() {
        $searchTerm = '%' . $this->search . '%';

        if(Auth::user()->IsAdmin()){
            return view('livewire.users.index', [
                'records' => User::whereHas('roles', function (Builder $query) {
                    $query->whereIn('role_id', [1,2,3]);
                })->where('name', 'like', $searchTerm)
                ->orderBy('id')
                ->paginate($this->pagination),
            ]);
        }

        $this->review_member();
        if(Auth::user()->IsManager()){
            return view('livewire.users.index', [
                'records' => User::whereHas('roles', function (Builder $query)  {
                    $query->whereIn('role_id', [3,4]);
                })->whereHas('members', function (Builder $query) {
                    $query->where('member_id', '=',$this->member_auth_user->id);
                })->where('name', 'like', $searchTerm)->paginate($this->pagination),
            ]);
        }
	}

	/**
	 * Inicializa variables de registro
	 */

	private function resetInputFields() {
        $this->record_id = '';
		$this->name = '';
        $this->email = '';
        $this->password = '';
        $this->active = false;
        $this->show_member=false;
        $this->members = null;
        $this->record = null;
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

        if($user){
            if($user->isAdmin()){
                $user->members()->sync(null);
            }else{
                $this->enrolMember($user);
            }
        }

        session()->flash('message',
        $this->record_id ? 'User Updated Successfully.' : 'User Created Successfully.');
		$this->closeModal();
		$this->resetInputFields();
	}

    /**+----------------+
     * | Validación     |
     * +----------------+
     */
    private function validateUser(){
        // Administrador
        if(Auth::user()->IsAdmin()){
            if($this->record_id){
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $this->record_id,
                    'role_id' => 'required|exists:roles,id',
                    'password_confirmation' =>'required_with:password',
                    'member_id'=> 'required_if:role_id,3'
                ]);

            }else{
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $this->record_id,
                    'role_id' => 'required|exists:roles,id',
                    'password' => 'required|confirmed',
                    'password_confirmation' =>'required_with:password',
                    'member_id'=> 'required_if:role_id,3'
                ]);
            }
        }
        // Propietario
        if(Auth::user()->isManager()){
            if($this->record_id){
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $this->record_id,
                    'role_id' => 'required|exists:roles,id',
                    'password_confirmation' =>'required_with:password',
                ]);
            }else{
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $this->record_id,
                    'role_id' => 'required|exists:roles,id',
                    'password_confirmation' =>'required_with:password',
                ]);
            }
        }

    }

    /**+----------------+
     * | Crear Usuario  |
     * +----------------+
     */

    private function createUser(){
        $active = $this->active ? 1 : 0;
        $user = User::create([
			'name' => $this->name,
			'email' => $this->email,
            'password' => Hash::make($this->password),
            'active' => $active,
        ]);
        $user->roles()->sync($this->role_id);
        $user->members()->sync($this->member_id);
        $user->save();
        return $user;
    }
    /**+-------------------+
     * | Actualizar Usuario  |
     * +---------------------+
     */

    private function updateUser(){
        $user = User::findOrFail($this->record_id);
        $this->active = $this->active ? 1 : 0;
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active,
        ]);

        if($this->password){
            $user->update([
                'password' => Hash::make($this->password),
            ]);
        }
        $user->roles()->sync($this->role_id);
        $user->members()->sync($this->member_id);
        $user->save();
        return $user;
    }

    /**+--------------------+
     * | Asocia empresa     |
     * +--------------------+
     */

    private function enrolMember(User $user){
        if(Auth::user()->isAdmin() && $this->member_id){
            $user->members()->sync($this->member_id);
        }else{
            $user->members()->sync(Auth::user()->read_member());
        }
    }

	/**
	 * Mueve datos del registro a las variables
	 */

	public function edit($id,$action='edit') {
        $this->resetInputFields();
		$record = User::findOrFail($id);
		$this->record_id = $id;
		$this->name = $record->name;
		$this->email = $record->email;
        $this->active = $record->active;
        $this->role_id = $record->user_role_id();
        $this->member_id = $record->user_member_id();

        if(Auth::user()->IsAdmin() && $this->role_id > 2){
            $this->show_member = true;
            $this->members = Member::where('active','=',1)->get();
        }
        $this->openModal($action);
	}


    /**
     * ¿Mostrar o no compañía?
     */
    public function read_members(){
        $this->show_member = false;
        $this->members = null;
        $this->member_id = Null;
        if(Auth::user()->IsAdmin() && $this->role_id > 2){
                $this->show_member = true;
                $this->members = Member::where('active','=',1)->get();
        }
    }
}