<div class="grid grid-cols-4 gap-4">

    <div>
        <label class="font-pop font-semibold text-normal">{{__('Category')}}</label>
            <x-select2 class="w-auto bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline"
                name="category_id"
                id="category_id"
                wire:model="category_id"
                wire:change="read_teams"
                :options="$this->categories"
            />
    </div>

    @if($this->teams)
        <div>
            <label class="font-pop font-semibold text-normal">{{__('Team')}}</label>
                <x-select2 class="w-auto bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:shadow-outline"
                    name="team_id"
                    id="team_id"
                    wire:model="team_id"
                    :options="$this->teams"
                />
        </div>
    @endif

</div>
