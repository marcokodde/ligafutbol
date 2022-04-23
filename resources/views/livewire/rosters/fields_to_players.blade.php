<div class="flex  flex-col justify-center" style="">
    <div class="flex justify-between gap-4 text-center font-bold lg:hover:bg-gray-100 lg:bg-gray-50">
        <label class=" w-1/6">{{__('First Name')}}</label>
        <label class=" w-1/4">{{__('Last Name')}}</label>
        <label class=" w-1/4">{{__('Gender')}}</label>
        <label class=" w-1/4">{{__('Birthday')}}</label>

    </div>
    <table class="table mb-5" >
            {{-- <thead>
                <tr class="lg:hover:bg-gray-100 lg:bg-gray-50">
                    <th class="w-80">{{__("First Name")}}</th>
                    <th class="w-80">{{__("Last Name")}}</th>
                    <th class="w-80">{{__("Gender")}}</th>
                    <th class="w-80">{{__("Birthday")}}</th>
                </tr>
            </thead> --}}

        {{-- Renglones uno para cada jugador --}}
            @for($i=1;$i<=$this->general_settings->max_players_by_team;$i++)
                <div class="flex flex-col">
                    <tr>
                        {{-- Nombre --}}
                        <td class="mt -1 border px-2 py-1  text-gray-600">
                            <input type="text"
                                    wire:model="first_name"
                                    maxlength="50" placeholder="{{__("First Name")}}"
                            >
                        </td>

                        {{-- Apellido --}}
                        <td class="border px-2 py-1  text-gray-600">
                            <input type="text"
                                    wire:model="last_name"
                                    maxlength="50"
                                    placeholder="{{__("Last Name")}}"

                            >
                        </td>

                        {{-- Sexo --}}
                        <td>

                            <input type="radio"
                                    wire:model="attention_mode"
                                    class="form-check-input h-6 w-6"
                                    checked
                                    value="Female">

                            <label>{{ __('F') }}</label>

                            <input type="radio"
                                        wire:model="attention_mode"
                                        class="form-check-input h-6 w-6"
                                        value="Male">

                            <label>{{ __('M') }}</label>

                        <td>

                        {{-- Fecha Nacimiento --}}
                        <td class="border px-2 py-1  text-gray-600 text-left">
                            <input type="date"
                                wire:model="birthday"
                                min="2004-07-17"
                                max="2015-12-31"
                                placeholder="{{__("Birthday")}}"
                            >
                        </td>


                    </tr>
                </div>
            @endfor

        </table>

        <div class="flex flex-col">
        </div>

        @include('livewire.rosters.action_buttons')

</div>
