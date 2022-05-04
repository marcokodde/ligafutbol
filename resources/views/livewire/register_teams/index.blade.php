<div>
    @if(!count($categoriesIds))
    <div class=" border-2 border-collapse mx-auto justify-center items-center text-center">
        <label class=" mx-auto text-center text-3xl text-red-500 items-center font-bold font-pop mt-2">
            {{ __('You Do Not Have Teams to Register') }}
        </label>
    </div>
    @else
        @include('livewire.register_teams.form')
    @endif
</div>