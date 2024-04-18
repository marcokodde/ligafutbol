<tr>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->spanish }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->description }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->english }}</td>
    @include('common.crud_actions')
</tr>
