<div class="mt-5 w-auto">
    <div class="sm:px-0 mx-auto text-center items-center">
        <label class="text-center text-2xl font-bold mb-10 sm:text-left">
            {{$team->category->name .'-' . $team->name}}
        </label>
    </div>
    <table class="border-collapse table-auto w-auto text-sm">
        <thead>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-700 text-left sm:text-right font-pop">{{__('First Name')}}</th>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-700 text-left sm:text-right font-pop">{{__('Last Name')}}</th>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-700 text-left sm:text-right font-pop">{{__('Gender')}}</th>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-700 text-left sm:text-right font-pop">{{__('Birthday')}}</th>
        </thead>
        <tbody class="bg-white">
            @foreach($team->players as $team_player)
                <tr>
                    <td class="text-gray-600 text-left sm:text-right font-pop">{{$team_player->first_name}}</td>
                    <td class="text-gray-600 text-left sm:text-right font-pop">{{$team_player->last_name}}</td>
                    <td class="text-gray-600 text-left sm:text-right font-pop">{{$team_player->gender}}</td>
                    <td class="text-gray-600 text-left sm:text-right font-pop">{{date("F j Y", strtotime($team_player->birthday))}}</td>
                    <td> <button wire:click="removePlayer({{ $team_player->pivot->player_id }})" class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove")}}</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>