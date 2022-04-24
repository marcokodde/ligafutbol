<li class="mt-5">
    <a class="dropdown">
        <span class="icon"><i class="mdi mdi-settings"></i></span>
        <span class="menu-item-label">{{__('Operations')}}</span>
        <span class="icon"><i class="mdi mdi-plus"></i></span>
    </a>

    <ul>

        <li>
            <a href="{{url('teams')}}">
                <span>{{__('Teams')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('coaches')}}">
                <span>{{__('Coaches')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('players')}}">
                <span>{{__('Players')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('coaches-team')}}">
                <span>{{__('Assign Coaches To Team')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('players-team')}}">
                <span>{{__('Assign Players To Team')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('rosters')}}">
                <span>{{__('Rosters')}}</span>
            </a>
        </li>

    </ul>
</li>
