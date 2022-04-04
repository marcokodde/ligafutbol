<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Board;

class Accordeon extends Component
{
    use CrudTrait;
    public $boards;

    public function mount(){
        $this->manage_title = "Ejemplo Acordeon";
        $this->boards = Board::orderBy('title')->wherehas('groups')->get();
    }
    public function render()
    {
        return view('livewire.accordeon');
    }
}
