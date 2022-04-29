{{-- Encabezado de categoría y equipo --}}
<div class="flex justify-between gap-4 text-center font-bold">
    <label class=" w-1/6">{{__('Category')}}</label>
    @if($category_id)
        <label class=" w-1/4">{{__('Team')}}</label>
        <label class=" w-1/4">{{__('Zipcode')}}</label>

        <label class=" w-1/4">
            @if(isset($town_state) && strlen($town_state))
                {{__('Town')}}
            @endif
        </label>
    @endif
</div>

{{-- Controles para Categoría y Equipo --}}
<div class="flex justify-between gap-4 mb-2">
    {{-- Categoria --}}
    <select wire:model="category_id"
            wire:change="calculate_birthday_limits"
            class="w-1/6">
        <option value="" selected>{{__('Choose')}}</option>
            @foreach($categories as $category_select)
                <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
            @endforeach
    </select>

    @if($category_id)
        {{-- Equipo --}}
        <input type="text"
                wire:model="name"
                maxlength="50"
                placeholder="{{__("Team")}}"
                class="w-1/3 {{$error_team ? 'bg-red-500' :''}}"
        >

        {{-- Zona Postal --}}
        <input type="text"
                wire:model="zipcode"
                wire:change="read_zipcode()"
                maxlength="5"
                minlength="5"
                placeholder="{{__("Zipcode")}}"
                class=" w-1/6"
        >

        {{-- Ciudad Estado --}}


        <label class=" w-1/4 text-green-700 font-bold text-center text-2xl">
            @if(isset($town_state) && strlen($town_state))
                {{ $town_state}}
            @endif
        </label>
    @endif

</div>