<div class="container">
    <div class="flex flex-row justify-center items-center gap-4">
        <p class="text-3xl font-bold" >{{__('Coach:') . ' ' . $user->name}}</p>
        @if (!$show_table)
            <span class="mx-4 px-4">
                <a href="http://equipos.galvestoncup.com/register_players/{{$user->token_register_players}}"
                    class="border-red-600  text-red-500 font-bold text-2xl hover:text-red-700 mx-4 px-4 py-2 rounded-lg">
                    {{__('Return')}}
                </a>
            </span>
        @endif
    </div>

    <div class="grid grid-flow-col auto-cols-auto">
        <div>
            @if ($show_table)
                <table class="table">
                    @foreach ($categories as $category_select)
                        <tr>
                            <td class="text-2xl font-bold">{{$category_select->name}}</td>
                            {{--  <td class="text-2xl font-bold">{{$category_select->teams_user($user->id)->count()}}</td>  --}}
                        </tr>
                        @foreach($category_select->teams_user($user->id)->get() as $team_category)
                            <tr>
                                <td><strong>{{$team_category->name}}</strong></td>
                                <td>
                                    @if( $team_category->players->count())
                                        <span class="font-semibold">{{__('Players') . ' ' . $team_category->players->count()}}, </span>
                                    @endif
                                </td>
                                <td>
                                    <a type="button" wire:click="read_team_category({{ $team_category }})"
                                        class="border-blue-500 hover:text-gray-500 cursor-pointer text-blue-700 underline font-bold py-2 px-4 rounded-lg">
                                        <span class="control-label">{{__("Add Roster")}}</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            @endif
        </div>
        <!-- ... -->
        <div>
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

        </div>
    </div>
</div>