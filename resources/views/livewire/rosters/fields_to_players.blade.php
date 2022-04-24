<div class="flex  flex-col justify-center" style="">
    <div class="flex justify-between gap-4 text-center font-bold lg:hover:bg-gray-100 lg:bg-gray-50">
        <label class=" w-1/4">{{__('First Name')}}</label>
        <label class=" w-1/4">{{__('Last Name')}}</label>
        <label class=" w-1/8">{{__('Gender')}}</label>
        <label class=" w-1/8">{{__('Birthday')}}</label>

    </div>

    @for($i=1;$i<=$this->general_settings->max_players_by_team;$i++)
        <div class="flex justify-between gap-2 mb-2">

            {{-- Nombre --}}
            <input type="text"
                    wire:model="first_names.{{$i}}"
                    maxlength="50" placeholder="{{__("First Name")}}"
                    class=" w-1/4"
            >
            {{-- Apellido --}}
            <input type="text"
                    wire:model="last_names.{{$i}}"
                    maxlength="50"
                    placeholder="{{__("Last Name")}}"
                    class=" w-1/4"
            >

            {{-- Sexo --}}
            <div class="w-1/8">
                   <input type="radio"
                        wire:model="genders.{{$i}}"
                        wire:change="calculate_limits_to_birthday"
                        class="form-check-input h-4 w-4"
                        value="Female"
                >

                <label class="text-pink-500">{{ __('F') }}</label>

                <input type="radio"
                        wire:model="genders.{{$i}}"
                        wire:change="calculate_limits_to_birthday"
                        class="form-check-input h-4 w-4 bg-blue-500"
                        value="Male">

                <label class="text-blue-500">{{ __('M') }}</label>

            </div>

            {{-- Fecha de Nacimiento --}}
            <input type="date"
                wire:model="birthdays.{{$i}}"
                min="{{$female_birthday_from}}"
                max="{{$male_birthday_to}}"
                placeholder="{{__("Birthday")}}"
                class=" w-1/8"
            >
        </div>
    @endfor

    @include('livewire.rosters.dates_limits')
    <span>
        @include('livewire.rosters.action_buttons')
    </span>

</div>
