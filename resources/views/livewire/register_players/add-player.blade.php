<div>
    <div wire:loading.delay wire:target="addingPlayer" class="flex items-center justify-center mx-auto">
        <button type="button" class="items-center justify-center px-2 py-2 text-2xl font-semibold leading-6 text-center text-white transition duration-150 ease-in-out bg-indigo-500 rounded-md shadow cursor-not-allowed font-pop hover:bg-indigo-400" disabled="">
            <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{__('Adding Player at Team')}}
        </button>
    </div>
    <div class="flex flex-wrap mt-2">
        <div>
            <label class="block text-base font-pop">{{__('First Name')}} @error('first_name') <label class="inline text-xl text-red-500" >*</label>@enderror</label>
            <input type="text"
                wire:model="first_name"
                maxlength="30"
                minlength="5"
                placeholder="{{__('First Name')}}"
                class="block  @error('first_name')  border-red-600 border-collapse border-2 @enderror">
                @error('first_name')
                    <span class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">
                        {{$message}}
                    </span>
                @enderror
        </div>

        <div class="lg:ml-2 sm:ml-0">
            <label class="block text-base font-pop">{{__('Last Name')}} @error('last_name') <label class="inline text-xl text-red-500" >*</label>@enderror</label>
            <input type="text"
                wire:model="last_name"
                placeholder="{{__('Last Name')}}"
                class="block  @error('last_name')  border-red-600 border-collapse border-2 @enderror">
            @error('last_name')
                <span class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">
                    {{$message}}
                </span>
            @enderror
        </div>
        <div class="ml-1">
            <label class="block text-base font-pop">{{__('Gender')}}@error('gender') <label class="text-xl text-red-500" >*</label>@enderror</label>
            <div class="flex justify-between @error('gender') border-red-600 border-collapse border-2 @enderror">
                <div class="px-2 mt-1">
                    <label class="text-blue-500">{{ __('Boy') }}</label>
                    <input type="radio"
                    wire:model="gender"
                    wire:change="birthday_limits"
                    class="w-4 h-4 form-check-input"
                    value="Male">
                </div>

                <div class="mt-1 ml-2">
                    <label class="text-pink-500">{{ __('Girl') }}</label>
                    <input type="radio"
                    wire:model="gender"
                    wire:change="birthday_limits"
                    class="w-4 h-4 rounded-full form-check-input"
                    value="Female">
                </div>
            </div>
            @error('gender')
                <span class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">
                    {{$message}}
                </span>
             @enderror
        </div>
        <div>
            <label class="block text-base font-pop">{{__('Birthday')}}</label>
            <input type="date"
                wire:model="birthday"
                min="{{$birthday_min}}"
                max="{{$birthday_max}}"
                placeholder="{{__("Birthday")}}"
                class="block ml-1 w-11/12 @error('birthday')  border-red-600 border-collapse border-2 @enderror">
                @error('birthday')
                    <label class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">
                        {{$message}}
                    </label>
                @enderror
        </div>

        <div class="ml-2">
            <label class="block text-base font-pop">&nbsp;</label>
            <button wire:click="addingPlayer"
                class="block px-4 py-2 text-black bg-green-500 rounded-lg hover:text-white">
                {{ __('Add')}}
            </button>
        </div>
    </div>
</div
