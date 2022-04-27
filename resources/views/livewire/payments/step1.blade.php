<div class="grid grid-cols-3 gap-4">
    <div>
        <img src="{{asset('images/galveston2022.png')}}" height="600px" width="400px"  alt="">
    </div>
    <div class="col-span-2">
        <label class="block text-2xl font-bold mb-2 mt-2">{{__("Seleccionar la cantidad de equipos que deseas registrar en cada categoria")}}</label>
        @foreach($categories as $category)
            <div class="flex justify-around">
                <label class="text-xl text-gray-600 font-bold mb-2 mt-2">{{$category->name}}</label>
                <input  wire:model="quantity_teams.{{ $category->id }}"
                    wire:change="calculateTeams()"
                    type="number"
                    min="0"
                    max="100"
                    class="text-left w-32 appearance-none border rounded-lg m-1 text-gray-700 focus:outline-none focus:shadow-outline">
                <div>
                    <input class="categoriesIds" wire:model="categoriesIds.{{ $category->id }}" id="categoriesIds" name="categoriesIds.{{ $category->id }}"
                    value="categoriesIds.{{ $category->id }}" hidden>
                    <input class="quantity_teams" wire:model="quantity_teams.{{ $category->id }}" id="quantity_teams" name="quantity_teams.{{ $category->id }}"
                    name="quantity_teams.{{ $category->id }}" hidden>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="mb-2 items-center text-center align-center">
    <input type="text"
        wire:model.lazy="price_total"
        id="price_total"
        name="price_total" hidden>
        <label class="inline text-2xl text-black font-bold m-2">{{__('Total Price')}}</label>
        <input type="number"
            placeholder="{{__('Total Price:')}} ${{number_format($price_total, 2, '.', ',')}}"
            disabled
            class="w-54 inline py-4 px-4 text-black leading-tight rounded-lg">
</div>
