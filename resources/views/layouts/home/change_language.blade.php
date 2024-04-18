{{-- Cambio de Idioma --}}

<div class="dropdown d-none d-md-block me-2">
    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(App::isLocale('en'))
            <span class="font-size-16 font-extrabold">{{__('Cambiar Idioma')}}</span>
        @else
            <span class="font-size-16 font-extrabold">{{__('Change Languaje')}}</span>
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <a href="/language/en" class="dropdown-item notify-item">
            <img src="/images/usa.png"  height="20">
            <span class="align-middle">{{__('English')}} </span>
        </a>
        <!-- item-->
        <a href="/language/es" class="dropdown-item notify-item">
            <img src="/images/mexico.png"  height="20">
            <span class="align-middle">{{__('Español')}} </span>
        </a>
    </div>
</div>
