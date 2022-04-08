
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
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Date From")}}</label>
                                <input type="date" wire:model="date_from" maxlength="10" placeholder="{{__("Date From")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('date_from') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Date To")}}</label>
                                <input type="date" wire:model="date_to" maxlength="10" placeholder="{{__("Date To")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('date_to') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Gender")}}</label>
                                <select wire:model="gender"
                                        class="block form-select form-select-md  rounded w-auto">
                                        <option value="" selected>{{__('Choose')}}</option>
                                        <option value="Female">{{__('Female')}}</option>
                                        <option value="Male">{{__('Male')}}</option>
                                        <option value="Both">{{__('Both')}}</option>
                                </select>
                                <div>@error('gender') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="flex text-gray-700 justify-start font-semibold items-start mr-2 mt-4">
                                    <div class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <input type="checkbox" wire:model="active" class="checkbox absolute" checked>
                                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                    </div>
                                    {{__("Active?")}}
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
