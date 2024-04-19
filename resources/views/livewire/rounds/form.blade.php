<div class="bd-example bd-example-modal">
    <div class="block bg-white border border-gray-100 md:rounded">
        <div class="hola mundo">
            <div class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="z-50 flex items-end justify-center px-4 pt-4 pb-10 text-center bg-white border border-gray-100 shadow-lg md:rounded sm:block sm:p-0" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center px-6 py-3 font-bold grow">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="mx-auto bg-white">
                            {{-- Desde  --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("From")}}</label>
                                <input type="date"
                                wire:model="from"
                                required
                                placeholder="{{__("From")}}"
                                class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                <div>@error('from') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                            {{-- Hasta --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Birthday")}}</label>
                                <input type="date"
                                        wire:model="to"
                                        placeholder="{{__("To")}}"
                                class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('to') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="p-2 rounded-lg">
                                <label class="flex items-start justify-start mt-4 mr-2 font-semibold text-gray-700">
                                    <div class="flex items-center justify-center flex-shrink-0 w-5 h-5 mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                    <input type="checkbox" wire:model="active" class="absolute checkbox" checked>
                                    <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                    </div>
                                    {{__("Active")}}
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

