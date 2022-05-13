<div class="flex justify-between">

    {{-- Mes --}}
    <select wire:model="birth_month">
        <option value="">{{__('Month')}}</option>
        @foreach($short_months as $month_sel)
            <option value="{{str_pad($loop->index+1, 2, "0", STR_PAD_LEFT)}}">{{__($month_sel)}}</option>
        @endforeach
    </select>

    {{-- Día --}}
    <select wire:model="birth_day" class="w-auto ml-2 mr-2">
        <option value="">{{__('Day')}}</option>
        @if($birth_month)
            @for($i=1;$i<=$days_by_month[$birth_month-1];$i++)
                <option value="{{str_pad($i, 2, "0", STR_PAD_LEFT)}}">{{str_pad($i, 2, "0", STR_PAD_LEFT)}}</option>
            @endfor
        @endif
    </select>

    {{-- Año --}}
    {{-- {{date('Y',strtotime($birthday_min)) . '-' . date('Y',strtotime($birthday_max))}} --}}
    <select wire:model="birth_year" class='lg:w-25'>
        <option value="">{{__('Year')}}</option>
        @for($i=date('Y',strtotime($birthday_min)+1);$i<=date('Y',strtotime($birthday_max));$i++)
            <option value="{{str_pad($i, 4, "0", STR_PAD_LEFT)}}">{{str_pad($i, 4, "0", STR_PAD_LEFT)}}</option>
        @endfor
    </select>

</div>
