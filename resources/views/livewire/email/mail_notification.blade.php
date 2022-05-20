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

        <div>
            <table class="text-blue-700 text-base font-bold" border="1">
                <tr>
                    <td class="font-bold">{{__('Name')}}</td>
                    <td class="font-bold">{{$user->name}}</td>
                </tr>
                <tr>
                    <td class="font-bold">{{__('Phone')}}</td>
                    <td class="font-bold">{{$user->phone}}</td>
                </tr>
                <tr>
                    <td class="font-bold">{{__('Email')}}</td>
                    <td class="font-bold">{{$user->email}}</td>
                </tr>
                @if($amount > 0)
                    <tr>
                        <td class="font-bold">{{__('Amount')}}</td>
                        <td class="font-bold"  align="right">${{number_format($amount)}}</td>
                    </tr>
                @endif
                @if($total_teams > 0)
                    <tr>
                        <td class="font-bold">{{__('Total Teams')}}</td>
                        @if(!is_null($payment))
                            <td class="font-bold"  align="right">${{number_format($payment->source)}}</td>
                        @else
                            <td class="font-bold"  align="right">${{number_format($total_teams)}}</td>
                        @endif


                    </tr>
                @endif


            </table>

        </div>



    </body>
</html>
