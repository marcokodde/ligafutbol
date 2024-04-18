<tr>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->name }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->place }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">{{ $record->location }}</td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        <input type="checkbox" disabled
        @if($record->active)  value="1" checked @else value="0" @endif>
    </td>
    @include('common.crud_actions')
</tr>
