<?php

namespace App\Http\Livewire\Traits;

use App\Models\Setting;
use App\Models\Zipcode;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

trait ZipcodeTrait {

    // Variables de la configuración
    public $zipcode=null;
    public $town_state = null;
    public $zipcode_exists = false;


    public function read_zipcode() {

        $this->town_state =Null;
        $this->zipcode_exists = false;
        if ($this->zipcode) {
            $zipcode = Zipcode::Zipcode($this->zipcode)->first();
            if ($zipcode) {
                $this->town_state = $zipcode->town . ',' . $zipcode->state;
                $this->zipcode_exists = true;
            } else {
                $this->town_state = __('Zipcode does not Exists');
            }
        }
    }



}
