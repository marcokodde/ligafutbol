
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
                                <input type="text" wire:model="name" maxlength="100" placeholder="{{__("Name")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Email")}}</label>
                                <input type="text" wire:model="email" maxlength="100" placeholder="{{__("Email")}}"
                                        class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('email') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>



                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Address")}}</label>
                                <input type="text" wire:model="address"  maxlength="60" placeholder="{{__("Address")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('address') <span class="text-red-500">{{ $message }}</span>@enderror</div>

                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Zipcode")}}</label>
                                <input type="text" wire:model="zipcode" maxlength="5" placeholder="{{__("Zipcode")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('zipcode') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("´Phone")}}</label>
                                <input type="text"
                                        wire:model="phone"
                                        maxlength="10"
                                        placeholder="{{__("Phone")}}"
                                        class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        >
                               <div>@error('phone') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Account Manager")}}</label>
                                    <span><select wire:model="user_account_manager_id"
                                            class="block form-select form-select-md rounded w-auto">
                                            <option value="" selected>{{__('Choose')}}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} </option>
                                            @endforeach
                                        </select>
                                    </span>
                                <div>@error('user_account_manager_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
