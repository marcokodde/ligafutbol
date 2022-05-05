<div class="flex flex-wrap mt-2">
    <div>
        <label class="block font-pop text-base">{{__('First Name')}}</label>
        <input type="text"
                wire:model="first_name"
                maxlength="30"
                minlength="5"
                placeholder="{{__('First Name')}}"
                class="block  @error('first_name')  bg-red-500  @enderror"
        >

    </div>

    <div class="lg:ml-2 sm:ml-0">
        <label class="block font-pop text-base">{{__('Last Name')}}</label>
        <input type="text"
                wire:model="last_name"
                placeholder="{{__('Last Name')}}"
                class="block  @error('last_name')  bg-red-500  @enderror"
        >

    </div>
        <div>
            <label class="block font-pop text-base">{{__('Birthday')}}</label>
            <input type="date"
                    wire:model="birthday"
                    min="{{$birthday_min}}"
                    max="{{$birthday_max}}"
                    placeholder="{{__("Birthday")}}"
                    class="block  w-11/12 @error('birthday')  bg-red-500  @enderror"
            >
        </div>
    <div>
        <label class="block font-pop text-base">{{__('Gender')}}</label>
        <div class="flex justify-between @error('gender') bg-red-500 @enderror">
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

    </div>
    <div class="ml-2">

        <label class="block font-pop text-base">&nbsp;</label>
        <button wire:click="addingPlayer" @if ($team->players->count()+1 == $general_settings->max_players_by_team) onclick="players_full()" @endif class="block bg-green-500 px-4 py-2 rounded-lg  text-black hover:text-white">
            {{ __('Add')}}
        </button>
    </div>
</div>
