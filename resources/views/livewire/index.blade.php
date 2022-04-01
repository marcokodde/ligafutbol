@include('common.crud_header')

<div class="py-4 px-4">
    @include('common.crud_message')

    {{--  Boton para crear elemento  --}}
    @if($allow_create)
        @include('common.crud_create_button')
    @endif

    {{--  Modal para confirmar elemento --}}
    @if($confirm_delete)
        @include('common.confirm_delete')
    @endif

    {{--  Vista busquedas de items  --}}
    @if(isset($view_search))
        @include($view_search)
    @endif

    {{-- Detalle de registros --}}
    <div class="card has-table">
        @include('common.crud_header_table')
        @include('common.crud_table')
    </div>

    {{-- Si se crea o edita --}}
    @if($isOpen && isset($view_form))
   {{ $create_button_label}}
        @include($view_form)
    @endif
</div>
