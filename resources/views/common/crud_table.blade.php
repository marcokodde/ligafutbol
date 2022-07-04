<div class="card-content">
    <div class="card-content">
        @if ($records->count())
            <table class="table mb-5" id="mytable">
                @if (isset($view_table))
                    @include($view_table)
                @endif
                @include('livewire.each_record')
                @if (isset($total_registered_teams) || isset($total_reserved_teams) || isset($total_paid_teams))
                    <div class="text-center">
                        <table>
                            <thead>
                                <th class="font-bold text-center text-3xl">{{ __('Reserved') }} </th>
                                <th class="font-bold text-center text-3xl">{{ __('Registered') }} </th>
                                <th class="font-bold text-center text-3xl">{{ __('Paid') }} </th>
                                <th class="font-bold text-center text-3xl text-red-600">{{ __('No Paid') }} </th>
                            </thead>
                            <tbody>
                                <td class="font-bold text-center text-3xl">{{ $total_registered_teams['teams'] }}</td>
                                <td class="font-bold text-center text-3xl">{{ $total_reserved_teams['teams'] }}</td>
                                <td class="font-bold text-center text-3xl">{{ $total_paid_teams['teams'] }}</td>
                                <td class="font-bold text-center text-3xl text-red-600">
                                    {{ $total_registered_teams['teams'] - $total_paid_teams['teams'] }}</td>
                            </tbody>
                        </table>
                    </div>
                @endif
            </table>
            @if ($show_pagination)
                @include('common.crud_pagination')
            @endif
        @else
            @include('common.no_records_found')
        @endif
    </div>
</div>
