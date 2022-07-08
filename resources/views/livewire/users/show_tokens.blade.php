@include('common.crud_header')
<div class="container">

    @foreach($records as $record)
        {{-- @foreach($record->roles as $role)
            @if($role->id == 3) --}}
                <div class="overflow-hidden border-t" wire:key="foo{{ $record->id }}" data-accordion="open" >
                    <label>
                        <input class="absolute opacity-0 peer" type="checkbox" name="" id="{{$record->id}}">
                        <p class="cursor-pointer p-5 inline-block w-11/12 font-pop font-semibold">{{$record->name}},
                            <strong>{{__('Email')}}:</strong>
                            <span>{{$record->email}}.</span>
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 cursor-pointer inline-block float-right mr-20 mt-5 border-2 rounded-full rotate-15 peer-checked:rotate-15 peer-checked:bg-indigo-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <div class="bg-gray-200 peer-checked:max-h-0 max-h-screen rounded-lg">
                            <p class="p-1 font-pop">
                                @if ($record->token_register_teams)
                                    <strong>{{__('Registered Team')}}:</strong>
                                    <span class="underline underline-offset-1 text-blue-500">
                                        {{__('https://equipos.galvestoncup.com/register_teams')}}/{{$record->token_register_teams}}
                                    </span>
                                @else
                                    <p class="p-2 font-pop text-red-600 font-bold">{{__('Teams already registered!')}}
                                @endif
                            </p>
                            <p class="p-1 font-pop">
                                <strong>{{__('Registered Players')}}:</strong>
                                <span class="underline underline-offset-1 text-blue-500">
                                    {{__('https://equipos.galvestoncup.com/register_players')}}/{{$record->token_register_players}}
                                </span>
                            </p>
                        </div>
                    </label>
                </div>
            {{-- @endif
        @endforeach --}}
    @endforeach
    <div>
        @if($show_pagination)
            @include('common.crud_pagination')
        @endif
    </div>
</div>
<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
