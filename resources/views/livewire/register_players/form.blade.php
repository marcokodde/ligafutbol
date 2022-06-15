<div>
    <div class="sm:px-0 mx-auto text-center items-center -mt-12">
        <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">
    </div>
    @if (!$accept_responsibilities && is_null($user->accept_responsibilities))
        @include('livewire.terms-conditions')
    @endif
    @if (!$next_register_players && is_null($user->accept_responsibilities))
        <div class="mx-auto items-center text-center">
            <label class="flex text-gray-700 justify-start items-start mr-2 mt-4 font-extrabold">
                <div class="bg-white ml-6 border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                    <input type="checkbox" wire:model="accept_responsibilities" wire:change="add_accept_terms()"
                        name="accept_responsibilities" id="accept_responsibilities"
                        class="checkbox"
                    >
                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                </div>
                <p class="text-lg font-extrabold font-pop underline">{{__("I agree to have read the disclaimer")}}</p>
            </label>
        </div>
    @endif

    <div>
        @if ($accept_responsibilities)
            <button wire:click="next_register()"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                {{__("Add players to rosters")}}
            </button>
        @endif
    </div>
    @if ($accept_responsibilities && $next_register_players || isset($user->accept_responsibilities))
    <div>
        <h3 class="block mt-1 lg:text-2xl sm:text-base font-semibold leading-6 text-gray-600 p-4 uppercase text-center items-center font-pop">
            {{__("Add players to rosters")}}
        </h3>
    </div>
    <hr class="border-2 border-gray-500">
        @include('livewire.register_players.select_category_and_team')

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
    @endif
</div>
