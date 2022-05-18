<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->email }}</td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->noty_create_user)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->noty_payment)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->noty_without_payment)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->noty_register_teams)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->noty_register_players)  value="1" checked @else value="0" @endif>
    </td>
    @include('common.crud_actions')
</tr>
