<!DOCTYPE html>
<html lang="en" class="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{ config('app.name', 'Laravel') }}</title>


        @include('layouts.head_links_tags')

        @include('layouts.head_meta_tags')
        
        <!-- Fonts -->
        <link rel="icon" type="image/x-icon" href="{{asset('images/logo1.png')}}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        {{--  Script de Sweet Alert  --}}
        <style>
            .footer2{
                background-color: black;
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 40px;
                color: white;
            }
        </style>

    </head>
<body>

    <div id="app">

        @if(env('APP_NAVBAR','sidebar') == 'sidebar')
            @include('layouts.top_navbar')
            @include('layouts.sidebar')
        @else
           @include('navigation-menu')
        @endif

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0">
                <h1 class="title">
                    {{ $header ?? '' }}
                </h1>
            </div>
        </section>

        <section class="section main-section">
            {{ $slot }}
        </section>
        @stack('modals')
        @stack('scripts')
        {{-- @include('layouts.footer') --}}
    </div>

    @livewireScripts
    <script type="text/javascript" src="{{asset('admin-one/dist/js/main.min.js?v=1628755089081')}}"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        })
    })

    function confirm_modal(id) {
        var record = id;
        Swal.fire({
            title: "{{__('Are you sure?')}}",
            text: "{{__('You wo not be able to revert this!')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{__('Yes, delete it!')}}",
            cancelButtonText: "{{__('Cancel')}}",
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('destroy', record);
                Swal.fire(
                'Deleted!',
                "{{__('Your record has been deleted.')}}",
                'success'
                )
            }
        })
    }
</script>

</body>
</html>
