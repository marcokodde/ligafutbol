<tr>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->date }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->game_id }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->tournament_id }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->referee_id }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->stadium_id }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->date }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->date }}</td>

    @include('common.crud_actions')
</tr>
