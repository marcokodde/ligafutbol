<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestController extends Component
{
    public $total=0;

    public function render()
    {
        return view('livewire.test-controller');
    }

    public function sumar(){

        $this->total = $this->total + 1 ;

    }
    public function restar(){
        $this->total = $this->total - 1;

    }
}
