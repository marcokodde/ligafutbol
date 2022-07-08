@include('common.crud_header')
<div class="container">

    <div class="text-center">
        <table class="border-2">
            <thead class="font-bold text-center">
                <tr>
                    <th>{{ __('Coach') }} </th>
                    <th>{{ __('Email') }} </th>
                    <th>{{ __('Teams')  .'/' . __('Players') }} </th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                        <tr class="border-2">
                            <td class="border-2">{{$record->name}}</td>
                            <td class="border-2">{{$record->email}}</td>
                            <td  class="flex flex-wrap">
                                @if ($record->token_register_teams)
                                    <span class="underline underline-offset-1 text-gray-700">
                                        {{__('https://equipos.galvestoncup.com/register_teams')}}/{{$record->token_register_teams}}
                                    </span>
                                @else
                                    <p class="p-2 font-pop text-red-600 font-bold">{{__('Teams already registered!')}}
                                @endif
                            </td>
                            <td  class="flex flex-wrap">
                                <span class="underline underline-offset-1 text-blue-500">
                                    {{__('https://equipos.galvestoncup.com/register_players')}}/{{$record->token_register_players}}
                                </span>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            @if($show_pagination)
                @include('common.crud_pagination')
            @endif
        </div>
    </div>
</div>
<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
