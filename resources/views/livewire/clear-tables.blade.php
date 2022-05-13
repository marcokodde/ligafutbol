<div>
    <div class="sm:px-0 mx-auto text-center items-center -mt-12">
        <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">
        <h1 class="block mt-1 lg:text-2xl sm:text-base font-semibold leading-6 text-gray-600 p-4 uppercase text-center items-center font-pop">
            {{__("CLEAR ALL TEST DATA")}}
        </h1>
    </div>

    <div class="sm:px-0 mx-auto text-center items-center mt-12">
        @if($is_valid_clear)
            <x-jet-button wire:click.prevent="clear_tables">
                {{__('CLEAR ALL TEST DATA')}}
            </x-jet-button>
        @else
            <x-jet-label class="text-3xl font-bold">
                <h1>{{__('There are not data to clean')}}</h1>
            </x-jet-label>
        @endif
    </div>

</div>
