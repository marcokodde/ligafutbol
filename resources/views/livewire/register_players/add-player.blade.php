<div>
    <div wire:loading.delay wire:target="addingPlayer">
        <button type="button" class="inline-flex items-center text-2xl font-pop font-semibold px-4 py-2  leading-6 shadow rounded-md text-white bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{__('Adding Player at Team')}}
        </button>
    </div>
    <div class="flex flex-wrap mt-2">

        <div>
            <label class="block font-pop text-base">{{__('First Name')}}</label>
            <input type="text"
                wire:model="first_name"
                maxlength="30"
                minlength="5"
                placeholder="{{__('First Name')}}"
                class="block  @error('first_name')  border-red-600 border-collapse border-2 @enderror">
                @error('first_name') <label class="text-red-500 text-xl" >*</label>@enderror
        </div>

        <div class="lg:ml-2 sm:ml-0">
            <label class="block font-pop text-base">{{__('Last Name')}}</label>
            <input type="text"
                wire:model="last_name"
                placeholder="{{__('Last Name')}}"
                class="block  @error('last_name')  border-red-600 border-collapse border-2 @enderror">
                @error('last_name') <label class="text-red-500 text-xl" >*</label>@enderror
        </div>
        <div class="ml-1">
            <label class="block font-pop text-base">{{__('Gender')}}</label>
            <div class="flex justify-between @error('gender') border-red-600 border-collapse border-2 @enderror">
                <div class="mt-1 px-2">
                    <label class="text-blue-500">{{ __('Boy') }}</label>
                    <input type="radio"
                    wire:model="gender"
                    wire:change="birthday_limits"
                    class="form-check-input h-4 w-4"
                    value="Male">
                </div>

                <div class="mt-1 ml-2">
                    <label class="text-pink-500">{{ __('Girl') }}</label>
                    <input type="radio"
                    wire:model="gender"
                    wire:change="birthday_limits"
                    class="form-check-input h-4 w-4 rounded-full"
                    value="Female">
                </div>
            </div>
            @error('gender') <label class="text-red-500 text-xl" >*</label>@enderror
        </div>
        <div>
            <label class="block font-pop text-base">{{__('Birthday')}}</label>
            <input type="date"
                wire:model="birthday"
                min="{{$birthday_min}}"
                max="{{$birthday_max}}"
                placeholder="{{__("Birthday")}}"
                class="block ml-1 w-11/12 @error('birthday')  border-red-600 border-collapse border-2 @enderror">
                @error('birthday') <label class="text-red-500 text-xl" >*</label>@enderror
        </div>
       
        <div class="ml-2">
            <label class="block font-pop text-base">&nbsp;</label>
            <button wire:click="addingPlayer"
                class="block bg-green-500 px-4 py-2 rounded-lg  text-black hover:text-white">
                {{ __('Add')}}
            </button>
        </div>
    </div>
</div
