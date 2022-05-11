<div class="mx-auto text-center items-center">
    <label class="block lg:text-xl sm:text-sm text-gray-600 font-bold mb-2">
        {{__("Step 1 of 3")}}
    </label>
    <label class="lg:text-2xl font-normal sm:text-base text-gray-500 font-pop mt-2 mb-4">
        {{__("Welcome! to start, please fill in the information below:")}}
    </label>
</div>
<br>
<div class="mx-auto text-center items-center">
    {{--  Datos Personales  --}}
    <div class="sm:justify-start lg:justify-center md:justify-center">
        <div class="card lg:w-1/4 sm:w-1/2 mx-auto justify-center">
            <label class="block lg:text-2xl sm:text-base text-gray-500 mb-4">{{__("Trainer personal data")}}</label>
            <div class="mb-4 mt-2">
                <label class="block font-pop lg:text-left lg:ml-24 sm:text-center font-medium text-gray-600" for="fullname">{{ __('Full Name') }}</label>
                <input class="lg:w-56 sm:w-32"
                    type="text"
                    wire:model.lazy="fullname"
                    placeholder="{{ __('Full Name') }}"
                    name="fullname"
                    id="fullname"
                required>
                @error('fullname') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
    
            <div class="mb-4">
                <label class="block lg:text-left lg:ml-24 sm:text-center font-pop font-medium text-gray-600" for="phone">{{ __('Phone') }}</label>
                <input class="lg:w-56 sm:w-32"
                    type="text"
                    wire:model.lazy="phone"
                    placeholder="{{ __('Phone') }}"
                    name="phone"
                    id="phone"
                    maxlength="10"
                    minlength="7"
                required>
                @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block lg:text-left lg:ml-24 sm:text-center font-pop font-medium text-gray-600" for="email">{{ __('Email') }}</label>
                <input class="lg:w-56 sm:w-32"
                    type="email"
                    wire:model.lazy="email"
                    placeholder="{{ __('Email') }}"
                    name="email"
                    id="email"
                required>
                @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>