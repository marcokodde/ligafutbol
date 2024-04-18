<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="shortcut icon"  href="assets/images/logo_m.png">
   
    <!-- Bootstrap Css -->
    <link href="/admira/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="/admira/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- App Css-->
    <link href="/admira/assets/css/app.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Css-->
    <link href="/admira/assets/css/custom.css" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    @livewireStyles
    <!-- Scripts -->
    {{--   <script src="{{ mix('js/app.js') }}" defer></script>  --}}
</head>