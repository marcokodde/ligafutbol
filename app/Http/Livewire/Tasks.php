<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Group;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Task;

use App\Models\User;

use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Tasks extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    protected $listeners = ['destroy'];


    public $group_id, $user_require_id, $user_responsible_id, $status_id, $type_task_id, $priority_id, $deadline, $title, $description;
    public $boards, $board_id;
    public $groups;
    public $users;
    public $statuses;
    public $task_types;
    public $priorities;
    public $channels;
    public $clients;
    public $client_id, $channel_id;

    public function mount()
    {
        $this->manage_title = __('Manage') . ' ' . __('Tasks');
        $this->search_label = "Task Name";
        $this->view_form    = 'livewire.tasks.form';
        $this->view_table   = 'livewire.tasks.table';
        $this->view_list    = 'livewire.tasks.list';
        $this->fill_combos();
    }

    /** Llena combos */
    private function fill_combos()
    {
        $this->boards       = Board::wherehas('groups')->get;
        $this->task_types   = TaskType::all();
        $this->users        = User::all();
        $this->statuses     = Status::all();
        $this->priorities   = Priority::all();
        $this->clients      = Client::all();
        $this->channels     = Channel::all();

        // dd($this->task_types,$this->users,$this->statuses,$this->priorities);
    }

    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

    public function render()
    {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Task')
            : __('Create') . ' ' . __('Task');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Task::Title($searchTerm)->paginate($this->pagination),
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
        $this->reset(['group_id', 'user_require_id', 'user_responsible_id', 'status_id', 'type_task_id', 'priority_id', 'client_id', 'channel_id', 'deadline', 'title', 'description']);
    }


    /*+-------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

    public function store()
    {

        $this->validate([
            'group_id'              => 'required|not_in:Elegir|not_in:Choose|exists:groups,id',
            'user_require_id'       => 'required|not_in:Elegir|not_in:Choose|exists:users,id',
            'user_responsible_id'   => 'required|not_in:Elegir|not_in:Choose|exists:users,id',
            'status_id'             => 'required|not_in:Elegir|not_in:Choose|exists:statuses,id',
            'type_task_id'          => 'required|not_in:Elegir|not_in:Choose|exists:task_types,id',
            'priority_id'           => 'required|not_in:Elegir|not_in:Choose|exists:priorities,id',
            'client_id'             => 'required|not_in:Elegir|not_in:Choose|exists:clients,id',
            'channel_id'            => 'required|not_in:Elegir|not_in:Choose|exists:channels,id',
            'deadline'              => 'required',
            'title'                 => 'required',
            'description'           => 'required',
        ]);

        Task::updateOrCreate(['id' => $this->record_id], [
            'group_id'              => $this->group_id,
            'user_require_id'       => $this->user_require_id,
            'user_responsible_id'   => $this->user_responsible_id,
            'user_created_by_id'    => Auth::user()->id,
            'user_take_over_id'     => Auth::user()->id,
            'status_id'             => $this->status_id,
            'type_task_id'          => $this->type_task_id,
            'priority_id'           => $this->priority_id,
            'client_id'             => $this->client_id,
            'channel_id'            => $this->channel_id,
            'deadline'              => $this->deadline,
            'title'                 => $this->title,
            'description'           => $this->description,

        ]);

        $this->create_button_label = __('Create') . ' ' . __('Task');
        $this->store_message(__('Task'));
    }

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

    public function edit(Task $record)
    {
        $this->resetInputFields();
        $this->create_button_label  = __('Update') . ' ' . __('Task');
        $this->record               = $record;
        $this->record_id            = $record->id;
        $this->group_id             = $record->group_id;
        $this->user_require_id      = $record->user_require_id;
        $this->user_responsible_id  = $record->user_responsible_id;
        $this->status_id            = $record->status_id;
        $this->type_task_id         = $record->type_task_id;
        $this->priority_id          = $record->priority_id;
        $this->client_id            = $record->client_id;
        $this->channel_id           = $record->channel_id;
        $this->user_take_over_id    = $record->user_take_over_id;
        $this->deadline             = $record->deadline;
        $this->title                = $record->title;
        $this->description          = $record->description;
        $this->openModal();
    }

    /*+------------------------------+
	  | Elimina Registro             |
	  +------------------------------+
	 */
    public function destroy(Task $record)
    {
        $this->delete_record($record, __('Task') . ' ' . __('Deleted Successfully!!'));
    }

    /*+-------------------------------+
	  | Llena lista de grupos        |
	  +------------------------------+
    */
    public function fill_groups()
    {
        $this->reset(['groups']);

        if ($this->board_id) {
            $board_record = Board::findOrFail($this->board_id);
            if ($board_record) {
                $this->groups = $board_record->groups;
            }
        }
        dd($this->groups);
    }


    /** Valores para el store */
    private function show_values_to_store()
    {
        dd(
            'group_id'              . '= ' .  $this->group_id,
            'user_require_id'       . '= ' .  $this->user_require_id,
            'user_responsible_id'   . '= ' .  $this->user_responsible_id,
            'status_id'             . '= ' .  $this->status_id,
            'type_task_id'          . '= ' .  $this->type_task_id,
            'priority_id'           . '= ' .  $this->priority_id,
            'deadline'              . '= ' .  $this->deadline,
            'title'                 . '= ' .  $this->title,
            'description'           . '= ' .  $this->description
        );
    }
}
