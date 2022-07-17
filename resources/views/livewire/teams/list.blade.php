<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->category->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->zipcode }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ $record->zipcodex->town . ',' . $record->zipcodex->state }}
    </td>
    @include('common.crud_actions')
</tr>