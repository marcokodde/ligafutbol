<div class="mx-auto text-center items-center">
    <label class="block lg:text-xl sm:text-sm text-gray-600 font-bold mb-2">
        {{__("Step 3 of 3")}}
    </label>
    <label class="lg:text-2xl sm:text-base font-normal text-gray-500 font-pop mb-4 mt-4 text-center">
        {{__("Payments and security")}}:
    </label>
</div>
<br>
<div id="card-errors" class="alert-error hide alert-danger text-center text-lg font-semibold" role="alert">
</div>
@if (Session::has('success'))
    <div class="alert alert-primary text-center">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
<div class="relative rounded-xl overflow-auto mt-4">
    <div class="flex flex-wrap items-center justify-center sm:flex-wrap-reverse">
        {{--  Datos Personales  --}}
        <div class="sm:justify-start lg:justify-center md:justify-center">
            <div class="sm:mt-0">
                <label class="font-pop font-normal text-gray-600 mb-2" for="password">{{ __('Create a new password') }}</label>
                <input class="block mt-2 lg:w-56 sm:w-32 mb-2"
                    type="password"
                    wire:model.lazy="password"
                    placeholder="{{ __('Password') }}"
                    name="password"
                    id="password"
                required>
                @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="lg:mt-8">
                <label class="font-pop font-normal text-gray-600 mt-6" for="password_confirmation">{{ __('Confirm a new password') }}</label>
                <input class="block lg:w-56 sm:w-32 mt-2 mb-2"
                    type="password"
                    wire:model.lazy="password_confirmation"
                    placeholder="{{ __('Confirm Password') }}"
                    name="password_confirmation"
                    id="password_confirmation"
                required>
                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="font-pop font-normal text-gray-600 mt-2" for="name">{{ __('Name on card') }}</label>
                <input class='block lg:w-56 sm:w-32 card-name'
                size='16' maxlength="50" type='text' name='name'
                placeholder="{{__("Name on Card")}}"
                required>
                @error('card-name') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
        {{--  Datos de PAgo  --}}
        <div class="lg:ml-20">
            <div class="mb-2">
                <label class="font-pop font-normal text-gray-600 mb-4" for="name">{{ __('Number Card') }}</label>
                <input autocomplete='off' aria-invalid="false"
                class='block card-num lg:w-56 sm:w-32 mt-2' spellcheck="false"
                inputmode="numeric"
                minlength="16"
                value="4242424242424242"
                maxlength="16" type='text' placeholder="{{__('Card Number')}}" required>
                @error('card-num') <span class="text-red-500">{{ $message }}</span>@enderror
                <div class="FormFieldInput-Icons inline mb-4" style="opacity: 1;">
                    <div style="transform: none;">
                        <span class=" ml-2 FormFieldInput-IconsIcon is-visible">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="24" viewBox="0 0 42 24" class="inline PaymentLogo variant-- "><title>Visa</title><path fill="var(--paymentLogoColor, #191E70)" d="M20.8 5.31L17.97 18.9h-3.43l2.83-13.58h3.43zm14.23 8.78l1.82-5.12 1.01 5.12h-2.83zm3.84 4.8H42L39.27 5.31h-2.92c-.61 0-1.22.42-1.42 1.05l-5.05 12.53h3.54l.7-1.98h4.35l.4 1.98zm-8.88-4.49c0-3.55-4.75-3.76-4.75-5.33.1-.73.7-1.15 1.41-1.15 1.11-.1 2.33.1 3.34.63l.6-2.92A8.36 8.36 0 0 0 27.46 5c-3.33 0-5.75 1.88-5.75 4.5 0 1.98 1.71 3.02 2.92 3.65 1.32.62 1.82 1.04 1.72 1.67 0 .94-1 1.36-2.02 1.36a8.37 8.37 0 0 1-3.53-.84l-.6 2.92c1.2.53 2.52.74 3.73.74 3.73.1 6.06-1.78 6.06-4.6zM15.95 5.31L10.5 18.9H6.87L4.14 8.03c0-.52-.4-.94-.8-1.15A11.5 11.5 0 0 0 0 5.73l.1-.42h5.76c.8 0 1.4.63 1.51 1.36l1.41 7.83 3.64-9.19h3.53z"></path></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="16" viewBox="0 0 85 16" class="inline PaymentLogo variant-- "><title>Mastercard</title><g fill="none" fill-rule="evenodd"><g stroke="#427FBC" stroke-linecap="square"><path stroke-opacity=".1" d="M1003.5-6508V7929" fill="var(--paymentLogoColor, null)"></path><path stroke-opacity=".15" stroke-dasharray="3,5" d="M733.5-6508V7929M463.5-6508V7929M193.5-6508V7929" fill="var(--paymentLogoColor, null)"></path><path stroke-opacity=".1" d="M-76.5-6508V7929" fill="var(--paymentLogoColor, null)"></path></g><g fill-rule="nonzero"><path d="M36.1 4.99c-.6 0-1.4.2-1.8.9-.3-.5-.9-.9-1.7-.9-.5 0-1.1.1-1.5.7v-.6H30v4.9h1.1v-2.7c0-.8.6-1.3 1.3-1.3.7 0 1.1.5 1.1 1.3v2.7h1.1v-2.7c0-.8.6-1.3 1.3-1.3.7 0 1.1.5 1.1 1.3v2.7h1.09v-3c0-1.2-.8-2-2-2zm6.88.8c-.3-.4-.8-.7-1.5-.7-1.4 0-2.4 1.1-2.4 2.6s1.1 2.6 2.4 2.6c.7 0 1.2-.3 1.5-.7v.4h1.1v-4.9h-1.1v.7zm-1.4 3.4c-.9 0-1.5-.7-1.5-1.6 0-.9.6-1.6 1.5-1.6s1.5.7 1.5 1.6c0 .9-.6 1.6-1.5 1.6zm6.2-2.1l-.5-.1c-.4-.1-.8-.2-.8-.5s.3-.6.9-.6c.6 0 1.2.2 1.5.4l.5-.8c-.5-.3-1.2-.5-2-.5-1.2 0-2 .6-2 1.6 0 .8.6 1.3 1.6 1.4l.5.1c.6.1.8.3.8.5 0 .4-.4.6-1.1.6-.8 0-1.3-.2-1.6-.5l-.5.8c.7.5 1.6.6 2.1.6 1.4 0 2.2-.7 2.2-1.6.1-.8-.5-1.2-1.6-1.4zm5.4 2.1c-.4 0-.8-.3-.8-.9v-2.1h1.9v-1h-1.9v-1.5h-1.1v1.5h-1v1h1v2.1c0 1.3.6 1.9 1.7 1.9.6 0 1.1-.2 1.5-.5l-.4-.9c-.3.2-.6.4-.9.4zm4.39-4.2c-1.4 0-2.4 1-2.4 2.6s1 2.6 2.5 2.6c.7 0 1.4-.2 2-.7l-.5-.8c-.4.3-.9.5-1.4.5-.7 0-1.3-.4-1.4-1.2h3.6v-.4c-.1-1.5-1-2.6-2.4-2.6zm-1.3 2.2c.1-.7.5-1.2 1.3-1.2.7 0 1.1.4 1.2 1.2h-2.5zm5.9-1.5v-.6h-1.1v4.9h1.1v-2.7c0-.8.5-1.3 1.2-1.3.3 0 .6.1.79.2l.3-1.1c-.2-.1-.5-.1-.8-.1-.7 0-1.2.2-1.5.7zm4.99.3c.5 0 .8.2 1.2.5l.7-.7c-.4-.5-1.1-.8-1.8-.8-1.5 0-2.6 1.1-2.6 2.6s1 2.6 2.6 2.6c.7 0 1.4-.3 1.8-.8l-.7-.7c-.3.3-.7.5-1.2.5-.8 0-1.4-.6-1.4-1.6s.6-1.6 1.4-1.6zm6.39-.2c-.3-.4-.8-.7-1.5-.7-1.4 0-2.4 1.1-2.4 2.6s1.1 2.6 2.4 2.6c.7 0 1.2-.3 1.5-.7v.4h1.1v-4.9h-1.1v.7zm-1.4 3.4c-.9 0-1.5-.7-1.5-1.6 0-.9.6-1.6 1.5-1.6s1.5.7 1.5 1.6c0 .9-.6 1.6-1.5 1.6zm5.1-3.5v-.6h-1.1v4.9h1.1v-2.7c0-.8.5-1.3 1.2-1.3.3 0 .6.1.8.2l.3-1.1c-.2-.1-.5-.1-.8-.1-.7 0-1.2.2-1.5.7zm6.39-3v3c-.3-.4-.8-.7-1.5-.7-1.4 0-2.4 1.1-2.4 2.6s1.1 2.6 2.4 2.6c.7 0 1.2-.3 1.5-.7v.5h1.1v-7.3h-1.1zm-1.4 6.5c-.9 0-1.5-.7-1.5-1.6 0-.9.6-1.6 1.5-1.6s1.5.7 1.5 1.6c0 .9-.6 1.6-1.5 1.6z" fill="var(--paymentLogoColor, #0A2540)"></path><path d="M10.12 7.59c0-2.4 1.1-4.5 2.8-5.9-1.3-1-2.9-1.6-4.6-1.6C4.22 0 .93 3.4.93 7.6s3.3 7.59 7.4 7.59c1.7 0 3.29-.6 4.59-1.6a7.96 7.96 0 0 1-2.8-6z" fill="var(--paymentLogoColor, #ED0006)"></path><path d="M17.51 0c-1.7 0-3.3.6-4.6 1.6a7.6 7.6 0 0 1 0 11.78c1.3 1 2.9 1.6 4.6 1.6 4.1 0 7.4-3.4 7.4-7.5C24.9 3.4 21.6 0 17.5 0z" fill="var(--paymentLogoColor, #F9A000)"></path><path d="M15.71 7.59c0-2.4-1.1-4.5-2.8-5.9-1.7 1.4-3.79 3.5-3.79 5.9 0 2.4 2 4.5 3.8 5.89a7.6 7.6 0 0 0 2.8-5.9z" fill="var(--paymentLogoColor, #FF5D00)"></path></g></g></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="24" viewBox="0 0 85 24" class="inline PaymentLogo variant-- "><title>American Express</title><g fill="none" fill-rule="evenodd"><path fill="var(--paymentLogoColor, #017ECD)" fill-rule="nonzero" d="M25.45 11.51v-1.28c0-.5-.5-.99-1-.99h-1.4v2.27h-1.51V5.1h3.7c.9-.1 1.8.5 1.9 1.38v.5c0 .59-.3 1.18-.9 1.47.5.3.8.9.7 1.48v1.58h-1.5zm-2.5-3.75h1.6c.3.1.7-.1.8-.4.1-.29-.1-.68-.4-.78h-2v1.18zm21.33 3.75l-2.4-4.34v4.34h-3.01l-.5-1.38h-2.8l-.5 1.38h-3.21s-2-.3-2-3.06c0-3.35 1.7-3.45 2.4-3.45h1.9v1.48h-1.5c-.7.1-1.2.7-1.1 1.38v.5c0 2.17 2.6 1.48 2.7 1.48L36.16 5h2.1l2.31 5.82V5.1h2.1l2.41 4.24V5.1h1.5v6.51l-2.3-.1zm-8.01-2.96h1.5l-.7-1.87-.8 1.87zm-22.75 2.96V7.07l-1.9 4.44h-1.2l-1.9-4.44v4.44H5.5l-.5-1.38H2.2l-.5 1.38H0L2.5 5h2.1l2.31 5.92V5.1h2.4l1.71 4.04 1.7-4.04h2.4v6.51l-1.6-.1zM2.81 8.55h1.5l-.7-1.87-.8 1.87zm13.12 2.96V5.1h4.7v1.48h-3.2v.99h3.1v1.48h-3.1v1.08h3.2v1.38h-4.7zm11.82.1V5.1h1.5v6.51h-1.5zm3.3 8.3v-1.3c0-.58-.5-.98-1.1-.98h-1.6v2.27h-1.6V13.5h3.9c1-.2 1.9.49 2 1.48v.4c0 .58-.3 1.18-.9 1.47.5.3.8.89.8 1.48v1.58h-1.5zm-2.6-3.76h1.7c.3.1.7-.1.8-.4.1-.29-.1-.68-.4-.78a.3.3 0 0 0-.4 0h-1.7v1.18zm-8.11 3.75h-1.4l-1.7-1.87-1.71 1.87H9.52V13.5h5.9l1.81 2.07 1.9-2.07h5.11c1-.1 1.9.49 2 1.48v.4c0 1.87-.7 2.46-2.8 2.46h-1.6v2.07h-1.5zm-2-3.16l2 2.27v-4.44l-2 2.17zm-7.22 1.78h3.4l1.6-1.78-1.6-1.77h-3.4v.98h3.3v1.48h-3.3v1.09zm10.82-2.37h1.7c.3.1.7-.1.8-.4.1-.29-.1-.68-.4-.78a.3.3 0 0 0-.4 0h-1.7v1.18zm20.14 3.75h-2.9v-1.48h2.5s.9.1.9-.5c0-.58-1.4-.49-1.4-.49-1.1.2-2-.59-2.2-1.57v-.3c-.11-.99.7-1.88 1.7-1.97h3.4v1.38h-2.5s-.9-.2-.9.5c0 .48 1.2.48 1.2.48s2.5-.2 2.5 1.78c.1 1.09-.6 2.07-1.8 2.27h-.4l-.1-.1zm-8.62 0V13.5h5.01v1.48h-3.4v.98h3.3v1.48h-3.3v1.09h3.4v1.38h-5zm14.23 0h-2.9v-1.48h2.5s.9.1.9-.5c0-.58-1.4-.49-1.4-.49-1.1.2-2-.59-2.2-1.67v-.3c-.1-.99.7-1.87 1.7-1.97h3.4v1.48h-2.5s-.9-.2-.9.5c0 .48 1.2.48 1.2.48s2.5-.2 2.5 1.78c.1 1.09-.6 2.07-1.8 2.27h-.4c0-.1 0-.1-.1-.1z"></path><path d="M0 0h50v24H0z" fill="var(--paymentLogoColor, null)"></path></g></svg>
                        </span>
                    </div>
                </div>
            </div>
            <label class="font-pop font-normal text-gray-600 mt-2 mb-2" for="name">{{ __('Expiration Date') }}</label>
            <div class="grid lg:grid-cols-2">
                <div class='form-group expiration required mb-2 mt-2'>
                    <input class='lg:w-40 card-expiry-month'
                        placeholder='{{__('Month')}}' size='8' maxlength="2" type='text' inputmode="numeric"
                        required>
                        @error('card-expiry-month') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="form-group lg:ml-2 sm:ml-0 mb-2 mt-2">
                    <input class='lg:w-40 card-expiry-year'
                        placeholder='{{__('Year')}}' size='8' maxlength="4" type='text' inputmode="numeric"
                        required>
                        @error('card-expiry-year') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class='grid grid-col-1'>
                <div class="form-group sm:ml-0 mb-2 mt-2">
                    <label class="font-pop font-normal text-gray-600" for="card-cvc">{{ __('CVV') }}</label>
                    <input autocomplete='off' class='block lg:w-40 sm:w-32 card-cvc' placeholder='CVV'
                    size='8' maxlength="4" minlength="3" type='password' inputmode="numeric" required>
                    @error('card-cvc') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mx-auto items-center text-center">
    <label class="block text-lg text-black font-semibold font-pop mb-2 mt-2 justify-center text-center">
        {{__("By clicking confirm, I authorize to register")}} {{$total_teams}} {{__('teams, for a total of:')}} ${{number_format($price_total)}}
    </label>
</div>

<div>
    <input hidden wire:model="price_total" id="price_total" name="price_total">
    <input hidden wire:model="total_teams" id="total_teams" name="total_teams">
    <input hidden id="id_user" name="id_user" value="{{$useradd->id}}">

    @php $k=0 @endphp
    @foreach($categories as $category)
        <input class="categoriesIds"
            name="categoriesIds[]"
            value="{{$categoriesIds[$k]}}"
            hidden
        >
        <input name="quantity_teams[]"
            value="{{$quantity_teams[$k]}}"
            hidden
        >
        @php $k++ @endphp
    @endforeach
</div>