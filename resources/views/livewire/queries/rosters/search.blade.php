<div class="grid grid-cols-4 gap-4">

    <div>
        <label class="font-pop font-semibold text-normal">{{__('Category')}}</label>
            <select wire:model="category_id"
                    wire:change="read_teams"
                    class="w-auto bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="">{{__('Category')}}</option>
                @foreach($categories as $category_select)
                    <option value="{{$category_select->id}}">{{$category_select->name}}</option>
                @endforeach

            </select>
    </div>

    @if($teams && $teams->count())
            <select wire:model="team_id"
                class="w-auto bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="">{{__('Team')}}</option>
                @foreach($teams as $team_select)
                    <option value="{{$team_select->id}}">{{$team_select->name}}</option>
                @endforeach
            </select>
    @endif

</div>
