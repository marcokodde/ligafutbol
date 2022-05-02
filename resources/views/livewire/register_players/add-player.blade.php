<div class="flex flex-wrap mt-2">
    <div>
        <label class="block font-pop text-base">{{__('First Name')}}</label>
        <input type="text"
                wire:model="first_name"
                maxlength="30"
                minlength="5"
                placeholder="{{__('First Name')}}"
                class="block"
        >
        @error('first_name') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="ml-2">
        <label class="block font-pop text-base">{{__('Last Name')}}</label>
        <input type="text"
                wire:model="last_name"
                placeholder="{{__('Last Name')}}"
                class="block"
        >
        @error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div>
        <label class="block font-pop text-base">{{__('Gender')}}</label>
        <div class="flex justify-between">
            <div class="mt-1 px-2">
                <label class="text-blue-500">{{ __('M') }}</label>
                <input type="radio"
                wire:model="gender"
                wire:change="birthday_limits"
                class="form-check-input h-4 w-4"
                value="Male">
            </div>

            <div class="mt-1 ml-4 px-4">
                <label class="text-blue-500">{{ __('F') }}</label>
                <input type="radio"
                wire:model="gender"
                wire:change="birthday_limits"
                class="form-check-input h-4 w-4 rounded-full"
                value="Female">
            </div>
        </div>
        @error('gender') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div>
        <label class="block font-pop text-base">{{__('Birthday')}}</label>
        <input type="date"
                wire:model="birthday"
                min="{{$birthday_min}}"
                max="{{$birthday_max}}"
                placeholder="{{__("Birthday")}}"
                class="w-1/8 block"
        >
        @error('birthday') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    <div class="ml-2">
        <label class="block font-pop text-base">{{__('Action')}}</label>
        <button wire:click="addPlayer" class="block bg-green-500 px-2 py-2 rounded-lg  text-black hover:text-white">
            {{ __('Add')}}
        </button>
    </div>
</div>
