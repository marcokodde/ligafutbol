
<div class="bd-example bd-example-modal">
    <div class="md:rounded block bg-white border border-gray-100">
        <div class="hola mundo">
            <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-50" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 z-50" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center py-3 grow font-bold px-6">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="bg-white mx-auto">

                            {{-- Nombre Promotor --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold">{{__("Name")}}</label>
                                <input type="text" wire:model="name" maxlength="50" placeholder="{{__("Name")}}"
                                class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                              {{-- Teléfono --}}
                              <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold">{{__("Phone")}}</label>
                                <input type="text" wire:model="phone" maxlength="15" placeholder="{{__("Phone")}}"
                                class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('phone') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>


                            {{-- Email --}}

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold">{{__("Email")}}</label>
                                <input type="email" wire:model="email" maxlength="50" placeholder="{{__("Email")}}"
                                class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('email') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            {{-- Código  --}}

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold">{{__("Code")}}</label>
                                <input type="text" wire:model="code" maxlength="50" placeholder="{{__("Code")}}"
                                class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('code') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
