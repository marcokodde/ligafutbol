<div>
    <div class="sm:px-0 mx-auto text-center items-center -mt-12">
        <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">
        <h3 class="block mt-1 lg:text-2xl sm:text-base font-semibold leading-6 text-gray-600 p-4 uppercase text-center items-center font-pop">
            {{__("Add players to rosters")}}
        </h3>
    </div>
    <hr class="border-2 border-gray-500">
    <br>
    @include('livewire.register_players.select_category_and_team')
</div>
<div class="relative text-sm font-medium leading-6">
    <div class="flex gap-2 justify-center items-center">
        <div class="relative justify-center items-center mx-auto">
            @if($team_id)
                @if($team->players->count() < $general_settings->max_players_by_team )
                    @livewire('add-player',['team' => $this->team,'user' => $user])
                @endif
            @endif
        </div>
    </div>
</div>
<br>
<div class="relative text-sm font-medium leading-6">
    <div class="flex gap-2 justify-center items-center">
        <div class="relative bg-sky-400/20 border border-sky-700/10 justify-center items-center mx-auto">
            @if($team_id)
                @if($team->players->count() > 0)
                    @livewire('show-players-team',['team' => $this->team])
                @endif
            @endif
        </div>
    </div>
</div>