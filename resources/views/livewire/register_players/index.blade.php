<div>
    @if(!$user && $categories && $categories->count())
        <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
            {{ __('You Do Not Have Players to Register') }}
        </label>
    @else
        @if(!$categories || !$categories->count())
            <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
                {{ __('We Do Not Found Categories To Register Players') }}
            </label>
            <br>
            <label class=" text-3xl text-red-500 text-center font-bold mb-2 mt-2">
                {{ __('Maybe you need to register your teams') }}
            </label>

        @else
            @include('livewire.register_players.form')
        @endif

    @endif
</div>
