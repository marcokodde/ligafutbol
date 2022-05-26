<div class="mx-auto text-center items-center">
    <label class="block lg:text-xl sm:text-sm text-gray-600 font-bold mb-2">
        {{__("Step 2 of 3")}}
    </label>
    <label class="lg:text-2xl sm:text-base font-normal text-gray-500 font-pop mt-4 mb-4">
        {{__("Select how many teams you want to register for each category")}}:
    </label>
</div>
<br>
<div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-1 sm:gap-1 md:grid-cols-2 md:gap-2">
    <div>
    </div>
        <div class="grid grid-cols-2 gap-8 2xl:gap-4">
            @foreach($categories as $category)
                <div class="flex items-center text-center md:justify-between">
                    <label class="text-gray-600 font-pop font-medium 2xl:text-2xl lg:text-lg mr-4">{{$category->name}}</label>
                    <div class="mx-auto px-auto">
                        <input wire:model="quantity_teams.{{ $loop->index }}"
                                wire:change="countTeams()"
                                type="number"
                                min="0"
                        @if(isset($max_by_category[$loop->index]))
                            max="{{$max_by_category[$loop->index]}}"
                        @else
                            max="16"
                        @endif
                        class="w-auto appearance-none border text-gray-700 focus:outline-none focus:shadow-outline">
                    </div>
                    @error('quantity_teams') <span class="text-red-500">{{ $message }}</span>@enderror
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
                {{__('Price per team:')}} ${{$record->cost}}</label>
            @endif
        @endforeach

    <br>
    <label class="inline text-2xl text-gray-700 font-bold font-pop justify-center text-center mt-2 m-2 lg:-ml-28">{{__('Total')}} {{$total_teams}}
        @if ($total_teams == 1)
            {{__('Team')}}
        @else
            {{__('Teams')}}

         @endif


         @if($coupon_applied && $general_settings->active_coupon)
            {{ __('Before') . ' $' . number_format($amount_with_coupon)
             . __('After')  . ' $' . number_format($price_total)

            }}
        @else
             ${{number_format($price_total)}}

         @endif

        @if($general_settings->active_coupon)
            <span>
                <div class="mb-4 mt-2">
                    <label class="block font-pop lg:text-left lg:ml-24 sm:text-center font-medium text-gray-600" for="fullname">{{ __('Key To Coupon') }}</label>
                    <input class="lg:w-56 sm:w-32"
                        type="text"
                        wire:model.lazy="key_to_coupon"
                        wire:change="validate_key_to_coupon"
                        placeholder="{{ __('Key To Coupon') }}"
                        name="key_to_coupon"
                        id="key_to_coupon"
                        required
                    >

                </div>
                @if($apply_coupon && !$coupon_applied)
                    <button type="button"
                                wire:click="apply_coupon"
                                id="go_back"
                                style="background-color: #5cdc42"
                                class="button mx-2 px-8 py-4 mt-4  text-black font-semibold rounded-lg hover:text-white"
                            >
                        {{__("Apply")}}
                    </button>
                @endif
                </span>
        @endif

    @endif


</div>
