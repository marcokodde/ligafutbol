
<div class="border-gray-100 dark:border-gray-700 p-6 border-t flex justify-end">
    <div class="bg-gray-50 flex mx-4 px-2">
        <span class="mx-2">
            <button wire:click="closeModal()" type="button" class="button red rounded-lg hover:text-black">
                {{__("Cancel")}}
            </button>
        </span>
        <span class="mx-2">
            <button wire:click.prevent="store()" type="button" class="button green rounded-lg hover:text-black">
                {{__("Save")}}
            </button>
        </span>
    </div>
</div>
