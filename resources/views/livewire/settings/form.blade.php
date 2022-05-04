
<div class="bd-example bd-example-modal">
    <div class="md:rounded block bg-white border border-gray-100">
        <div class="hola mundo">
            <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-50" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 md:w-3/5 lg:w-2/5 z-50" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center py-3 grow font-bold px-6">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="bg-white mx-auto">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Name")}}</label>
                                <input type="text" wire:model="name" maxlength="50" placeholder="{{__("Name")}}"
                                class="shadow block appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Players by Team")}}</label>
                                <input type="number"
                                        wire:model="max_players_by_team"
                                        min="1"
                                        max="99"
                                        class="shadow block appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('max_players_by_team') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Teams by Category")}}</label>
                                <input type="number"
                                        wire:model="max_teams_by_category"
                                        min="1"
                                        max="25"
                                        class="shadow block appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('max_teams_by_category') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="p-2 rounded-lg">
                                <label class="flex text-gray-700 justify-start font-semibold items-start mr-2 mt-4">
                                    <div class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <input type="checkbox"
                                            wire:model="players_only_available_teams"
                                            class="checkbox absolute"
                                            checked>
                                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                    </div>
                                    {{__("Players Only Enabled Teams")}}
                                </label>
                            </div>


                            <div class="p-2 rounded-lg">
                                <label class="flex text-gray-700 justify-start font-semibold items-start mr-2 mt-4">
                                    <div class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <input type="checkbox"
                                            wire:model="coaches_only_available_teams"
                                            class="checkbox absolute"
                                            checked>
                                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                    </div>
                                    {{__("Coaches Only Enabled Teams")}}
                                </label>
                            </div>


                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
