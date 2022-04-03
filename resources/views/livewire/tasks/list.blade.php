<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->group->board->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->group->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->deadline }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        @if(App::isLocale('en'))
            {{ $record->priority->english }}
        @else
            {{ $record->priority->spanish }}
        @endif
    </td>

    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        @if(App::isLocale('en'))
        {{ $record->status->english }}
        @else
            {{ $record->status->spanish }}
        @endif
    </td>

    @include('common.crud_actions')
</tr>
