<?php

namespace App\Http\Livewire\Traits;

use Carbon\Carbon;



trait DatesTrait {

    public $short_months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    public $large_months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    PUBLIC $days_by_month= [31,28,31,30,31,30,31,31,30,31,30,31];
    public $max_days_by_month;

    public $date_day,$date_month,$date_year;
    public $date_full_date;

    public function createDate(){
        if($this->date_day && $this->date_month && $this->date_year){
            $this->date_full_date = $this->date_year . '-' . $this->date_month . '-' . $this->date_day;
        }
    }

}
