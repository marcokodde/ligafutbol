<div>
    <h4 class="text-blue-700 font-bold text-2xl">{{__('Se Registro un Pago')}}</h4>
</div>

<div>
    <h4 class="text-2xl text-blue-700">
        {{__('Se registro el pago  a nombre del usuario')}}:
        {{$first_variable}}
    </h4>
</div>
<div>
    <h4 class="text-blue-700 text-base">
        {{__('Pago el siguiente importe')}}:
        ${{number_format($second_variable)}}
    </h4>
</div>
<div>
    <h4 class="text-blue-700 text-base">
        {{__('Su pago se realizo por un total de')}}:
        {{$third_variable}},
        {{__(' Equipos')}}
    </h4>
</div>