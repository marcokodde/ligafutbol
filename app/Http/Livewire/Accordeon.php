<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Board;

class Accordeon extends Component
{
    use CrudTrait;
    public $boards;

    protected $listeners = ['exceptionError'];

    public function exceptionError($error)
    {
        $this->error_exception = $error;
        dd($this->error_exception);
    }

    public function render()
    {
        return view('livewire.payments.error_stripe');
    }
}
