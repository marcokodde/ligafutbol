<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="block font-pop font-semibold text-normal">
            {{__('Search')}}
            <i class="mdi mdi-book-search-outline" style="font-size: 1.5rem;"></i>
        </label>
        <div>
            <input class="form-control px-2 py-2 border border-blue-600"
                wire:model="search"
                placeholder="{{__($search_label)}}"
            >
        </div>
    </div>


</div>
<div>
    <table>
        <thead>
            <tr>
                <th>{{__('Category')}}</th>
                <th>{{__('Team Id')}}</th>
                <th>{{__('Team')}}</th>
                <th>{{__('Player')}}</th>

            </tr>
        </thead>
        @foreach($categories as $category)
            @foreach($category->players as $team_player)
                <tr>
                    <th>{{$category->name}}</th>
                    <th>{{$team_player->id}}</th>
                    <th>{{$team_player->team->name}}</th>
                    <th>{{$team_player->player->first_name}}</th>
                </tr>
            @endforeach

        @endforeach
    </table>
</div>
