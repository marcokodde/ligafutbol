<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            @include('layouts.home.logo')
            <!-- Botón contraer barra lateral -->
            @include('layouts.home.button_show_hide_lateral_menu')
            @yield('main_title')
        </div>

        <div class="d-flex">
            <!-- Cambio de idioma -->
            <div class="d-flex">
                <div class="dropdown d-none d-lg-inline-block me-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                {{-- Notificaciones --}}
                {{-- @livewire('notifications-controller') --}}
                {{--  @if(Auth::user()->unreadNotifications->count())
                    @include('layouts.home.notification')
                @endif  --}}

                {{-- Cambio de Idioma --}}
                @include('layouts.home.change_language')

                {{--  Profile / Logout  --}}
                @include('layouts.home.profile_logout')

            </div>
        </div>
    </div>
</header>
