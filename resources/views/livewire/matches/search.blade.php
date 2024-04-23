<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="block font-pop font-semibold text-normal">
            {{__('Search')}}
            <i class="mdi mdi-book-search-outline" style="font-size: 1.5rem;"></i>
        </label>
        <div>
            <input class="form-control px-2 py-2 border border-blue-600"
                wire:model="search"
                placeholder="{{__($search_label)}}"
            >
        </div>
    </div>
    @if (Auth::user()->IsAdmin())
        <div>
            <label class="font-pop font-semibold text-normal">{{__('Coach')}}</label>
                <x-select2 class="w-auto bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline"
                    name="user_id"
                    id="user_id"
                    wire:model="user_id"
                    :options="$this->coachs"
                />
        </div>
    @endif
</div>