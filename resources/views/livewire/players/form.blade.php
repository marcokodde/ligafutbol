
<div class="bd-example bd-example-modal">
    <div class="md:rounded block bg-white border border-gray-100">
        <div class="hola mundo">
            <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-50" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-10 text-center sm:block sm:p-0 z-50" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center py-3 grow font-bold px-6">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="bg-white mx-auto">
                            {{-- Nombre  --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("First Name")}}</label>
                                <input type="text" wire:model="first_name" maxlength="50" placeholder="{{__("First Name")}}"
                                class="block shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('first_name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            {{-- Apellido  --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Last Name")}}</label>
                                <input type="text" wire:model="last_name" maxlength="50" placeholder="{{__("Last Name")}}"
                                class="block shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                            {{-- Sexo  --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Gender")}}</label>
                                <select wire:model="gender"
                                        class="block form-select form-select-md  rounded w-auto text-left">
                                        <option value="" selected>{{__('Choose')}}</option>
                                        <option value="Female">{{__('Female')}}</option>
                                        <option value="Male">{{__('Male')}}</option>
                                </select>
                                <div>@error('gender') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                            {{-- Fecha Nacimiento  --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Birthday")}}</label>
                                <input type="date"
                                        wire:model="birthday"
                                        min="2004-07-17"
                                        max="2015-12-31"
                                        placeholder="{{__("Birthday")}}"
                                class="block shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('birthday') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                        </div>
                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
