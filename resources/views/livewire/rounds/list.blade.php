<tr>
    <td>{{ $record->id }}</td>
    <td>{{ $record->name }}</td>
    <td>
        {{ date('l F d Y', strtotime($record->from)) }}
    </td>
    <td>
        {{ date('l F d Y', strtotime($record->to)) }}
    </td>

    <td class="text-center">
        @if($record->active)
            <label>  {{__('Yes')}}</label>
        @else
            <label class="text-danger">{{__('No')}}</label>
        @endif
    </td>
    @include('common.crud_actions')
</tr>

