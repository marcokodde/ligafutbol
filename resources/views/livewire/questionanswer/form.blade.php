
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

                        {{-- Desde --}}
                        <div class="bg-white mx-auto items-center text-center py-2 px-2">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Question")}}</label>
                                <input type="text"
                                        wire:model="question"
                                        minlength="10"
                                        maxlength="200"
                                        class="shadow block appearance-none border rounded w-full mr-2 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('question') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            {{-- Hasta --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Answer")}}</label>
                                <input type="text"
                                        wire:model="answer"
                                        minlength="10"
                                        maxlength="500"
                                        class="shadow block appearance-none border rounded w-full mr-2 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('answer') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                        </div>
                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>