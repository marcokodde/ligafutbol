<li>
    <a class="dropdown">
        <span class="icon"><i class="mdi mdi-settings"></i></span>
        <span class="menu-item-label">{{__('Configuration')}}</span>
        <span class="icon"><i class="mdi mdi-plus"></i></span>
    </a>
    <ul>
        <li>
            <a href="{{url('statuses')}}">
                <span>{{__('Status')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('Users')}}">
            <span>{{__('users')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('permission')}}">
            <span>{{__('Permissions')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('role')}}">
            <span>{{__('Roles')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('categories')}}">
            <span>{{__('Categories')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('costs-by-team')}}">
            <span>{{__('Costs By Team')}}</span>
            </a>
        </li>

    </ul>
</li>
