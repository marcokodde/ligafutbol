            {{-- Seleccionar Categoría y luego Equipo  --}}
            <div class="grid grid-cols-4 w-full">
                <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Category')}}</label>
                <select wire:model="category_id"
                        wire:change="read_category"
                        class="select rounded">
                        <option value="" selected>{{__('Choose')}}</option>
                        @foreach($categories as $category_select)
                            <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
                        @endforeach
                </select>

                @if($category_id)
                    <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Team')}}</label>
                    <select wire:model="team_id"
                            wire:change="read_team"
                            class="select rounded">
                            <option value="" selected>{{__('Choose')}}</option>
                            @foreach($teams as $team_select)
                                <option value="{{ $team_select->id }}">{{ $team_select->name }}</option>
                            @endforeach
                    </select>
                @endif

            </div>
