
    <div>
        <div class="sm:px-0 mx-auto text-center items-center">
            <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">

            @if($finish)
                <h3 class="lg:text-5xl sm:text-lg font-bold leading-6 text-green-400 p-4 uppercase inline text-center items-center">
                    {{__("Your Players has been Registered")}}
                </h3>
            @else
                <h3 class="lg:text-2xl sm:text-lg font-bold leading-6 text-black p-4 uppercase inline text-center items-center">
                    {{__("Select Category and Team")}}
                </h3>

            @endif

        </div>
        <hr class="border-2 border-gray-500">
    </div>


   <div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1">

        <div></div>


        <div>

            <div class="grid">
                @if($error_message)
                    <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
                        {{ $error_message}}
                    </label>
                @endif

            </div>

            {{-- Seleccionar Categoría y luego Equipo  --}}
            <div class="grid grid-cols-4 w-full">
                <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Category')}}</label>
                <select wire:model="category_id"
                        wire:change="read_category"
                        class="select rounded">
                        <option value="" selected>{{__('Choose')}}</option>
                        @foreach($categories as $category_select)
                            <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
                        @endforeach
                </select>

                @if($category_id)
                    <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Team')}}</label>
                    <select wire:model="team_id"
                            wire:change="read_team"
                            class="select rounded">
                            <option value="" selected>{{__('Choose')}}</option>
                            @foreach($teams as $team_select)
                                <option value="{{ $team_select->id }}">{{ $team_select->name }}</option>
                            @endforeach
                    </select>
                @endif

            </div>

            @if($team_id)
                <div class="mt-5 border-2 border-green-400">
                    <div class="sm:px-0 mx-auto text-center items-center">
                        <label class="text-center text-2xl font-bold mb-10">JUGADORES INSCRITOS EN EL EQUIPO</label>
                    </div>
                    <div class="sm:px-0 mx-auto text-center items-center">
                        <table>
                            <thead>
                                <th>{{__('First Name')}}</th>
                                <th>{{__('Last Name')}}</th>
                                <th>{{__('Gender')}}</th>
                                <th>{{__('Birthday')}}</th>
                            </thead>
                            <tr>
                                <td>Pedro</td>
                                <td>Páramo</td>
                                <td>Hombre</td>
                                <td>Jul-18-1955</td>
                                <td>Quitar</td>
                            </tr>
                            <tr>
                                <td>Benito</td>
                                <td>Juárez</td>
                                <td>Hombre</td>
                                <td>Mar-21-1806</td>
                                <td>Quitar</td>
                            </tr>
                            <tr class=" bg-pink-300">
                                <td>Frida</td>
                                <td>Kahlo</td>
                                <td>Mujer</td>
                                <td>Jul-06-1907</td>
                                <td>Quitar</td>
                            </tr>

                        </table>

                    </div>
                </div>

                <div class=" mt-32 border-2 border-red-400 w-full">
                    <div class="MT-10 sm:px-0 mx-auto text-center items-center">
                        <label class="text-center text-2xl font-bold">FORMULARIO PARA AGREGAR JUGADORES</label>
                    </div>

                    <div class="sm:px-0 mx-auto text-center items-center">
                        <table>
                            <thead>
                                <th>{{__('First Name')}}</th>
                                <th>{{__('Last Name')}}</th>
                                <th>{{__('Gender')}}</th>
                                <th>{{__('Birthday')}}</th>
                            </thead>
                            <tr>
                                <td><input type="text" name="" id=""  placeholder="{{__('First Name')}}"></td>
                                <td><input type="text" name="" id=""  placeholder="{{__('Last Name')}}"></td>
                                <td>
                                    <input type="radio"
                                            wire:model="gender"
                                            class="form-check-input h-4 w-4 bg-blue-500"
                                            value="Male">

                                    <label class="text-blue-500">{{ __('M') }}</label>

                                    <input type="radio"
                                            wire:model="gender"
                                            class="form-check-input h-4 w-4"
                                            value="Female"
                                    >

                                    <label class="text-pink-500">{{ __('F') }}</label>
                                </td>
                                <td>
                                    <input type="date"
                                    wire:model="birthday"
                                    min=""
                                    max=""
                                    placeholder="{{__("Birthday")}}"
                                    class=" w-1/8"
                                >


                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

            @endif

        </div>

    </div>

    {{-- @if(!$finish)
        <div class="row mt-5">
            <div class="flex text-center items-center justify-center bg-gray-50  sm:px-6">
                <button wire:click="review_data"
                        class="button green mx-2 px-8 py-4  font-semibold  rounded-lg hover:text-black"
                    >
                    {{__("Save")}}
                </button>
            </div>
        </div>
    @endif --}}
