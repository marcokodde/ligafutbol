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
                            <th class="text-gray-500 text-left text-3xl">{{ __('Team Players') }} </th>
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
                            <table>
                                @foreach ($players as $player)
                                    @if ($loop->first)
                                        <thead>
                                            <tr class="hover:bg-gray-300 bg-gray-100">
                                                <th class="px-4 py-2 w-80">{{__("Name")}}</th>
                                                <th class="px-4 py-2 text-left">{{__("Birthday")}}</th>
                                                <th class="px-4 py-2 text-left">{{__("Gender")}}</th>
                                            </tr>
                                        </thead>
                                    @endif
                                    <tbody>
                                        <tr class="hover:bg-gray-300 bg-gray-100">
                                            <td class="text-left">{{$loop->index+1}}.- {{$player->FullName}}</td>
                                            <td>{{$player->birthday}}</td>
                                            <td>
                                                @if ($player->gender == 'Female')
                                                    <img src="{{asset('images/girl.jfif')}}"
                                                        alt="{{ __($player->gender) }}"
                                                        class="h-10 w-10 rounded-full object-cover"
                                                    >
                                                @else
                                                    <img src="{{asset('images/boy.jfif')}}"
                                                        alt="{{ __($player->gender) }}"
                                                        class="h-10 w-10 rounded-full object-cover text-center"
                                                    >
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
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
