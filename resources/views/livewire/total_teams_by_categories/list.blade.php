<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 w-80">{{ $record->category->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 w-20 text-center">{{ $record->teams }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 w-32 text-center">
        @if ($record->reservations > 0)
            <span>{{ $record->reservations}}</span>
        @else
            <span class="text-red-500 font-pop font-semibold rounded-md">
                {{__('Not registered')}}
            </span>
        @endif
    </td>

        @if($record->teams != $record->category->paid_teams_by_category())
            <td class="border px-2 py-1 text-5   xl font-bold sm:text-base md:text-xl  text-red-500  w-32 text-center">
        @else
            <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 w-32 text-center">
        @endif
        {{ $record->category->paid_teams_by_category()}}
    </td>
</tr>

