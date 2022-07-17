@include('common.crud_header')
<div class="container">
    @foreach($records as $record)
        <div class="overflow-hidden border-t" wire:key="foo{{ $record->id }}" data-accordion="open" >
            <label>
                <input class="absolute opacity-0 peer" type="checkbox" name="" id="{{$record->id}}">
                <p class="inline-block w-11/12 p-5 font-semibold cursor-pointer font-pop">{{$record->category->name}}
                    @if($record->category->teams->count())
                        <label class="font-semibold font-pop">
                            , {{ __('Registered') . ':' . $record->category->teams->count()}}
                        </label>
                    @endif
                </p>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="inline-block float-right w-6 h-6 mt-5 mr-20 border-2 rounded-full cursor-pointer peer-checked:rotate-45 peer-checked:bg-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    class="inline-block float-right w-6 h-6 mt-5 mr-20 border-2 rounded-full cursor-pointer rotate-15 peer-checked:rotate-15 peer-checked:bg-indigo-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <div class="max-h-screen bg-gray-300 rounded-lg peer-checked:max-h-0">
                <div class="bg-gray-300 rounded-lg">
                    @if ($record->category->teams->count())
                        @foreach ($record->category->teams as $team)
                            <p class="p-2 font-pop">
                                <strong>{{$loop->index +1}} .- {{__('Team')}}:</strong>
                                @if ($team->name)
                                <span>{{$team->name}} ,</span>
                                @endif
                                
                                <strong>{{__('Coach')}}:</strong>
                                @if ($team->user)
                                <span>{{$team->user->name}}.</span>
                                @endif
                            </p>
                        @endforeach
                    @else
                        <p class="p-5 font-pop ">{{__('No tenemos registros')}}
                    @endif
                </div>
            </label>
        </div>
    @endforeach
    <div>
        @if($show_pagination)
            @include('common.crud_pagination')
        @endif
    </div>
</div>


<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
