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
        {{__('Email')}}: {{$user->phone}}
    </h4>
</div>

<div>
    <h4 class="text-blue-700 text-base">
        ${{number_format($payment->amount)}}
    </h4>
</div>

<div>
    <h4 class="text-blue-700 text-base">
        {{__('Total Teams')}}:  {{ $payment->source}}
    </h4>
</div>
