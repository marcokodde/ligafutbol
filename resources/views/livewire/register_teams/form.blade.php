
    <div>
        <div class="sm:px-0 mx-auto text-center items-center">
            <img src="{{asset('images/galveston2022.png')}}" height="100px" width="100px" class="inline" alt="">
            <h3 class="lg:text-2xl sm:text-lg font-bold leading-6 text-black p-4 uppercase inline text-center items-center">
                {{__("Introduce the Team Name and Zipcode")}}
            </h3>
        </div>
        <hr class="border-2 border-gray-500">
    </div>


   <div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1">

        <div></div>

        {{-- Muestra un renglón para cada equipo x categoría --}}
        <div>

            <div class="grid">
                @if($error_message)

                    @if($finish)
                        <label class=" text-3xl text-green-500 text-center font-bold mb-2 mt-2">
                            {{ $error_message}}
                        </label>
                    @else
                        <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
                            {{ $error_message}}
                        </label>
                    @endif
                @endif

            </div>

            <div class="grid grid-cols-3">
                <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Category')}}</label>
                <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('Team')}}</label>
                <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{__('ZipCode')}}</label>
            </div>
            @php $indice = 0 @endphp

            @foreach($teams_category_user as $category)

                @for($i=1;$i<=$category->qty_teams;$i++)

                    <div class="row">
                        <div class="grid grid-cols-3">
                            <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{$category->category->name}}</label>

                            {{-- Equipo --}}
                            <input  type="text"
                                wire:model="team_names.{{ $indice }}"
                                class="w-full mt-2"
                                @if($error_names[$indice])
                                     style="background-color: red"
                                @endif
                                @if($finish) disabled @endif
                            >

                            {{-- Zipcode --}}
                            <input  type="text"
                                    wire:model="team_zipcodes.{{ $indice }}"
                                    class="w-full ml-5 mt-2"
                                    @if($error_zipcodes[$indice])
                                        style="background-color: red"
                                    @endif
                                    @if($finish) disabled @endif
                            >
                        </div>
                    </div>
                    @php $indice++ @endphp
                @endfor
            @endforeach

        </div>

    </div>

    @if(!$finish)
        <div class="row mt-5">
            <div class="flex text-center items-center justify-center bg-gray-50  sm:px-6">
                <button wire:click="show_data"
                        type="submit"
                        class="button green mx-2 px-8 py-4  font-semibold  rounded-lg hover:text-black"
                    >
                    {{__("Save")}}
                </button>
            </div>
        </div>
    @endif
