{{-- Perfil - Logout --}}
<div class="dropdown d-inline-block">
    <button type="button"
    class="btn header-item waves-effect"
    id="page-header-user-dropdown"
    data-bs-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false">
        @if (Auth::user()->profile_photo_path)
            <img width="32" height="32" class="rounded-circle object-cover" src="/storage/{{Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
        @else
            <img width="32" height="32" class="rounded-circle object-cover" src="{{Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /> 
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <a class="dropdown-item" href="{{ route('profile.show') }}"> {{ __('Profile') }}</a>
        <div class="dropdown-divider"></div>
        <!-- Authentication -->
        <a class="dropdown-item">
            <!-- Authentication -->
            <a class="dropdown-item text-red"  href="{{ route('logout') }}">
                    <i class="mdi mdi-close-circle"></i>
                    {{ __('Logout') }}
            </a>
        </a>
    </div>
</div>