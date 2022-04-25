@include('common.crud_header')
<div class="py-4 px-4">
    @include('common.crud_message')
        <div class="mb-2">
            <div class="col-span-3 sm:col-span-2 md:col-span-3 lg:col-span-4 xl:col-span-3">
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
        @if($team && $team_id &&  $team->total_coaches())
            <div class="mx-4 px-4">
                <span> {{$team->total_coaches()}}</span>
                @include('common.read_only_linked_records')
            </div>
        @endif
        {{--  <div class="grid grid-cols-2 gap-2 mt-1">
            @if($team_id)
                <div>
                    <table>
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-1 w-72">{{__("Name")}}</th>
                                <th class="px-2 py-1 text-center w-28">{{__("Action")}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($records as $record)
                            <tr>
                                <td class="border leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 px-2 py-1 text-left w-auto">
                                    {{ $record->name}}
                                </td>
                                <td class="text-center border">
                                    @if($record->isLinkedTeam($team_id))
                                        <button wire:click="unlinkRecord({{ $record->id }})" class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove")}}</button>
                                    @else

                                        <button wire:click="linkRecord({{ $record->id }})" class="bg-indigo-500 hover:bg-indigo-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("To Assign")}}</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                @include('common.no_records_found')
                            @endforelse
                        </tbody>
                    </table>
                    @include('common.pagination')
                </div>
            @endif
        </div>  --}}
        @if($team_id)
            <div class="flex">
                @forelse($records as $record)
                    <div class="card flex-wrap text-center px-4 rounded-lg h-56 w-44 items-center shadow bg-white m-4">
                        <div class="shrink-0">
                            <img class="h-16 w-16 object-cover rounded-full" src="{{asset('images/coach.png')}}" alt="photo">
                        </div>
                        <label class="block font-bold font-serif text-base">
                            {{ $record->name}}
                        </label>
                        <label class="block mt-2 mb-2">
                            {{ $record->phone }}
                        </label>
                        <div class="bottom-0 mb-1">
                            @if($record->isLinkedTeam($team_id))
                                <button wire:click="unlinkRecord({{ $record->id }})" class="bg-red-500 hover:bg-red-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove")}}</button>
                            @else
                                <button wire:click="linkRecord({{ $record->id }})" class="bg-indigo-500 hover:bg-indigo-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("To Assign")}}</button>
                            @endif
                        </div>
                    </div>
                @empty
                    @include('common.no_records_found')
                @endforelse
            </div>
            <div class="block">
                @include('common.pagination')
            </div>
        @endif
</div>