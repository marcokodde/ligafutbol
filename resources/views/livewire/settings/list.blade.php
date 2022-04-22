<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->max_players_by_team }}</td>

    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->players_only_available_teams)  value="1" checked @else value="0" @endif>
    </td>

    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($record->coaches_only_available_teams)  value="1" checked @else value="0" @endif>
    </td>

    <td colspan="2" class="px-1 text-center border text-lg">
        <button type="button"
                wire:click="edit({{ $record->id }})"
                class="button small green --jb-modal hover:text-black font-bold rounded-lg"
                data-target="sample-modal"
                title="{{__("Edit")}}">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
                {{-- <span class="control-label">{{__("Edit")}}</span> --}}
        </button>
    </td>
</tr>
