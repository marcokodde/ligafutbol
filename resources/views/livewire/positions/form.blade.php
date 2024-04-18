
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
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Spanish")}}</label>
                                <input type="text" wire:model="spanish" maxlength="50" placeholder="{{__("Spanish")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('spanish') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Short Spanish")}}</label>
                                <input type="text" wire:model="short_spanish"  maxlength="6" placeholder="{{__("Short")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('short_spanish') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("English")}}</label>
                                <input type="text" wire:model="english" maxlength="50" placeholder="{{__("English")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('english') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Short Spanish")}}</label>
                                <input type="text" wire:model="short_english"  maxlength="6" placeholder="{{__("Short")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('short_spanish') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>


                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
