<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use App\Traits\UserTrait;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Rounds extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use UserTrait;


    protected $listeners = ['destroy'];
    public $name, $from, $to, $active;
    public $round, $main_record;

    public function mount()
    {
        $this->authorize('hasaccess', 'rounds.index');
        $this->manage_title = __('Manage') . ' ' . __('Rounds');
        $this->search_label = null;
        $this->view_search  = null;
        $this->view_form    = 'livewire.rounds.form';
        $this->view_table   = 'livewire.rounds.table';
        $this->view_list    = 'livewire.rounds.list';
        $this->main_record  = new Round();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render()
    {

        $this->create_button_label = $this->main_record->id ? __('Update') . ' ' . __('Round')
            : __('Create') . ' ' . __('Round');

        return view('livewire.index', [
            'records' => Round::paginate($this->pagination),
        ]);
    }

    private function resetInputFields()
    {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name', 'from', 'to', 'active']);
    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store()
    {
        $this->validate([
            'name'  => 'required',
            'from'  => 'sometimes',
            'to'    => 'sometimes',
            'active' => 'sometimes'
        ]);

        Round::updateOrCreate(['id' => $this->record_id], [
            'name'  => $this->name,
            'from'  => $this->from,
            'to'    => $this->to,
            'active' => $this->active = $this->active ? 1 : 0
        ]);

        $this->create_button_label = __('Create') . ' ' . __('Round');
        $this->store_message(__('Rounds'));
    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Round $record)
    {
        $this->create_button_label = __('Update') . ' ' . __('Round');
        $this->record = $record;
        $this->record_id = $record->id;
        $this->name = $record->name;
        $this->from = $record->from;
        $this->to = $record->to;
        $this->active = $record->active;
        $this->openModal();
    }

    /*+------------------------------+
      | Elimina Registro             |
      +------------------------------+
    */
    public function destroy(Round $record)
    {
        $this->delete_record($record, __('Round') . ' ' . __('Deleted Successfully!!'));
    }
}
