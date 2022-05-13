<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestController extends Component
{
    public $total=0;
    public $short_months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    public $large_months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    PUBLIC $days_by_month= [31,28,31,30,31,30,31,31,30,31,30,31];


    public $day,$month,$year;
    public function render()
    {
        return view('livewire.test-controller');
    }


}
