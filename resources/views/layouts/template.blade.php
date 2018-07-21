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
    </head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <a class="navbar-brand" href="{{ url('/allocated-rooms') }}">
            Room Allocation
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
                        <a class="nav-link" href="{{ url('/allocated-rooms') }}">Allocated</a>
                    </li>
                    <li class="nav-title">
                        <a class="nav-link" href="{{ url('/apartments') }}">Apartments</a>
                    </li>
                    <li class="nav-title">
                        <a class="nav-link" href="{{ url('/students') }}">Students</a>
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
        <span> © 2018 bmunyoki</span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <script src="{{ asset('vendors/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pace.min.js') }}"></script>

    <script src="{{ asset('libs/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- CoreUI Pro main scripts -->
    <script src="{{ asset('backend/js/app.js') }}"></script>
    
    <!-- CoreUI Pro main scripts -->
    <script src="{{ asset('js/recreporter.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#waitingCasesTable').DataTable();
        })
    </script>
</body>
</html>