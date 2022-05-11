<div>
    @if(!count($categoriesIds))
    <div class="border-2 border-collapse mx-auto justify-center items-center text-center">
        <label class="mx-auto text-center text-3xl text-red-500 items-center font-bold font-pop mt-4 block">
            {{ __('Your teams have been successfully registered.') }}
        </label>
    </div>
    @elseif($user_token &&  $show_token)
        <div class="border-2 border-collapse mx-auto justify-center items-center text-center">
            <label class="mx-auto text-center text-3xl text-blue-600 items-center font-bold font-pop mt-2 mb-2">
                {{ __('Confirmation') }}
            </label>

            <label class="mx-auto text-center text-3xl text-blue-600 items-center font-bold font-pop mt-4 block">
                {{ __('Your teams have been successfully registered.') }}
            </label>

            <label class="mx-auto text-center text-3xl text-blue-600 items-center font-bold font-pop mt-4 block">
                {{ __('It is time to add your roster of players click on Add Players.') }}
            </label>
            <div class="p-6 m-4">
                @php
                    $url_player = "https://equipos.galvestoncup.com/register_players/";
                    $url_test = "http://galvestoncup.test/register_players/";
                @endphp
                <button style="background-color:rgba(31,41,55,var(--tw-bg-opacity))" class="px-12 py-4 font-semibold text-sm text-white  rounded-md shadow-sm ring-1 ring-slate-900/5 border-green-500 border-2 border-solid hover:text-green-500" title="Add Rosters">
                    <a href="{{$url_test.''.$user_token->token_register_players}}">
                        {{__('Add Roster to players')}}
                    </a>
                </button>
            </div>
        </div>
    @else
        @include('livewire.register_teams.form')
    @endif
</div>