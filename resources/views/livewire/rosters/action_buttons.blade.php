<div class="border-gray-100 dark:border-gray-700 p-6 border-t flex justify-end">
    {{-- @if($error_message)
        <label class="w-3/4 text-red-500 font-bold text-3xl">
            {{ $error_message}}
        </label>
    @endif --}}

    <div class="bg-gray-50 flex mx-4 px-2">
        <span class="mx-2">
            <button wire:click="clear_all_data()" type="button" class="button red rounded-lg hover:text-black">
                {{__("Cancel")}}
            </button>
        </span>
        <span class="mx-2">
            @if(count($first_names) && count($last_names) && count($genders) && count($birthdays) && $allow_create)
                <button wire:click.prevent="store()"
                        type="button"
                        class="button green rounded-lg hover:text-black">
                    {{__("Save")}}
                </button>
            @endif
        </span>
    </div>
</div>
