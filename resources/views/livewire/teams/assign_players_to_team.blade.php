@include('common.crud_header')
<div class="py-4 px-4">
    @include('common.crud_message')
        <div class="mb-2">
            <div class="col-span-6 sm:col-span-2 md:col-span-3 lg:col-span-4 xl:col-span-3">
                <select wire:model="team_id"
                    wire:change="read_team()"
                    class="w-56 bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-4 rounded leading-tight focus:outline-none focus:shadow-outline mx-2">
                        <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline" value="">{{__('Select Team')}}</option>
                        @foreach($teams as $team_to_assign)
                            <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline"
                                    value="{{$team_to_assign->id}}">
                                    {{$team_to_assign->name}}
                            </option>
                        @endforeach
                    </select>
                    @if($team_id)
                        <div class="inline">
                            <input type="text"
                            wire:model="search"
                            placeholder="{{__($search_label)}}"
                            class="inline w-1/4 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            >

                        </div>

                    @endif
                </div>
            </div>

            @if($team && $team_id &&  $team->total_players())

                <div class="mx-4 px-4">
                    <span> {{$team->total_players()}}</span>
                    @include('common.read_only_linked_records')
                </div>
            @endif

            <div class="group flex items-center">
                @if($team_id)
                    <div class="flex">
                        @forelse($records as $record)
                            <div class="card flex-wrap text-center px-4 rounded-lg h-56 w-44 items-center shadow bg-white m-4">
                                <div class="shrink-0">
                                    <img class="h-16 w-16 object-cover rounded-full" src="{{asset('images/default.png')}}" alt="photo">
                                </div>
                                <label class="block font-bold font-serif text-base">
                                    {{ $record->full_name}}
                                </label>

                                <label class="block">
                                    {{ $record->birthday }}
                                </label>

                                <label class="block">
                                    {{  __($record->gender)}}
                                </label>
                                <div class="text-center">
                                    @if($record->isLinkedTeam($team_id))
                                        <button wire:click="unlinkRecord({{ $record->id }})" class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove Player")}}</button>
                                    @else
                                        @if($allow_assign)
                                            <button wire:click="linkRecord({{ $record->id }})" class="bg-indigo-500 hover:bg-indigo-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Add Player")}}</button>
                                        @else
                                            <button class="bg-gray-500 hover:bg-gray-900 text-white font-bold py-1 px-2 rounded-lg text-center text-sm">
                                                {{__("Complete Team")}}
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @empty
                            @include('common.no_records_found')
                        @endforelse
                    </div>
                </div>
                <div class="block">
                    @include('common.pagination')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
