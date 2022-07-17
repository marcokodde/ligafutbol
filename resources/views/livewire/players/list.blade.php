<tr>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->fullname }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->birthday }}</td>
    <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        @if ($record->gender == 'Female')
            <img src="{{asset('images/girl.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="h-15 w-10 rounded-full object-cover text-center"
            >
        @else
            <img src="{{asset('images/boy.jfif')}}"
                alt="{{ __($record->gender) }}"
                class="h-15 w-10 rounded-full object-cover"
            >
        @endif
    </td>
    @if (Auth::user()->isAdmin())
        <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $record->user->name }}</td>
        <td class="border px-2 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
            @foreach ($record->teams  as $team)
                @if ($team)
                    {{$team->name}}
                @else
                    {{__('Not Registered')}}
                @endif
            @endforeach
        </td>
    @endif
    @include('common.crud_actions')
</tr>