<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->category->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->zipcode }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ $record->zipcodex->town . ',' . $record->zipcodex->state }}
    </td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        <input type="checkbox" disabled class="text-center items-center"
        @if($record->active)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        <input type="checkbox" disabled class="text-center items-center"
        @if($record->enabled)  value="1" checked @else value="0" @endif>
    </td>
    @include('common.crud_actions')
</tr>
