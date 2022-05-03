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
            {{__('This email is a confirmation of your registration #')}}
            {{$total_teams}}
            {{__('teams with a total of')}} ${{number_format($total, 2, '.', '')}}</h4>
    </div>

    <div>
        <p class="bg-blue-700 text-base">{{__('You will receive another email in the next few days so that you can complete your team data and upload your player roster for each team.')}}</p>
    </div>
    <div>
        @php
            $url_team = "https://equipos.galvestoncup.com/register_teams/";
        @endphp
        <p class="bg-blue-700 text-base">{{__('Enter this link, if you want to add your Teams')}} {{$url_team.''.$token}}</p>
    </div>

    <div>
        @php
            $url_player = "https://equipos.galvestoncup.com/register_players/";
        @endphp
        <p class="bg-blue-700 text-base">{{__('Enter the link once you entered the name of your Teams, enter link if you want to add your Players')}} {{$url_player.''.$token_player}}</p>
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