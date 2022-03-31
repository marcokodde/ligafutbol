<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
        <img src="{{asset('images/logo.png')}}" height="50px" width="50px"  alt="">
    </div>
    <div class="menu is-menu-main">
        <ul class="menu-list">
        <li class="active">
            <a href="index.html">
                <span class="menu-item-label text-center">
                    <a href="{{url('dashboard')}}">{{__('Dashboard')}}</a>
                </span>
            </a>
        </li>
        </ul>
        <ul class="menu-list">
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
                    <a href="{{url('positions')}}">
                    <span>{{__('Positions')}}</span>
                    </a>
                </li>



                <li>
                    <a href="{{url('departaments')}}">
                    <span>{{__('Departaments')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('boards')}}">
                    <span>{{__('Boards')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('groups')}}">
                    <span>{{__('Groups')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('tasks')}}">
                    <span>{{__('Tasks')}}</span>
                    </a>
                </li>



            </ul>
        </li>
        </ul>
    </div>
</aside>
