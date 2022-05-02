
<div>
    <div class=" mt-10  w-full">
        <div class="sm:px-0 mx-auto text-center items-center">
            <table>
                <thead>
                    <th>{{__('First Name')}}</th>
                    <th>{{__('Last Name')}}</th>
                    <th>{{__('Gender')}}</th>
                    <th>{{__('Birthday')}}</th>
                </thead>
                <thead>
                    <th> @error('first_name') <span class="text-red-500">{{ $message }}</span>@enderror</th>
                    <th> @error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror</th>
                    <th> @error('gender') <span class="text-red-500">{{ $message }}</span>@enderror</th>
                    <th> @error('birthday') <span class="text-red-500">{{ $message }}</span>@enderror</th>
                </thead>


                <tr>
                    <td>
                        <input type="text"
                                wire:model="first_name"
                                maxlength="30"
                                minlength="5"
                                placeholder="{{__('First Name')}}"
                        >
                    </td>

                    <td>
                        <input type="text"
                                wire:model="last_name"
                                placeholder="{{__('Last Name')}}"
                        >
                    </td>
                    </td>

                    <td>
                        <input type="radio"
                                wire:model="gender"
                                wire:change="birthday_limits"
                                class="form-check-input h-4 w-4 bg-blue-500"
                                value="Male">

                        <label class="text-blue-500">{{ __('M') }}</label>

                        <input type="radio"
                                wire:model="gender"
                                wire:change="birthday_limits"
                                class="form-check-input h-4 w-4"
                                value="Female"
                        >

                        <label class="text-pink-500">{{ __('F') }}</label>
                    </td>
                    <td>
                        <input type="date"
                                wire:model="birthday"
                                min="{{$birthday_min}}"
                                max="{{$birthday_max}}"
                                placeholder="{{__("Birthday")}}"
                                class=" w-1/8"
                        >
                    </td>
                    <td>
                        <button wire:click="addPlayer" class=" bg-green-400">
                            {{ __('Add')}}
                        </button>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</div>
