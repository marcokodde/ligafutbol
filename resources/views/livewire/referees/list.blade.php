<tr>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->fullname }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->birthday }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        @if ($record->gender == 'Female')
            <img src="{{asset('images/girl.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="object-cover w-10 text-center rounded-full h-15"
            >
        @else
            <img src="{{asset('images/boy.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="object-cover w-10 rounded-full h-15"
            >
        @endif
    </td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->phone }}</td>
    @include('common.crud_actions')
</tr>
