<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionAnswers extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public $question;
    public $answer;
    protected $listeners = ['destroy'];

    public function mount(){
        //$this->authorize('hasaccess', 'questionanswer.index');
        $this->manage_title = __('Manage') . ' ' . __('Questions');
      //  $this->search_label = Null;
      //   $this->view_search = Null;
        $this->view_form    = 'livewire.questionanswer.form';
        $this->view_table   = 'livewire.questionanswer.table';
        $this->view_list    = 'livewire.questionanswer.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {

        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Question')
                                                        : __('Create') . ' ' . __('Question');
        $searchTerm = '%' . $this->search . '%';


        return view('livewire.index', [
            'records' => QuestionAnswer::Question($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['question','answer']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

        $this->validate([
            'question'  => 'required',
            'answer'    => 'required',
        ]);

		QuestionAnswer::updateOrCreate(['id' => $this->record_id], [
            'question'   => $this->question,
			'answer'   => $this->answer
		]);

        $this->create_button_label = __('Create') . ' ' . __('Question');
        $this->store_message(__('Question'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(QuestionAnswer $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Question');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->question     = $record->question;
		$this->answer       = $record->answer;
		$this->openModal();
	}

    /*+------------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(QuestionAnswer $record) {
        $this->delete_record($record,__('Question') . ' ' . __('Deleted Successfully!!'));
    }
}
