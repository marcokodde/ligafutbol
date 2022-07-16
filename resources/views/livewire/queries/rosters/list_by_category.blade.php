<tr>

    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->player->user->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->player->fullname }}</td>

            <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
            {{date('M',strtotime($record->player->birthday)) . '-' .
            date('d',strtotime($record->player->birthday))  . '-' .
            date('Y',strtotime($record->player->birthday)) }}
        </td>


    {{-- <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ __($record->player->gender) }}</td> --}}
    <td class="w-25">

        @if ($record->player->gender == 'Female')
            <img src="{{asset('images/girl.jfif')}}"
                alt="{{ __($record->player->gender) }}"
                class="h-15 w-10 rounded-full object-cover text-center"
            >
        @else
            <img src="{{asset('images/boy.jfif')}}"
                alt="{{ __($record->player->gender) }}"
                class="h-15 w-10 rounded-full object-cover"
            >

        @endif

    </td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">

        @foreach ($record->player->teams  as $team)
            {{$team->category->name .'-' . $team->name}}
        @endforeach
    </td>
</tr>
