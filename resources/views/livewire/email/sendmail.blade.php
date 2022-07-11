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

        <h1 class="text-blue-700">{{__('Thank you for your registration for the 2022 Galveston Cup!')}}</h1>
        <div>
            <h4 class="text-blue-700 text-base">
                {{__('This email is a confirmation of your registration for')}}
                {{$total_teams}}
                @if ($total)
                    {{__('teams with a total of')}} ${{number_format($total, 2, '.', '')}}</h4>
                @endif
        </div>
        @if ($token)
            <div>
                <h4 class="bg-blue-700 text-base">{{__('To complete the registration of your teams and add a roster of players, follow these instructions:')}}</h4>
            </div>
            <div>
                <ul>
                    <li>
                        <p class="bg-blue-700 text-base">{{__('In the link below you can access the system and add the name of the teams you registered.')}}</p>
                    </li>
                    <li>
                        <p class="bg-blue-700 text-base">{{__('Take into account that the name of the team cannot be repeated in the same category.')}}</p>
                    </li>
                    <li>
                        <p class="bg-blue-700 text-base">{{__('In case the team name has been previously registered by some other manager in that category, the system will ask you to change the name of your team.')}}</p>
                    </li>
                </ul>
            </div>

            <div>
                @php
                    $url_team = "https://equipos.galvestoncup.com/register_teams/";
                @endphp
                <p class="bg-blue-700 text-base">{{__('Click on this link to add your Teams:')}} {{$url_team.''.$token}}</p>
            </div>
            <div>
                <h4 class="text-gray-600">{{__('Please follow the instructions below so that you can complete the registration of your players.')}}</p>
            </div>
        @endif
        @if ($token_player)
            <div>
                @php
                    $url_player = "https://equipos.galvestoncup.com/register_players/";
                @endphp
                <p class="bg-blue-700 text-base">
                    {{__('This link will be to add or update your player list. As long as you have your teams added.')}}
                    {{$url_player.''.$token_player}}
                </p>
            </div>
        @endif
        <div>
            <h4 class="text-blue-600">{{__('If you have any questions you can visit www.galvestoncup.com/faq for our frequently asked questions section where you can also contact our team to answer your questions.')}}</h4>
        </div>
        <div>
            <h4 class="bg-blue-700 text-base">{{__('Welcome to the Galveston Cup!!')}}</h4>
        </div>
        <span>{{__('Galveston Cup Team')}}</span>
        <p></p>
        <span class="bg-blue-700">1-800-515-2749</span>
        <p></p>
        <span>{{__('www.GalvestonCup.com')}}</span>

    </body>
</html>