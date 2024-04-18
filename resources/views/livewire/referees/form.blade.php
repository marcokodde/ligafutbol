
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
                            {{-- Nombre  --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("First Name")}}</label>
                                <input type="text" wire:model="first_name" maxlength="50" placeholder="{{__("First Name")}}"
                                class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('first_name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            {{-- Apellido  --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Last Name")}}</label>
                                <input type="text" wire:model="last_name" maxlength="50" placeholder="{{__("Last Name")}}"
                                class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                            {{-- Sexo  --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Gender")}}</label>
                                <select wire:model="gender"
                                        class="block w-auto text-left rounded form-select form-select-md">
                                        <option value="" selected>{{__('Choose')}}</option>
                                        <option value="Female">{{__('Female')}}</option>
                                        <option value="Male">{{__('Male')}}</option>
                                </select>
                                <div>@error('gender') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                             {{-- Telefono  --}}
                             <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Phone")}}</label>
                                <input type="text" wire:model="phone" maxlength="15" placeholder="{{__("Phone")}}"
                                class="block w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('phone') <span class="text-red-500">{{ $message }}</span>@enderror</div>
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
</div>
