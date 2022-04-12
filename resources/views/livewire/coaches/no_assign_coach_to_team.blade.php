{{--  Columna 2 tabla de no asignados  --}}
<div>
    <table>
        <thead>
            <tr class="bg-gray-100">
                <th class="px-2 py-1 w-72">{{__("Description")}}</th>
                <th class="px-2 py-1 text-center w-28">{{__("Action")}}</th>
            </tr>
        </thead>

        <tbody>
            @forelse($records as $record)
            <tr>
                <td class="border leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 px-2 py-1 text-left w-auto">
                    {{ $record->name}}
                </td>
                <td class="border leading-tight font-semibold text-gray-900 hover:underline px-2 py-1 text-center w-32">
                    @if(!$record->isLinkedCoach($record->id))
                        <button wire:click="linkRecord({{ $record->id }})" class="bg-indigo-500 hover:bg-indigo-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("To Assign")}}</button>
                    @endif
                </td>
            </tr>
            @empty
                @include('common.no_records_found')
            @endforelse
        </tbody>
    </table>
    @include('common.pagination')
</div>