<div class="flex text-center items-center justify-center bg-gray-50 sm:px-6">
    @if ($currentPage === 1)
        <div></div>
    @elseif($currentPage === 2)
        <button wire:click="goToPreviousPage" type="button" style="background-color: #DCC742"
            class="button mx-2 px-8 py-4 mt-4 text-black font-semibold rounded-lg hover:text-white">
            {{__("Go Back")}}
        </button>
    @else
        <button type="button"
                wire:click="goToPreviousPage"
                id="go_back"
                style="background-color: #DCC742"
                class="button mx-2 px-8 py-4 mt-4  text-black font-semibold rounded-lg hover:text-white"
            >
        {{__("Go Back")}}
    </button>
    @endif
    @if ($currentPage === count($pages) && $accept_terms)
        <button type="submit"
                id="submit_form"
                class="button blue mx-2 px-8 py-4 mt-4 font-semibold rounded-lg hover:text-black">
            {{__("Confirm Payment")}}
        </button>
    @elseif($currentPage === 2)
        @if ($total_teams && !Auth::user())
            <button wire:click="goToNextPage" type="button" class="button blue mx-2 px-8 py-4 mt-4 font-semibold  rounded-lg hover:text-black">
                {{__("Next")}}
            </button>
        @endif
        @auth
            @if ($total_teams )
                <button wire:click="register_by_admin"
                    type="button"
                    id="submit_form"
                    class="block button blue rounded-lg mx-2 px-8 py-4 mt-4 font-semibold hover:text-black">
                    {{__("Next")}}
                </button>
                <div wire:loading wire:target="register_by_admin">
                    <button type="button" class="text-2xl font-pop font-semibold rounded-lg mx-2 px-8 py-4 text-white bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                        <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{__('Processing Reservation...')}}
                    </button>
                </div>
            @endif
        @endauth
    @else
        @if ($fullname && $phone && $email && $same_phone_and_email && $currentPage === 1)
            <button wire:click="goToNextPage_and_create_user_without"
                type="button"
                class="block button blue rounded-lg mx-2 px-8 py-4 mt-4 font-semibold hover:text-black">
                {{__("Next")}}
            </button>
        @endif
    @endif
</div>
