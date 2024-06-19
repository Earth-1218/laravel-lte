<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title', '')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Date Range Picker -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @livewireStyles

    @stack('styles')
    <style>

    /* Hover effect for sidebar links */
    .main-sidebar a:hover {
        background-color: #454d55;
    }

    /* Smooth transition for sidebar width */
    .main-sidebar {
        -webkit-transition: width 0.8s ease !important;
        -moz-transition: width 0.8s ease !important;
        -o-transition: width 0.8s ease !important;
        transition: width 0.8s ease !important;
    }

    .sidebar-collapse .main-sidebar {
        -webkit-transition: width 0.8s ease !important;
        -moz-transition: width 0.8s ease !important;
        -o-transition: width 0.8s ease !important;
        transition: width 0.8s ease !important;
        /* width: 50px !important; Set the collapsed width if necessary */
    }

    /* Customize scrollbar appearance */
    ::-webkit-scrollbar {
        width: 5px;
        height: 5px; 
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(90, 90, 90, 0.8);
    }

    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Wrapper styling */
    .wrapper {
        display: flex;
        flex-direction: column;
        height: 100vh; 
        width: 100vw;
        overflow-x: hidden; 
    }

    /* Main sidebar styling */
    .main-sidebar {
        display: flex;
        flex-direction: column;
        overflow-y: scroll !important; 
        overflow-x: hidden; 
    }

    /* Content wrapper styling */
    .content-wrapper {
        flex-grow: 1;
        overflow-y: scroll; 
        overflow-x: hidden; 
        position: relative;
    }

    /* Main content styling */
    .content-wrapper .main-content {
        overflow-y: scroll; 
        overflow-x: hidden; 
    }

    </style>
</head>
