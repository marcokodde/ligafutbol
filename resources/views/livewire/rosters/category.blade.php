<div class="mb-4 flex ">
    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Category")}}</label>
    <span>
        <select wire:model="category_id"
                wire:change="calculate_birthday_limits"
                class="ml-5 inline-flex">
            <option value="" selected>{{__('Choose')}}</option>
                @foreach($categories as $category_select)
                    <option value="{{ $category_select->id }}">{{ $category_select->name }}</option>
                @endforeach
        </select>
         @if($category_id)
            <span>
                {{ $category->gender}}
                @if($category->gender == 'Both' || $category->gender == 'Female')
                    <label class="ml-5 font-bold text-2xl text-pink-500">
                        {{__('Girls') . ':' . $female_birthday_from . '- ' . $female_birthday_to}}
                    </label>
                @endif
                @if($category->gender == 'Both' || $category->gender == 'Male')
                    <label class="ml-5 font-bold text-2xl  text-blue-700">
                        {{__('Boys') . ':'  . $male_birthday_from   . '- ' . $male_birthday_to}}
                    </label>
                @endif
            </span>
         @endif
    </span>
    <div>@error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
</div>
