<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterTeams extends Component
{
    public function mount($token=null){
        if(!Auth::user()){
           if(!$token){
               dd('No trae token, está mal la ruta');
           }

        }
        dd($token);

    }

    public function render()
    {
        return view('livewire.register_teams.index');
    }
}


