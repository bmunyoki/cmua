<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="FGM app Dashboard">
        <meta name="author" content="Heptanalytics">
        <title>{{ @$title }}</title>

        <!-- fa fas icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
      
        <!-- Ionic icons -->
        <link href="https://unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css" rel="stylesheet">

        <!-- Main styles for this application -->
        <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
        <!-- Main template hack styles -->
        <link href="{{ asset('backend/css/template-hack.css') }}" rel="stylesheet">

        <!-- Internationa tel input and sweet allert -->
        <link rel="stylesheet" href="{{ asset('libs/sweetalert/dist/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/int/css/intlTelInput.css') }}">

        <!-- Main CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Main styles for this application -->
        <link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
        @yield('importcss')
    </head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            Rec Reporter
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler- fa fa-bars"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link" data-toggle="dropdown" href="editors-text-editors.html#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/avatar.png') }}" class="img-avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="/logout">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-title">
                        Cases
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-balance-scale"></i>All</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/cases/waiting') }}"><i class="fa fa-file-audio"></i> Waiting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/cases/received') }}"><i class="fa fa-arrow-circle-right"></i> Received</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/cases/in-progress') }}"><i class="fa fa-spinner"></i>In Progress</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/cases/resolved') }}"><i class="fa fa-calendar-check"></i> Resolved</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-title">
                        Reports
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/reports/custom') }}" class="nav-link"><i class="fa fa-align-justify"></i> Custom</a>
                    </li>
                    <li class="nav-title">
                        Users
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i> All</a>
                        <ul class="nav-dropdown-items">
                            @if(Auth::user()->role == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users/administrators') }}"><i class="fa fa-users-cog"></i> Admins</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users/volunteers') }}"><i class="fa fa-user"></i> Volunteers</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Main content -->
        <main class="main">
            <meta name="_token" content="{{ csrf_token() }}" /> 
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
            @yield('content')
        </main>
    </div>
    <footer class="app-footer">
        <span> © 2018 Heptanalytics</span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    

    <script src="{{ asset('vendors/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pace.min.js') }}"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('vendors/js/Chart.min.js') }}"></script>

    <!-- Internal telephone input and sweetalert -->
    <script src="{{ asset('libs/int/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('libs/int/js/utils.js') }}"></script>
    <script src="{{ asset('libs/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- CoreUI Pro main scripts -->
    <script src="{{ asset('backend/js/app.js') }}"></script>
    
    <!-- CoreUI Pro main scripts -->
    <script src="{{ asset('js/recreporter.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOZ3iFXxO0dN75GKYwNsToH3W6u1kcGR0&callback=initMap" async defer></script>
    @yield('customjs') 
    <script type="text/javascript">
        $(document).ready(function(){
            //Initialize International Phone input
            //Set the priority countries and path to utils
            $("#intPhone").intlTelInput({
                preferredCountries: [ "ke", "ug", "rw", "tz" ],
                autoPlaceholder: "polite",
                //utilsScript: "../../public/libraries/int/js/utils.js"
                utilsScript: "{{ asset('libraries/int/js/utils.js') }}"
            });
            $("#uIntPhone").intlTelInput({
                preferredCountries: [ "ke", "ug", "rw", "tz" ],
                autoPlaceholder: "polite",
                //utilsScript: "../../public/libraries/int/js/utils.js"
                utilsScript: "{{ asset('libraries/int/js/utils.js') }}"
            });

            $('#waitingCasesTable').DataTable();
        })
    </script>
</body>
</html>