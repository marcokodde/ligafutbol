<?php

namespace App\Http\Livewire\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

trait SettingsTrait {

    // Variables de la configuración

    public $general_settings;
    /** Lee la configuración */
    public function readSettings() {
        $this->general_settings = Setting::first();

	}

}
