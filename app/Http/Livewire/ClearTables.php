<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Payment;
use Livewire\Component;
use App\Models\PlayerTeam;
use App\Models\TeamCategory;
use Illuminate\Support\Facades\DB;

class ClearTables extends Component
{
    public $is_valid_clear = false;

    public function mount(){

    }

    public function render()
    {
        $this->is_valid_clear = $this->is_valid_clear();
        return view('livewire.clear-tables');
    }

    public function clear_tables(){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        TeamCategory::count() ? TeamCategory::truncate() : '';
        Payment::count() ? Payment::truncate() : '';
        PlayerTeam::count() ? PlayerTeam::truncate() : '';
        Coach::count() ?  Coach::truncate() : '';
        Team::count() ?  Team::truncate() : '';
        Player::count() ? Player::truncate() : '';
        User::where('id','>',3)->count() ? User::where('id','>',3)->delete() : '';
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    private function is_valid_clear(){
        if(TeamCategory::count()) return true;
        if(Payment::count()) return true;
        if(PlayerTeam::count()) return true;
        if(Coach::count()) return true;
        if(Team::count()) return true;
        if(Player::count()) return true;
        if(User::where('id','>',3)->count()) return true;
    }
}
