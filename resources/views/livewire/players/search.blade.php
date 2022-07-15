<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="inline font-pop font-semibold text-normal">{{__('Search')}}</label>
        <div>
            <input class="form-control px-2 py-2 border"
                wire:model="search"
                placeholder="{{__($search_label)}}"
            >
        </div>
    </div>
    <div>
        <label class="font-pop font-semibold text-normal">{{__('Coach')}}</label>
        <div>
            <select wire:model="user_id"  class="form-control form-select mb-2">
                <option>{{ __('Coach') }}</option>
                @foreach ($coachs as $coach)
                    <option value="{{ $coach->id }}">
                        {{ $coach->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
   
</div>