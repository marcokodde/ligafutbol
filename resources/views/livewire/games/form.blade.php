<div class="bd-example bd-example-modal">
    <div class="block bg-white border border-gray-100 md:rounded">
        <div class="hola mundo">
            <div class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="z-50 flex items-end justify-center px-4 pt-4 pb-10 text-center bg-white border border-gray-100 shadow-lg md:rounded sm:block sm:p-0" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center px-6 py-3 font-bold grow">
                            {{ $create_button_label }}
                        </p>
                    </header>
                    <form>
                        <div class="mx-auto bg-white">
                            {{-- Desde  --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Round")}}</label>
                                <select  wire:model="main_record.round_id"
                                    class="mb-2 form-select">
                                    <option value="">{{ __('Round') }}</option>
                                        @foreach ($rounds as $round_select)
                                            <option class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                value="{{ $round_select->id }}">{{ $round_select->id }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                            {{-- Hasta --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Date")}}</label>
                                <input type="datetime-local"
                                    required min=<?php $hoy = date('Y-m-d'); echo $hoy; ?>
                                    wire:model="main_record.date"
                                    required placeholder="{{ __('Date') }}"
                                    class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('main_record.date') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label  class="block text-sm font-bold text-left text-gray-700" for="">{{ __("Local") }}</label>
                                <select wire:model="main_record.local_team_id"
                                    class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    <option value="" selected>{{__("Local")}}</option>
                                    @foreach($teams as $team_local)
                                        <option value="{{ $team_local->id }}">{{ $team_local->name }}</option>
                                    @endforeach
                                </select>
                                <div>@error('main_record.local_team_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>


                            <div class="mb-4">
                                <label  class="block text-sm font-bold text-left text-gray-700" for="">{{ __("Visit") }}</label>
                                <select wire:model="main_record.visit_team_id"
                                    class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                    <option value="" selected>{{__("Local")}}</option>
                                    @foreach($teams as $team_local)
                                        <option value="{{ $team_local->id }}">{{ $team_local->name }}</option>
                                    @endforeach
                                </select>
                                <div>@error('main_record.visit_team_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="p-2 rounded-lg">
                                <label class="flex items-start justify-start mt-4 mr-2 font-semibold text-gray-700">
                                    {{__("Marcador")}}
                                </label>
                                     {{-- Pedir Marcador en partidos? --}}
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" wire:model="main_record.request_score" class="btn-check" name="type" id="score_yes" value="1">
                                        <label class="btn btn-outline-info" for="score_yes">{{__('Yes')}}</label>

                                        <input type="radio" wire:model="main_record.request_score" class="ml-4 btn-check" name="type" id="score_no" value="0">
                                        <label class="btn btn-outline-warning" for="score_no">{{__('No')}}</label>
                                    </div>

                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Marcador Local")}}</label>
                                <input type="number" min="0" max="99" wire:model="main_record.local_score"  placeholder="{{__("Local")}}"
                                class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                @error('main_record.local_score') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Marcador Visita")}}</label>
                                <input type="number" min="0" max="99" wire:model="main_record.visit_score"   placeholder="{{__("Visita")}}"
                                class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                @error('main_record.visit_score') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                        </div>
                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

