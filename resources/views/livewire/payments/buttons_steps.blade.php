@if (Auth::user() && Auth::user()->isCoach())
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
        <button type="submit"
                id="submit_form"
                class="button blue mx-2 px-8 py-4 mt-4 font-semibold rounded-lg hover:text-black">
            {{__("Confirm Payment")}}
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
@else
<div class="flex text-center items-center justify-center bg-gray-50 sm:px-6">
    @if ($currentPage === 1)
        <div></div>
    @elseif($currentPage === 2)
        {{--  <button wire:click="goToPreviousPage" type="button" style="background-color: #DCC742"
            class="button mx-2 px-8 py-4 mt-4 text-black font-semibold rounded-lg hover:text-white">
            {{__("Go Back")}}
        </button>  --}}
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
    @if ($currentPage === count($pages))
        <button type="submit"
                id="submit_form"
                class="button blue mx-2 px-8 py-4 mt-4 font-semibold rounded-lg hover:text-black">
            {{__("Confirm Payment")}}
        </button>
    @elseif($currentPage === 2)
        @if ($total_teams)
            <button wire:click="goToNextPage" type="button" class="button blue mx-2 px-8 py-4 mt-4 font-semibold  rounded-lg hover:text-black">
                {{__("Next")}}
            </button>
        @endif
    @else
        @if ($fullname && $phone && $email)
        <button wire:click="goToNextPage" onclick="add_user()" type="button"
            class="block button blue rounded-lg mx-2 px-8 py-4 mt-4 font-semibold hover:text-black">
            {{__("Next")}}
        </button>
        @endif
    @endif
</div>
@endif

<script>
    function add_user() {
        Livewire.emit('AddUser')
    }
</script>
