
<div>
    <div class="mx-auto text-center items-center ">
        <label class="text-center text-2xl font-bold mb-10 sm:text-left">
            {{$team->category->name .'-' . $team->name}}
        </label>
    </div>
    <table class="border-collapse w-full">
        <thead>
            <th colspan="2" class="border-b font-medium border text-gray-700 lg:table-cell font-pop">{{__('Name')}}</th>
            {{-- <th class="border-b font-medium border text-gray-700 lg:table-cell font-pop">{{__('Last Name')}}</th>
            <th class="border-b font-medium border text-gray-700 lg:table-cell font-pop">{{__('Gender')}}</th>
            <th class="border-b font-medium border text-gray-700 lg:table-cell font-pop">{{__('Birthday')}}</th> --}}
        </thead>
        <body>
            @foreach($team->players as $team_player)
                <tr>
                    @if(App::isLocale('en'))
                        <td><label class="font-bold text-sm"><span class="inline left-0 mr-2">{{$loop->index+1}}</span>{{$team_player->fullName}}</label>,
                            {{date("F j Y", strtotime($team_player->birthday))}}</td>
                    @else
                        <td><label class="font-bold text-sm"><span class="inline left-0 mr-2">{{$loop->index+1}}</span>{{$team_player->fullName}}</label>,
                            {{date('d',strtotime($team_player->birthday)) . '-' .
                            $meses[date('n',strtotime($team_player->birthday))-1]  . '-' .
                            date('Y',strtotime($team_player->birthday)) }}
                        </td>
                    @endif
                        {{--  <td>
                        <span class="lg:hidden absolute top-4 left-0 px-2 py-1 text-xs font-bold">Name</span>
                    </td>  --}}
                        {{--<td>
                        <span class="lg:hidden absolute top-16 left-0 px-2 py-1 text-xs font-bold">Last Name</span>
                        {{$team_player->last_name}}</td>
                    <td>
                        <span class="lg:hidden absolute top-28 left-0 px-2 py-1 text-xs font-bold">Gender</span>
                        {{$team_player->gender}}</td>
                    <td>
                        <span class="lg:hidden absolute top-40 left-0 px-2 py-1 text-xs font-bold">Birthday</span>
                        {{date("F j Y", strtotime($team_player->birthday))}}</td>
                        --}}
                    <td>
                        <button onclick="confirm_modal_player({{$team_player->pivot->player_id}})"
                            class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">
                            {{__("Remove")}}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
