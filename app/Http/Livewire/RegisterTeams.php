<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterTeams extends Component
{
    public function mount($token = null)
    {
        if (!Auth::user()) {
            if (!$token) {
                dd('No trae token, está mal la ruta');
            }
        }

        dd('Del usuario ' . $this->user->name . ' Hay ' . $this->teams_category_user->count());
    }

    public function render()
    {
        return view('livewire.register_teams.index');
    }
}
