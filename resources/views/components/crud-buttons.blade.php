<td colspan="2" class="px-1 text-center border text-lg">
    <button type="button"
            wire:click="edit({{ $record->id }})"
            class="button small green --jb-modal hover:text-black font-bold rounded-lg"
            data-target="sample-modal"
            title="{{__("Edit")}}">
            <span class="icon"><i class="mdi mdi-eye"></i></span>
            {{-- <span class="control-label">{{__("Edit")}}</span> --}}
    </button>

    @if($record->can_be_delete())
        <button onclick="confirm_modal({{$record->id}})"
                class="button small red --jb-modal hover:text-black font-bold rounded-lg"
                data-target="sample-modal"
                type="button"
                title="{{__("Delete")}}">
            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
            {{-- <span class="control-label">{{__("Delete")}}</span> --}}
        </button>
    @else
        <button  type="button"
                class="button small red --jb-modal hover:text-black font-bold rounded-lg"
                data-target="sample-modal"
                disabled
                title="{{__("It ca not delete")}}">
            <span class="icon"><i class="mdi mdi-trash-can"></i></span>

        </button>
    @endif
</td>
