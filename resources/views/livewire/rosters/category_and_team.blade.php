{{-- Encabezado de categoría y equipo --}}
<div class="flex justify-between gap-2 text-left font-bold">
    <label class="w-1/2">{{__('Category')}}</label>
</div>
<div class="flex flex-col gap-4 mb-2">
    {{-- Categoria --}}
    @foreach($team_categories as $team_category)
        @for ($i=1; $i<=$team_category->qty_teams; $i++)
            @if ($team_categoriesIds[$i])
            <div class="flex overflow-hidden border-t">
                <label>
                    <div class="left-2">
                        <input class="absolute opacity-0 peer" type="checkbox" name="{{$team_category->category->id.'-'.$i}}" id="{{$i}}">
                        <p class="block text-left text-2xl items-start cursor-pointer p-2 font-bold">{{$team_category->category->name }}</p>
                        <select wire:model="category_id.{{$i}}"
                            class="w-full rounded-lg">
                            <option value="1" selected>{{__('Choose')}}</option>
                            <option value="{{ $team_category->category->id.'-'.$i }}">
                                {{ $team_category->category->name }}-->{{__('team:')}} {{ $i }}
                            </option>
                        </select>
                    </div>
                    @foreach($team_category->category()->get() as $category)
                        @foreach ($category_id as $value)
                            @php
                                $values = (explode("-", $value));
                            @endphp
                            @if($value && $values[0] == $category->id && $values[1] == $i)
                                <div class="flex mt-4" wire:key="bar{{ $i }}">
                                    <input type="text"
                                        wire:model="name.{{$value}}"
                                        maxlength="50"
                                        placeholder="{{__("Team")}}"
                                        class="block w-1/3 {{$error_team ? 'bg-red-500' :''}}">

                                    {{-- Zona Postal --}}
                                    <input type="text"
                                        wire:model="zipcode.{{$value}}"
                                        wire:change="read_zipcode()"
                                        maxlength="5"
                                        minlength="5"
                                        placeholder="{{__("Zipcode")}}"
                                        class="ml-2 inline w-1/3">

                                    {{-- Ciudad Estado --}}
                                    <label class="w-1/3 text-green-700 font-bold text-center text-2xl">
                                        @if(isset($town_state) && strlen($town_state))
                                            {{ $town_state}}
                                        @endif
                                    </label>
                                    <button class="bg-blue-400 px-4 py-2 float-end inline" wire:click="create_team()">Add</button>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </label>
            </div>
            @endif
        @endfor
    @endforeach
</div>

{{-- Controles para Categoría y Equipo --}}
{{--<select wire:model="category_id"
        wire:change="calculate_birthday_limits"
        class="w-1/6">
        <option value="" selected>{{__('Choose')}}</option>
        @foreach($team_categories as $team_category)
            <option value="{{ $team_category->id }}">
            {{ $team_category->category->name }}
            {{__('teams:')}}{{ $team_category->qty_teams }}</option>
        @endforeach
    </select>
--}}