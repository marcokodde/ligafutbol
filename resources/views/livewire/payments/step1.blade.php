<div class="mx-auto text-center items-center">
    <label class="lg:text-2xl sm:text-base font-medium text-gray-500 font-pop mt-2 mb-4">{{__("Select the number of teams you want to register in each category")}}</label>
</div>
<br>
<div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1 md:grid-cols-2 md:gap-2">
    <div>
    </div>
        <div class="grid grid-cols-2 gap-8 2xl:gap-4">
            @php $i=0 @endphp
            @foreach($categories as $category)
                @php  $i++ @endphp
                <div class="flex items-center text-center md:justify-between">
                    <label class="text-gray-600 font-pop font-medium 2xl:text-2xl lg:text-lg">{{$category->name}}</label>

                    <div class="mx-auto px-auto">
                        <input wire:model="quantity_teams.{{ $loop->index }}"
                                wire:change="countTeams()"
                                type="number"
                                min="0"
                        @if(isset($max_by_category[$i]))
                            max="{{$max_by_category[$i]}}"
                        @else
                            max="16"
                        @endif

                        class="appearance-none border rounded-lg text-gray-700 focus:outline-none focus:shadow-outline">
                    </div>

                    <div>
                        <input class="categoriesIds"
                                wire:model="categoriesIds.{{ $loop->index}}"
                                value="categoriesIds.{{ $category->id }}" hidden
                        >

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
                {{__('Price per team:')}} ${{number_format($record->cost, 2, '.', '')}}</label>
            @endif
        @endforeach

    <br>
    <label class="inline text-2xl text-gray-700 font-bold font-pop mt-2 m-2 lg:-ml-28">{{__('Total')}} {{$total_teams}} {{__('Teams')}}</label>
    <input type="number"
        placeholder="${{number_format($price_total, 2, '.', ',')}}"
        disabled
        style="border-color:rgba(31,41,55,var(--tw-bg-opacity))"
        class="w-auto px-12 py-2 border-2 inline text-black leading-tight rounded-lg">
    @endif
</div>
