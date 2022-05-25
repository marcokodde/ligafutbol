
<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools h-24 mx-auto mt-4 text-center items-center justify-center">
        <img src="{{asset('images/galveston2022.png')}}" height="70px" width="70px"  alt="">
    </div>
    <div class="menu is-menu-main mt-4">
        <ul class="menu-list">
        </ul>
        @if (Auth::user())
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
        @else
        <div class="mt-4 mx-4">
            @include('common.language')
        </div>
        @endif
    </div>
</aside>
