<div class="grid grid-flow-col auto-cols-auto">
    {{-- Mes --}}
    <div>
        <select wire:model="birth_month" class="w-auto ml-2">
            <option value="">{{__('Month')}}</option>
            @foreach($short_months as $month_sel)
                <option value="{{str_pad($loop->index+1, 2, "0", STR_PAD_LEFT)}}">{{__($month_sel)}}</option>
            @endforeach
        </select>
    </div>
    {{-- Día --}}
    <div>
        <select wire:model="birth_day" class="w-auto ml-2 mr-2">
            <option value="">{{__('Day')}}</option>
            @if($birth_month)
                @for($i=1;$i<=$days_by_month[$birth_month-1];$i++)
                    <option value="{{str_pad($i, 2, "0", STR_PAD_LEFT)}}">{{str_pad($i, 2, "0", STR_PAD_LEFT)}}</option>
                @endfor
            @endif
        </select>
    </div>
    {{-- Año --}}
    {{-- {{date('Y',strtotime($birthday_min)) . '-' . date('Y',strtotime($birthday_max))}} --}}
    @php
        $year_from = intval(date('Y',strtotime($birthday_min)+1));
        $year_to   = intval(date('Y',strtotime($birthday_max)-1));
    @endphp
    <div>
        <select wire:model="birth_year" class='w-auto'>
            <option value="">{{__('Year')}}</option>
            @for($i=$year_from+1;$i<=$year_to;$i++)
                <option value="{{str_pad($i, 4, "0", STR_PAD_LEFT)}}">{{str_pad($i, 4, "0", STR_PAD_LEFT)}}</option>
            @endfor
        </select>
    </div>
</div>