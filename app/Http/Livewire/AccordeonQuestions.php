<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\QuestionAnswer;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccordeonQuestions extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    public function mount() {
        $this->manage_title = "FREQUENTLY ASKED QUESTIONS GALVESTON CUP 2022";
        $this->search_label = __('Search Question');
       // $this->view_search = Null;
        $this->paginat = 10;
    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        return view('livewire.questionanswer.accordeon_questions', [
            'records' => QuestionAnswer::Question($searchTerm)->paginate($this->paginat)
        ]);
    }
}
