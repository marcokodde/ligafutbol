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
    @if($phone && $email && !$same_phone_and_email)
        <div class="sm:justify-start lg:justify-center md:justify-center">
            <label class="block lg:text-2xl sm:text-base text-red-500 mb-4">
                {{__("Phone or email already exists, but they do not correspond to each other")}}
            </label>
        </div>
    @endif
    {{--  Datos Personales  --}}
    <div class="sm:justify-start lg:justify-center md:justify-center">
        <div class="card lg:w-1/4 sm:w-1/2 mx-auto justify-center">
            <label class="block lg:text-2xl sm:text-base text-gray-500 mb-4">{{__("Trainer personal data")}}</label>
            <div class="mb-4 mt-2">
                <label class="block font-pop lg:text-left lg:ml-24 sm:text-center font-medium text-gray-600" for="fullname">{{ __('Full Name') }}</label>
                <input class="lg:w-56 sm:w-32
                    @error('fullname')
                        border-red-600 border-2 border-collapse
                    @enderror "
                    type="text"
                    wire:model.lazy="fullname"
                    placeholder="{{ __('Full Name') }}"
                    name="fullname"
                    id="fullname"
                    required
                >

            </div>

            <div class="mb-4">
                <label class="block lg:text-left lg:ml-24 sm:text-center font-pop font-medium text-gray-600" for="phone">{{ __('Phone') }}</label>
                <input class="lg:w-56 sm:w-32
                    @error('phone')
                        border-red-600 border-2 border-collapse
                    @enderror"
                    type="text"
                    wire:model.lazy="phone"
                    wire:change="validate_phone_and_email"
                    placeholder="{{ __('Phone') }}"
                    name="phone"
                    id="phone"
                    maxlength="10"
                    minlength="7"
                    required>

            </div>
            <div class="mb-4">
                <label class="block lg:text-left lg:ml-24 sm:text-center font-pop font-medium text-gray-600" for="email">{{ __('Email') }}</label>
                <input class="lg:w-56 sm:w-32
                    @error('email')
                        border-red-600 border-2 border-collapse
                    @enderror"
                    type="email"
                    wire:model.lazy="email"
                    wire:change="validate_phone_and_email"
                    placeholder="{{ __('Email') }}"
                    name="email"
                    id="email"
                required>
            </div>
        </div>
        <p><a href="https://equipos.galvestoncup.com/terms_and_conditions" target="_blank" class="text-blue-500 underline">{{__("I Accept Terms and Conditions,  No Refunds!")}}</a></p>
    </div>
</div>
