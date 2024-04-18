{{-- Notificaciones --}}
<div class="dropdown d-none d-md-block me-2">
    <div wire:poll.1000ms.keep-alive">

        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-bell"></i>
            @if(Auth::user()->unreadNotifications->count())
                <span class="badge bg-danger rounded-pill">
                    {{ Auth::user()->unreadNotifications->count()}}
                </span>
            @endif
        </button>
    </div>
</div>