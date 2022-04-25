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

    @if($team_id)
    <div class="flex flex-wrap justify-between items-center mx-auto">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4">
                @forelse($records as $record)
                    <div class="card font-mono bg-white leading-6 px-4 m-2 mt-2 rounded-lg sm:inline-block">
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
                <div class="block">
                    @include('common.pagination')
                </div>
            </div>
        </div>
    @endif
</div>