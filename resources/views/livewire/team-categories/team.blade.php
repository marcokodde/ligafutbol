
{{-- Nombre Equipo --}}

<div class="mb-4 flex">
    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Team")}}</label>
    <input type="text"
            wire:model="name"
            maxlength="50"
            placeholder="{{__("Team")}}"
            class="ml-5 inline-flex shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
    <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>

    <label class="inline-flex ml-4 mr-5 text-gray-700 text-sm font-bold text-left">{{__("Zipcode")}}</label>
    <input type="text"
            wire:model="zipcode"
            wire:change="read_zipcode()"
            maxlength="5"
            minlength="5"
            placeholder="{{__("Zipcode")}}"
            class=" w-20 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    >

            <div>@error('zipcode') <span class="text-red-500">{{ $message }}</span>@enderror</div>

    @if(isset($town_state) && strlen($town_state))
        <div>
            <label class="block ml-4 mr-5 text-green-700 font-bold text-center text-2xl">
                {{ $town_state}}
            </label>
        </div>
    @endif


</div>
