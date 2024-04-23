<div class="bd-example bd-example-modal">
    <div class="block bg-white border border-gray-100 md:rounded">
        <div class="hola mundo">
            <div class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="z-50 flex items-end justify-center px-4 pt-4 pb-20 text-center bg-white border border-gray-100 shadow-lg md:rounded sm:block sm:p-0 md:w-3/5 lg:w-2/5" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                    <p class="flex items-center px-6 py-3 font-bold grow">
                        Cedula Arbitral
                    </p>
                    <p class="flex items-center px-6 py-3 font-bold grow">
                        {{ $torneo->description }}
                    </p>
                    <p class="flex items-center px-6 py-3 font-bold grow">
                        Fecha: {{ $hoy }}
                    </p>
                </header>
                <form>
                    <div class="mx-auto bg-white">
                        {{-- Nombre Jornada --}}
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-left text-gray-700">{{__("Jornada:")}} {{ $jornada->name }} </label>
                        </div>

                        {{-- Jornada y juegos  --}}
                        <div class="flex flex-row">
                            <label class="block mx-2 text-sm font-bold text-left text-gray-700">{{__("Juegos de la jornada")}}
                                <select wire:model="game_id"
                                    class="block px-2 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    <option value="" selected>{{__("Juegos")}}</option>
                                    @foreach($juegos as $juego)
                                        <option value="{{ $juego->id }}"> <strong>{{ $juego->LocalTeam->name }}</strong>  VS <strong>{{ $juego->VisitTeam->name }} </strong> , {{ $juego->date }}</option>
                                    @endforeach
                                </select>
                                <div>@error('game_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </label>

                            <label class="block text-sm font-bold text-left text-gray-700">{{__("Asignación de Arbitros")}}
                            <select wire:model="referee_id" name="p" id="p" multiple
                                class="block px-2 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                @foreach($arbitros as $arbitro)
                                    <option value="{{ $arbitro->id }}"> <strong>{{ $arbitro->FullName }}</strong></option>
                                @endforeach
                            </select>
                            <div>@error('referee_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                        </label>
                        </div>


                        {{-- Fecha Nacimiento  --}}
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-left text-gray-700">{{__("Birthday")}}</label>
                            <input type="date"
                                    wire:model="birthday"
                                    min="1970-12-12"
                                    max="1988-12-31"
                                    placeholder="{{__("Birthday")}}"
                            class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                            <div>@error('birthday') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                        </div>
                    </div>
                    @include('common.crud_save_cancel')
                </form>
            </div>
        </div>
    </div>
</div>
