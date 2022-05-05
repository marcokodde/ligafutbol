<div class="flex text-center items-center justify-center bg-gray-50  sm:px-6">
    @if ($currentPage === 1)
        <div></div>
    @elseif($currentPage === 2)
        <button wire:click="goToPreviousPage" type="button" style="background-color: #DCC742"
            class="button mx-2 px-8 py-4 mt-4 font-semibold rounded-lg hover:text-black">
            {{__("Go Back")}}
        </button>
    @else
        <button wire:click="goToPreviousPage" type="button"
        class="button red rounded-lg hover:text-black">
            <img class="h-5 w-5" src="{{ asset('image/icon_back.png') }}"  />
        </button>
    @endif
    @if ($currentPage === count($pages))
        <button type="submit" class="button blue mx-2 px-8 py-4 mt-4 font-semibold rounded-lg hover:text-black">
            {{__("Confirm Payment")}}
        </button>
    @elseif($currentPage === 2)
        @if(Auth::user()->id)
            <button wire:click="create_event_admin" class="button green rounded-lg hover:text-black">
                {{__("Confirm")}}
            </button>
        @else
            <button wire:click="goToNextPage" type="button" class="button blue mx-2 px-8 py-4  font-semibold  rounded-lg hover:text-black">
                {{__("Next")}}
            </button>
        @endif
    @else
        @if ($total_teams)
            <button wire:click="goToNextPage" type="button"
            class="button blue rounded-lg mx-2 px-8 py-4 mt-4 font-semibold hover:text-black">
                {{__("Next")}}
            </button>
        @endif
    @endif
</div>
