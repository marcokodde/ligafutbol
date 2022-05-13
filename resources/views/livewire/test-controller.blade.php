<div>
    @if($month)
        <p>Mes: {{ $month . '=' . $short_months[$month-1] . ' =>' .  $large_months[$month-1]}} </p>
        <p>Dia: {{ $day}}</p>
        <p>Año: {{ $year}}</p>
    @endif


    <div class="flex">
        <table>
            <thead class="text-center">
                <th>{{__('Month')}}</th>
                <th>{{__('Day')}}</th>
                <th>{{__('Year')}}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select wire:model="month">
                            <option value="">{{__('Month')}}</option>
                            @foreach($short_months as $month_sel)
                                <option value="{{$loop->index+1}}">{{__($month_sel)}}</option>
                            @endforeach
                        </select>
                    </td>
                    {{-- Día según mes elegido --}}

                    <td>
                        <select wire:model="day">
                            <option value="">{{__('Day')}}</option>
                            @if($month)
                                @for($i=1;$i<=$days_by_month[$month-1];$i++)
                                    <option value="{{str_pad($i, 2, "0", STR_PAD_LEFT)}}">{{str_pad($i, 2, "0", STR_PAD_LEFT)}}</option>
                                @endfor
                            @endif
                        </select>
                    </td>
                    <td>
                        <div class="form-group lg:ml-2 sm:ml-0 mb-2 mt-2">
                            @php $year = date('Y') @endphp
                            <select wire:model="year" class='lg:w-40'>
                                <option value="">{{__('Year')}}</option>
                                @for($i=$year;$i<=$year+10;$i++)
                                    <option value="{{str_pad($i, 4, "0", STR_PAD_LEFT)}}">{{str_pad($i, 4, "0", STR_PAD_LEFT)}}</option>
                                @endfor
                            </select>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>



    </div>

</div>
