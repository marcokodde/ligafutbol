
<input type="date"
    wire:model="birthday"
    min="{{$birthday_min}}"
    max="{{$birthday_max}}"
    placeholder="{{__("Birthday")}}"
    class="block ml-1 w-11/12 @error('birthday')  border-red-600 border-collapse border-2 @enderror"
>
