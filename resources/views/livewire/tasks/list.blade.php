<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->group->board->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->group->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->title }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{date("l F d", strtotime($record->deadline))}}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        <span class="border-2 text-white
        @switch($record->priority->id)
            @case(1)
                border-red-600 bg-red-600
            @break

            @case(2)
                border-yellow-600 bg-yellow-600
            @break
            @case(3)
                border-gray-500 bg-gray-500
            @break
            @case(4)
                border-green-500 bg-green-500
            @break
            @default
        @endswitch
         rounded-lg text-lg">
            @if(App::isLocale('en'))
                {{ $record->priority->english }}
            @else
                {{ $record->priority->spanish }}
            @endif
        </span>
    </td>

    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        <span class="border-2 text-white
        @switch($record->status->id)
            @case(1)
                border-blue-500 bg-blue-500
            @break

            @case(2)
                border-yellow-500 bg-yellow-500
            @break
            @case(3)
                border-green-500 bg-green-500
            @break
            @case(4)
                border-gray-500 bg-gray-500
            @break
            @default
        @endswitch
         rounded-lg text-lg">
        @if(App::isLocale('en'))
        {{ $record->status->english }}
        @else
            {{ $record->status->spanish }}
        @endif
        </span>
    </td>

    @include('common.crud_actions')
</tr>
