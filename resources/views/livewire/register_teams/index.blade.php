<div>
    @if(!count($categoriesIds))
    <div class="border-2 border-collapse mx-auto justify-center items-center text-center">
        <label class="mx-auto text-center text-3xl text-red-500 items-center font-bold font-pop mt-2 mb-2">
            {{ __('Confirmation') }}
        </label>

        <label class="mx-auto text-center text-3xl text-red-500 items-center font-bold font-pop mt-4 block">
            {{ __('Your teams have been successfully registered.') }}
        </label>

        <label class="mx-auto text-center text-3xl text-red-500 items-center font-bold font-pop mt-4 block">
            {{ __('It is time to add your roster of players click on Add Players') }}
        </label>

        <button style="background-color:rgba(31,41,55,var(--tw-bg-opacity))" class="px-4 py-2 font-semibold text-sm text-white  rounded-md shadow-sm ring-1 ring-slate-900/5 border-green-500 border-2 border-solid hover:text-green-500" title="Change Languaje">
            <a href="/language/en">{{__('English')}}</a>
        </button>
    </div>
    @else
        @include('livewire.register_teams.form')
    @endif
</div>