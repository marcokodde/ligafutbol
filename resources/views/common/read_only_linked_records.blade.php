<div class="inline bg-white overflow-hidden shadow-xl sm:rounded-lg px-2 py-2 m-4">
    <label class="font-semibold justify-start items-start text-base"> {{__('Show Only Linked Records')}}</label>
    <input type="checkbox" class="form-checkbox border-2 h-6 w-6 text-gray-600 border-red-600"
        wire:click="$toggle('only_linked')"
    >
</div>