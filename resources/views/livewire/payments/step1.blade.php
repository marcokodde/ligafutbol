<div class="w-full leading-tight">
    <label class="block text-base font-bold mb-2 mt-2">{{__("Select Teams to Payment")}}</label>
    <div class="grid grid-cols-2 auto-cols-auto">
        @foreach($teams as $team_to_assign)
            <label class="block text-sm font-semibold mb-2 mt-2">{{$team_to_assign->name}}</label>
            <input type="checkbox" class="form-checkbox border-2 h-6 w-6 text-gray-600 border-red-600"
            wire:model="selectedteams" wire:click="countCheck" value="{{$team_to_assign->id}}">
        @endforeach
    </div>
</div>
<div class="flex flex-wrap mb-2">
    <input type="text"
        wire:model.lazy="price_total"
        id="price_total"
        name="price_total" hidden>
    <div class="mb-2">
        <input type="number"
            placeholder="{{__('Total Price:')}} ${{number_format($price_total, 2, '.', ',')}}"
            disabled
            class="rounded w-full py-2 px-3 text-gray-700 leading-tight" >
    </div>
</div>
