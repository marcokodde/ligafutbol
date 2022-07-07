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
                    <div class="container bg-danger">
                        <x-jet-validation-errors></x-jet-validation-errors>
                    </div>

                    <form>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Name")}}</label>
                                <input type="text" wire:model="name" maxlength="50"  placeholder="{{__("Name")}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Email")}}</label>
                                <input type="text" wire:model="email" maxlength="50"  placeholder="{{__("Email")}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Phone")}}</label>
                                <input type="text" wire:model="phone" maxlength="12"  placeholder="{{__("Phone")}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Password")}}</label>
                                <input type="password" wire:model="password"  maxlength="15" minlength="15"
                                    placeholder="{{__("Password")}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Confirm Password")}}</label>
                                <input type="password" wire:model.lazy="password_confirmation" name="password_confirmation" id="password_confirmation" maxlength="50"  placeholder="{{__("Confirm Password")}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Role")}}</label>
                            <select wire:model="role_id"
                                    class="block w-full bg-white border border-white-200 text-gray-700 py-2 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <option>{{__("Select Role")}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">
                                        @if(App::isLocale('en'))
                                            {{$role->english}}
                                        @else
                                            {{$role->spanish}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            <div class="mb-4">
                                <label class="flex text-gray-700 justify-start font-semibold items-start mr-2 mt-4">
                                    <div class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <input type="checkbox" wire:model="active" class="checkbox absolute" checked>
                                    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
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
