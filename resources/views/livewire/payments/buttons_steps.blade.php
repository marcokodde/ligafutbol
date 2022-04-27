<div class="flex items-center text-center justify-center px-4 py-3 bg-gray-50  sm:px-6">
    @if ($currentPage === 1)
        <div></div>
    @elseif($currentPage === 2)
        <button wire:click="goToPreviousPage" type="button"
            class="button red rounded-lg hover:text-black">
            {{__("Back")}}
        </button>
    @else
        <button wire:click="goToPreviousPage" type="button"
        class="button red rounded-lg hover:text-black">
            <img class="h-5 w-5" src="{{ asset('image/icon_back.png') }}"  />
        </button>
    @endif
    @if ($currentPage === count($pages))
        <button type="submit" class="button green mx-2 rounded-lg hover:text-black">
            {{__("Confirm Payment")}}
        </button>
    @elseif($currentPage === 2)
        @if(Auth::user()->id)
            <button wire:click="create_event_admin" class="button green rounded-lg hover:text-black">
                {{__("Confirm")}}
            </button>
        @else
            <button wire:click="goToNextPage" type="button" class="button blue rounded-lg hover:text-black">
                {{__("Next")}}
            </button>
        @endif
    @else
        <button wire:click="goToNextPage" type="button"
            class="button blue rounded-lg px-12 py-2 hover:text-black">
            {{__("Next")}}
        </button>
    @endif
</div>

<div class="flex justify-around">
    <span class="inline-flex rounded-md shadow-sm">
        <span wire:loading.delay  wire:target="submit"
            class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-red-600 hover:bg-red-500 focus:border-red-700 active:bg-red-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{__("Processing Payment...")}}
        </span>
    </span>
</div>