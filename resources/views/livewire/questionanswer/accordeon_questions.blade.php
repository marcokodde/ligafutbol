<div>
    @include('common.crud_header')
    <!-- Container -->
    <div>
        <input type="text"
        wire:model="search"
        placeholder="{{__($search_label)}}"
        class="mb-4 w-1/3 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
    </div>
  {{--     --}}
    <div class="container">
        @foreach($records as $record)
            <div class="overflow-hidden border-t" wire:key="foo{{ $record->id }}">
                <label>
                    <input class="absolute opacity-0 peer" type="checkbox" name="" id="{{$record->id}}">
                    <p class="cursor-pointer p-5 inline-block w-11/12 font-pop font-semibold">{{$record->question}}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer inline-block float-right mr-20 mt-5 border-2 rounded-full peer-checked:rotate-45 peer-checked:bg-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <div class="bg-gray-300 max-h-0 peer-checked:max-h-screen rounded-lg">
                        <p class="p-5 font-pop ">{{$record->answer}}</p>
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
</div>

<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>