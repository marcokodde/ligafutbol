<div class="mb-2 flex flex-row">
    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Category")}}</label>

        <select wire:model="category_id"
                wire:change="calculate_birthday_limits"
                class="ml-5 inline-flex">
            <option value="" selected>{{__('Choose')}}</option>
                @foreach($categories as $category_select)
                    <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
                @endforeach
        </select>
         @if($category_id)
            @include('livewire.rosters.dates_limits')

         @endif

</div>
