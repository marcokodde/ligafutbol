@if(Auth::user())
<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
        <img src="{{asset('images/logo1.png')}}" height="50px" width="50px"  alt="">
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
            {{-- Menú Configuración --}}
            @if(Auth::user()->isAdmin())
                @include('layouts.menus.admin')
            @endif

            {{-- Menú de Coach --}}
            @if(Auth::user()->isCoach())
                @include('layouts.menus.coach')
            @endif
        </ul>
    </div>
</aside>
@endif