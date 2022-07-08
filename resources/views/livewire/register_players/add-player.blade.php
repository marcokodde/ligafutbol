<div>
    <div class="flex text-center">
        <div wire:loading.delay wire:target="addingPlayer" class="px-4 mx-4 mt-2 ">
            <button type="button" class="text-2xl font-semibold text-white transition duration-150 ease-in-out bg-indigo-500 rounded-lg cursor-not-allowed font-pop hover:bg-indigo-400" disabled="">
                <svg class="inline w-6 h-6 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{__('Adding Player at Team')}}
            </button>
        </div>
    </div>

    {{-- Formulario: Nombre - Apellido - Sexo - Fecha de nacimiento --}}
    <div class="flex flex-wrap mt-2">
        {{-- Nombre(s) --}}
        <div>
            <label class="block text-base font-pop">{{__('First Name')}} @error('first_name') <label class="inline text-xl text-red-500" >*</label>@enderror</label>
        <div class="ml-2">
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

        {{-- Apellido(s) --}}
        <div class="lg:ml-2 sm:ml-0">
            <label class="block text-base font-pop">{{__('Last Name')}} @error('last_name') <label class="inline text-xl text-red-500" >*</label>@enderror</label>
        <div class="ml-2">
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

        {{-- Sexo --}}
        <div class="ml-1">
            <label class="block text-base font-pop">{{__('Gender')}}@error('gender') <label class="text-xl text-red-500" >*</label>@enderror</label>
        <div class="ml-2">
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

        {{-- Fecha de nacimiento --}}
        <div class="text-center">
            <label class="block text-base font-pop">{{__('Birthday')}}</label>
             @include('livewire.register_players.birthday_dropdowns')
             @error('birthday') <label class="text-sm text-red-500" >{{$message}}</label>@enderror
        </div>
        @if ($gender)
            <div class="text-center">
                <label class="block text-base font-pop">{{__('Birthday')}}</label>
                @include('livewire.register_players.birthday_dropdowns')
                @error('birthday') <label class="text-sm text-red-500" >{{$message}}</label>@enderror
            </div>
        @endif

        {{-- Botón Para Agregar --}}
        @if($first_name && $last_name && $gender && $birth_year && $birth_month && $birth_day)
            <span>
                <div class="ml-2">
                    <label class="block text-base font-pop">&nbsp;</label>
                    <button wire:click="addingPlayer"
                        class="block px-4 py-2 text-black bg-green-500 rounded-lg hover:text-white">
                        {{ __('Add')}}
                    </button>
                </div>
            </span>
        @endif
    </div>
</div
