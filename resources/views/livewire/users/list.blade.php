<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->email }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        @foreach($record->roles as $role)
            @if(App::isLocale('en'))
                {{ $role->english}}
            @else
                {{ $role->spanish}}
            @endif
        @endforeach
    </td>
    <td class="border px-4 py-1 w-20 text-center">
        <input type="checkbox" disabled
        @if($role->full_access)  value="1" checked @else value="0" @endif>
    </td>
    <td class="border px-2 py-1 text-center">
        <button wire:click="edit({{ $record->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">{{__("Edit")}}</button>
    </td>
</tr>