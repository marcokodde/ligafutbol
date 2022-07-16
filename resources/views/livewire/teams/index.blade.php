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
    
    <div class="card-content">
        <div class="card-content">
            @if ($user_id)
            <div class="text-center">
                <table class="table mb-5" id="mytable">
                    <thead>
                        <tr class="lg:hover:bg-gray-100 lg:bg-gray-50">
                            <th class="text-gray-500 text-center text-3xl">{{ __('Category') }} </th>
                            <th class="text-gray-500 text-center text-3xl">{{ __('Team') }} </th>
                            <th class="text-gray-500 text-center text-3xl">{{ __('Team Players') }} </th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="font-semibold text-center text-xl">
                            {{$category->name}}
                        </td>
                        <td class="font-semibold text-center text-xl">
                            {{$team->name}}
                        </td>
                        <td class="font-semibold text-center text-xl">
                            @foreach ($players as $player)
                            <li class="font-semibold text-center text-xl">
                                {{$loop->index+1}} {{$player->FullName}}
                            </li>
                            @endforeach
                        </td>
                    </tbody>
                </table>
            </div>
            @else
                @include('common.crud_header_table')
                @include('common.crud_table')
            @endif
        </div>
    </div>

    {{-- Si se crea o edita --}}
    @if($isOpen && isset($view_form))
   {{ $create_button_label}}
        @include($view_form)
    @endif
</div>
