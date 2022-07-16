<tr>

    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->user->name }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->fullname }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{date('M',strtotime($record->birthday)) . '-' .
        date('d',strtotime($record->birthday))  . '-' .
        date('Y',strtotime($record->birthday)) }}
    </td>
    {{-- <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ __($record->gender) }}</td> --}}
    <td class="w-25">
        @if ($record->gender == 'Female')
            <img src="{{asset('images/girl.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="h-15 w-10 rounded-full object-cover"
            >
        @else
            <img src="{{asset('images/boy.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="h-15 w-10 rounded-full object-cover text-center"
            >

        @endif

    </td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">

        @foreach ($record->teams  as $team)
            {{$team->category->name .'-' . $team->name}}
        @endforeach
    </td>

</tr>
