<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galveston Cup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
</head>
<body>

    <img style="display:block;margin-left:auto;margin-right:auto;width:150px;" src="https://i0.wp.com/galvestoncup.com/wp-content/uploads/2022/04/small-logo.png?w=400&ssl=1">

    <h1>{{__('Thank you for register the Galveston Cup 2022')}}</h1>
    <div>
        <h4 class="bg-blue-700 text-base">
            {{__('This email is a confirmation of your registration')}}
            {{$total_teams}}
            {{__('teams with a total of')}} ${{number_format($total, 2, '.', '')}}</h4>
    </div>

    <div>
        <p class="bg-blue-700 text-base">{{__('Siga las indicaciones siguientes para que pueda concluir el registro de sus equipos y de jugadores.')}}</p>
    </div>
    <div>
        <h4 class="bg-blue-700 text-base">{{__('1: Registro de Equipos: Tome  en consideración lo siguiente')}}</h4>
        <ul>
            <li>
                {{__('El nombre y zona postal son obligatorios.')}}
            </li>
            <li>
                {{__('El nombre del equipo no se puede repetir en una misma categoría, aunque haya sido registrado previamente por algún otro entrenador.')}}
            </li>
        </ul>
    </div>
    <div>
        @php
            $url_team = "https://equipos.galvestoncup.com/register_teams/";
        @endphp
        <p class="bg-blue-700 text-base">{{__('Step one: Enter this link if you want to add your Teams')}} {{$url_team.''.$token}}</p>
    </div>

    <div>
        <p class="bg-blue-700 text-base">{{__('Siga las indicaciones siguientes para que pueda concluir el registro de sus jugadores.')}}</p>
    </div>
    <div>
        <h4 class="bg-blue-700 text-base">{{__('2. Registro de Jugadores en Roster: Consideraciones:')}}</h4>
        <ul>
            <li>
                {{__('Todos los datos del jugador son obligatorios.')}}
            </li>
            <li>
                {{__('Cuando agregue un jugador a su equipo aparecerá en la lista de jugadores.')}}
            </li>
            <li>
                {{__('Puede agregar hasta un total de 06 jugadores a su equipo.')}}
            </li>
            <li>
                {{__('Si desea eliminar un jugador del equipo puede hacerlo dando clic en el botón rojo que aparece al lado del nombre del jugador.')}}
            </li>
        </ul>
    </div>

    <div>
        @php
            $url_player = "https://equipos.galvestoncup.com/register_players/";
        @endphp
        <p class="bg-blue-700 text-base">{{__('Step Two: Go to this link to add your players')}} {{$url_player.''.$token_player}}</p>
    </div>

    <div>
        <h4 class="bg-blue-700 text-base">{{__('Thank you for your registration!')}}</h4>
    </div>
    <div>
        <h4 class="bg-blue-700 text-base">{{__('Galveston Cup')}}</h4>
    </div>

    <span>{{__('www.GalvestonCup.com')}}</span>
    <p></p>
    <span class="bg-blue-700">1-800-515-2749</span>
</body>
</html>