
<div class="bd-example bd-example-modal">
    <div class="block bg-white border border-gray-100 md:rounded">
        <div class="hola mundo">
            <div class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="z-50 flex items-end justify-center px-4 pt-4 pb-20 text-center bg-white border border-gray-100 shadow-lg md:rounded sm:block sm:p-0 md:w-3/5 lg:w-2/5" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center px-6 py-3 font-bold grow">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="mx-auto bg-white">
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Spanish")}}</label>
                                <input type="text" wire:model="spanish" maxlength="50" placeholder="{{__("Spanish")}}"
                                class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                @error('spanish') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Short Spanish")}}</label>
                                <input type="text" wire:model="short_spanish"  maxlength="10" placeholder="{{__("Short")}}"
                                class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                @error('short_spanish') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("English")}}</label>
                                <input type="text" wire:model="english" maxlength="50" placeholder="{{__("English")}}"
                                class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                @error('english') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Short English")}}</label>
                                <input type="text"
                                        wire:model="short_english"
                                        maxlength="10"
                                        placeholder="{{__("Short")}}"
                                        class="w-2/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        size="2"
                                        >
                                @error('short_english') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Description")}}</label>
                                <textarea wire:model="description" cols="20" rows="2"
                                class="w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                </textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
