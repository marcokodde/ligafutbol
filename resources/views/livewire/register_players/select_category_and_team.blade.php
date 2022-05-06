{{-- Seleccionar Categoría y luego Equipo  --}}
<div class="flex justify-center items-center gap-4">
    <div>
        <label class="block text-xl text-gray-700 font-bold mt-2">{{__('Category')}}</label>
        <select wire:model="category_id"
                wire:change="read_category"
                class="select rounded mt-4 block w-auto">
                @if($categories->count() > 1 )
                    <option value="" selected>{{__('Choose')}}</option>
                @endif
                @foreach($categories as $category_select)
                    <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
                @endforeach
        </select>
    </div>

    <div>
        @if($category_id)
            <label class="block text-xl text-gray-700 font-bold mt-2 ml-2">{{__('Team')}}</label>
            <select wire:model="team_id"
                    wire:change="read_team"
                    class="select rounded mt-4 block ml-2 w-auto">
                    @if($teams->count() > 1 )
                        <option value="" selected>{{__('Choose')}}</option>
                    @endif
                    @foreach($teams as $team_select)
                        <option value="{{ $team_select->id }}">{{ $team_select->name }}</option>
                    @endforeach
            </select>
        @endif
    </div>
</div>
