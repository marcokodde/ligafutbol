<div>
    @if(!$user && $categories && $categories->count())
        <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
            {{ __('You Do Not Have Players to Register') }}
        </label>
    @else
        @include('livewire.register_players.form')
    @endif
</div>
