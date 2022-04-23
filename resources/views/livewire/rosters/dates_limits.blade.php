<span>
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
