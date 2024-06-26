<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->date_from }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->date_to }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ __($record->gender) }}
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->active)  value="1" checked @else value="0" @endif>
    </td>
    @include('common.crud_actions')
</tr>
