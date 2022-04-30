
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
                <div class="grid grid-cols-4">
                    Se ha seleccionado equipo
                </div>
            @endif

        </div>

    </div>

    @if(!$finish)
        <div class="row mt-5">
            <div class="flex text-center items-center justify-center bg-gray-50  sm:px-6">
                <button wire:click="review_data"
                        class="button green mx-2 px-8 py-4  font-semibold  rounded-lg hover:text-black"
                    >
                    {{__("Save")}}
                </button>
            </div>
        </div>
    @endif
