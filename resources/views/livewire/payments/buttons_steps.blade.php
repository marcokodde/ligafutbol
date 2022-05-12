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
<script>
    function add_user() {
        Livewire.emit('AddUser')
    }
</script>
