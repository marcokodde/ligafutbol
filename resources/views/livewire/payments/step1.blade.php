<div class="mx-auto text-center items-center">
    <label class="lg:text-2xl sm:text-base font-medium text-gray-500 font-pop mt-2">{{__("Select the number of teams you want to register in each category")}}</label>
</div>

<div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1">
    <div>
    </div>
        <div class="grid grid-cols-2 gap-2 ">
            @foreach($categories as $category)
                <div class="flex mx-auto items-center text-center">
                    <label class="text-2xl text-center text-gray-600 font-pop  font-extrabold mb-2 mt-2 mr-2">{{$category->name}}</label>
                    <input  wire:model="quantity_teams.{{ $category->id }}"
                    wire:change="calculateTeams()"
                    type="number"
                    min="0"
                    max="100"
                    class="lg:w-32 sm:w-32 m-2 p-2 mx-auto text-right items-right appearance-none border rounded-lg text-gray-700 focus:outline-none focus:shadow-outline">
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
            <label class="block lg:text-xl sm:text-base font-medium text-gray-500 font-pop mt-2 justify-center text-center lg:-ml-12">
                {{__('Price per team:')}} ${{number_format($price_total, 2, '.', '')}} {{__("(Total #$total_teams")}} {{__("teams)")}}</label>
        @endif
        <label class="inline text-2xl text-gray-700 font-extrabold font-pop mt-2 m-2 lg:-ml-28">{{__('Total')}}</label>
        <input type="number"
            placeholder="{{__('Total')}} ${{number_format($price_total, 2, '.', ',')}}"
            disabled
            class="w-auto px-12 py-2 border-2 border-orange-300 inline text-black leading-tight rounded-lg">
</div>
