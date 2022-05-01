<div>
    <div class="mt-5 border-2 border-green-400">
        <div class="sm:px-0 mx-auto text-center items-center">
            <label class="text-center text-2xl font-bold mb-10">
                {{$team->category->name .'-' . $team->name}}
            </label>
        </div>
        <div class="sm:px-0 mx-auto text-center items-center">
            <table>
                <thead>
                    <th>{{__('First Name')}}</th>
                    <th>{{__('Last Name')}}</th>
                    <th>{{__('Gender')}}</th>
                    <th>{{__('Birthday')}}</th>
                </thead>
                @foreach($team->players as $team_player)

                    <tr>
                        <td>{{$team_player->first_name}}</td>
                        <td>{{$team_player->last_name}}</td>
                        <td>{{$team_player->gender}}</td>
                        <td>{{date("F j Y", strtotime($team_player->birthday))}}</td>
                        <td> <button wire:click="removePlayer({{ $team_player->pivot->player_id }})" class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove")}}</button></td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
</div>
