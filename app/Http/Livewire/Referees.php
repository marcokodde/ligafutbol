<?php

namespace App\Http\Livewire;

use App\Models\User;

use App\Models\Referee;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Referees extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $first_name, $last_name, $birthday, $gender, $phone, $user_id;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Referees');
        $this->search_label = __('Name');
        $this->view_form = 'livewire.referees.form';
        $this->view_table = 'livewire.referees.table';
        $this->view_list  = 'livewire.referees.list';
        $this->view_search  = 'livewire.referees.search';
        $this->allow_create = true;
        $this->pagination = 11;
    }

    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Referee')
            : __('Create') . ' ' . __('Referee');

        $searchTerm = '%' . $this->search . '%';
        /*  if (Auth::user()->IsAdmin()) {
            return view('livewire.index', [
                'records' => Referee::FullName($searchTerm)
                    ->ThisUserId($this->user_id)
                    ->paginate($this->pagination),
            ]);
        } */
        return view('livewire.index', [
            'records' => Referee::Name($searchTerm)->paginate($this->pagination),
        ]);
    }

    /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

    private function resetInputFields()
    {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['first_name', 'last_name', 'birthday', 'gender', 'phone']);
    }

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {

        $this->validate([
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'birthday'  => 'required',
            'gender'    => 'required|in:Female,Male',
            'phone'     => 'sometimes'
        ]);

        Referee::updateOrCreate(['id' => $this->record_id], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birthday'  => $this->birthday,
            'gender'    => $this->gender,
            'phone'    => $this->phone,
            'user_id'   => Auth::user()->id
        ]);

        $this->create_button_label = __('Create') . ' ' . __('Referee');
        $this->store_message(__('Referee'));
    }

    /*+------------------------------+
	  | Lee Registro Editar o Borar  |
	 +-------------------------------+
    */

    public function edit(Referee $record)
    {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Referee');
        $this->record       = $record;
        $this->record_id    = $record->id;
        $this->first_name   = $record->first_name;
        $this->last_name    = $record->last_name;
        $this->birthday     = $record->birthday;
        $this->gender       = $record->gender;
        $this->phone        = $record->phone;
        $this->openModal();
    }

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
    public function destroy(Referee $record)
    {
        $this->delete_record($record, __('Referee') . ' ' . __('Deleted Successfully!!'));
    }
}
