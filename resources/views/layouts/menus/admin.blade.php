<li>
    <a class="dropdown">
        <span class="icon"><i class="mdi mdi-settings"></i></span>
        <span class="menu-item-label">{{__('Configuration')}}</span>
        <span class="icon"><i class="mdi mdi-plus"></i></span>
    </a>
    <ul>
        <li>
            <a href="{{url('statuses')}}">
                <span class="icon"><i class="mdi mdi-format-list-bulleted"></i></span>
                <span>{{__('Statuses')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('users')}}">
            <span class="icon"><i class="mdi mdi-account"></i></span>
            <span>{{__('Users')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('permission')}}">
                <span class="icon"><i class="mdi mdi-account-cash-outline"></i></span>
                <span>{{__('Permissions')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('role')}}">
                <span class="icon"><i class="mdi mdi-account-convert-outline"></i></span>
                <span>{{__('Roles')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('categories')}}">
                <span class="icon"><i class="mdi mdi-calendar"></i></span>
                <span>{{__('Categories')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('teams')}}">
                <span class="icon"><i class="fas fa-address-card"></i></span>
                <span>{{__('Teams')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('players')}}">
                <span class="icon"><i class=" fas fa-people-carry"></i></span>
                <span>{{__('Players')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('costs-by-team')}}">
                <span class="icon"><i class="fa fa-money-bill"></i></span>
                <span>{{__('Costs By Team')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('settings')}}">
                <span class="icon"><i class=" fas fa-bezier-curve"></i></span>
                <span>{{__('Settings')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('email_notifications')}}">
                <span class="icon"><i class="mdi mdi-bell-ring"></i></span>
                <span>{{__('Notifications')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('promoters')}}">
                <span class="icon"><i class="fas fa-people-carry"></i></span>
                <span>{{__('Promoters')}}</span>
            </a>
        </li>

    </ul>
</li>
<li>
    <a class="dropdown">
        <span class="icon"><i class="mdi mdi-settings"></i></span>
        <span class="menu-item-label">{{__('Queries')}}</span>
        <span class="icon"><i class="mdi mdi-plus"></i></span>
    </a>
    <ul>
        <li>
            <a href="{{url('teams_queries')}}">
                <span>{{__('Team Queries')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('total_team_categories')}}">
                <span>{{__('Total Teams x Category')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('total_team_categories/acordeon')}}">
                <span>{{__('Total Teams x Category in Acordeon')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('total_team_categories/table')}}">
                <span>{{__('Total Teams x Category in Table')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('users/token')}}">
                <span>{{__('Coach List in Accordeon')}}</span>
            </a>
        </li>
        <li>
            <a href="{{url('users/token_list')}}">
                <span>{{__('Coach List in Table')}}</span>
            </a>
        </li>
    </ul>
</li>