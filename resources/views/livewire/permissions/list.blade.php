<tr>
    <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ $record->name }}
    </td>

    <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        @if(App::isLocale('en'))
            {{ $record->english }}
        @else
            {{ $record->spanish }}
        @endif

    </td>


    <td class="border px-4 py-2 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ $record->slug }}
    </td>
    @include('common.crud_actions')
</tr>
