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

        <h1 class="text-blue-700">{{__('Notifications to Galveston Cup!')}}</h1>
        {{-- {{ $user->name}} <br>
        {{ $user->phone}} <br>
        {{ $user->email}} <br>
        {{ $type}} <br>
        @if($payment)
            {{ $payment->amount}} <br>
            {{ $payment->source}} <br>
        @endif --}}

         <div>
            <h4 class="text-blue-700 font-bold text-2xl">{{ $activity}}</h4>
        </div>

        <div>

            <h4 class="text-blue-700 text-base">
                {{__('Name')}}:  {{$user->name}}
            </h4>
        </div>

        <div>
            <h4 class="text-blue-700 text-base">
                {{__('Phone')}}: {{$user->phone}}
            </h4>
        </div>

        <div>
            <h4 class="text-blue-700 text-base">
                {{__('Email')}}: {{$user->email}}
            </h4>
        </div>

        @if($amount > 0)
            <div>
                <h4 class="text-blue-700 text-base">
                    {{__('Amount')}}: ${{number_format($payment->amount)}}
                </h4>
            </div>
        @endif

        @if($total_teams > 0)
            <div>
                <h4 class="text-blue-700 text-base">
                    {{__('Total Teams')}}:  {{ $payment->source}}
                </h4>
            </div>
        @endif
        {{-- @if(!is_null($payment))
            @if($payment->amount > 0)
                <div>
                    <h4 class="text-blue-700 text-base">
                        {{__('Amount')}}: ${{number_format($payment->amount)}}
                    </h4>
                </div>
            @endif

            @if($payment->source > 0 )
                <div>
                    <h4 class="text-blue-700 text-base">
                        {{__('Total Teams')}}:  {{ $payment->source}}
                    </h4>
                </div>
            @endif
        @endif --}}
{{--
        @if($type = 'error_payment')
            <div>
                <h4 class="text-blue-700 text-base">
                    {{__('Amount')}}: $ {{number_format($amount)}}
                </h4>
            </div>

            <div>
                <h4 class="text-blue-700 text-base">
                    {{__('Total Teams')}}:  {{ $total_teams}}
                </h4>
            </div>

        @endif --}}



        <span>{{__('Galveston Cup Team')}}</span>
        <p></p>
        <span class="bg-blue-700">1-800-515-2749</span>
        <p></p>
        <span>{{__('www.GalvestonCup.com')}}</span>
    </body>
</html>
