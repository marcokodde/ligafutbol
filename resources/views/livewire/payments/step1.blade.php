<div class="mx-auto text-center items-center">
    <label class="lg:text-2xl sm:text-base font-medium text-gray-500 font-pop mt-2 mb-4">{{__("Select the number of teams you want to register in each category")}}</label>
</div>
<br>
<div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1 md:grid-cols-2 md:gap-2">
    <div>
    </div>
        <div class="grid grid-cols-2 gap-8 2xl:gap-4">
            @foreach($categories as $category)
                <div class="flex items-center text-center md:justify-between">
                    <label class="text-gray-600 font-pop font-medium 2xl:text-2xl lg:text-lg">{{$category->name}}</label>
                    <div class="mx-auto px-auto">
                        <input wire:model="quantity_teams.{{ $category->id }}"
                        wire:change="calculateTeams()"
                        type="number"
                        min="0"
                        max="100"
                        class="appearance-none border rounded-lg text-gray-700 focus:outline-none focus:shadow-outline">
                    </div>

                    <div>
                        <input class="categoriesIds" wire:model="categoriesIds.{{ $category->id }}" id="categoriesIds" name="categoriesIds.{{ $category->id }}"
                        value="categoriesIds.{{ $category->id }}" hidden>
                        <input class="quantity_teams" wire:model="quantity_teams.{{ $category->id }}" id="quantity_teams" name="quantity_teams.{{ $category->id }}"
                        name="quantity_teams.{{ $category->id }}" hidden>
                    </div>
                </div>

            @endforeach
        </div>
    <div>
    </div>
</div>
<br>
<div class="mb-2 items-center text-center align-center mt-4">
    <input type="text"
    wire:model.lazy="price_total"
    id="price_total"
    name="price_total" hidden>

    @if ($total_teams && $records)
        <label class="block lg:text-xl sm:text-base font-medium text-black font-pop mt-2 justify-center text-center lg:-ml-12">
        @foreach ($records as $record)
            @if (isset($record->cost))
                {{__('Price per team:')}} ${{number_format($record->cost, 2, '.', '')}} {{__("(Total $total_teams")}} {{__("teams)")}}</label>
            @endif
        @endforeach
    @endif
    <br>
    <label class="inline text-2xl text-gray-700 font-extrabold font-pop mt-2 m-2 lg:-ml-28">{{__('Total')}}</label>
    <input type="number"
        placeholder="{{$total_teams}} {{__('Teams per')}} ${{number_format($price_total, 2, '.', ',')}}"
        disabled
        style="border-color:rgba(31,41,55,var(--tw-bg-opacity))"
        class="w-auto px-12 py-2 border-2 inline text-black leading-tight rounded-lg">
</div>
