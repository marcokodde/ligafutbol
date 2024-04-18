<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="block font-semibold font-pop text-normal">
            {{__('Search')}}
            <i class="mdi mdi-book-search-outline" style="font-size: 1.5rem;"></i>
        </label>
        <div>
            <input class="px-2 py-2 border border-blue-600 form-control"
                wire:model="search"
                placeholder="{{__($search_label)}}"
            >
        </div>
    </div>
</div>
