<div class="mx-auto text-center items-center">
    <label class="lg:text-2xl sm:text-base font-bold mt-2">{{__("Select the number of teams you want to register in each category")}}</label>
</div>

<div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1">
    <div>
    </div>
        <div class="grid grid-cols-2">
            @foreach($categories as $category)

                <div class="flex mx-auto items-center text-center">
                    <label class="text-xl text-center text-gray-700 font-bold mb-2 mt-2">{{$category->name}}</label>
                    <input  wire:model="quantity_teams.{{ $category->id }}"
                    wire:change="calculateTeams()"
                    type="number"
                    min="0"
                    max="100"
                    class="w-32 m-2 p-2 mx-auto text-center items-center appearance-none border rounded-full text-gray-700 focus:outline-none focus:shadow-outline">
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
<div class="mb-2 items-center text-center align-center">
    <input type="text"
        wire:model.lazy="price_total"
        id="price_total"
        name="price_total" hidden>
        @if ($total_teams)
            <label class="block text-xl text-black font-bold mt-2 justify-center text-center lg:-ml-12">{{__('Total teams #')}}  {{$total_teams}}, {{__('Price for Teams')}} ${{number_format($price_total, 2, '.', '')}}</label>
        @endif
        <label class="inline text-2xl text-black font-bold mt-2 m-2 lg:-ml-28">{{__('Total')}}</label>
        <input type="number"
            placeholder="{{__('Total')}} ${{number_format($price_total, 2, '.', ',')}}"
            disabled
            class="w-auto px-12 py-2 border-2 border-orange-300 inline text-black leading-tight rounded-lg">
</div>
