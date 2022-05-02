<div>
    <div class="sm:px-0 mx-auto text-center items-center">
        <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">
        <h3 class="lg:text-2xl sm:text-lg font-bold leading-6 text-black p-4 uppercase inline text-center items-center">
            {{__("Select Category and Team")}}
        </h3>
    </div>
    <hr class="border-2 border-gray-500">
</div>

<div class="grid lg:grid-cols-3 lg:gap-4 md:grid-cols-1 md:gap-2 sm:grid-cols-1 sm:gap-1">
    <div></div>
    <div>
        @include('livewire.register_players.select_category_and_team')
        @if($team_id)
            @if($team->players->count() > 0)
                @livewire('show-players-team',['team' => $this->team])
            @endif
        @endif
    </div>
</div>

<div class="relative font-medium mt-4">
    <div class="flex gap-2 justify-center items-center">
        <div class="absolute top-0 mx-auto items-center justify-center">
            @if($team_id)
                @if($team->players->count() < $general_settings->max_players_by_team )
                    @livewire('add-player',['team' => $this->team,'user' => $user])
                @endif
            @endif
        </div>
    </div>
</div>