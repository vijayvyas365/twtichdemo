<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/favicon.ico')}}"/>
        <title>@yield("title")</title>
        @include('layouts.css')
    </head>
    <body id="mainBody">
        <div class="navbar navbar-inverse bg-indigo">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::route("user.index")}}"><strong>STREAMLABS</strong></a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">

                            @if(Auth::check())
                            <img src="{{Auth::user()->profile_url}}" alt="">
                            <span>{{Auth::user()->display_name}}</span>
                            <i class="caret"></i>
                            @else
                            <img src="{{asset('public/assets/images/placeholder.jpg')}}" alt="">
                            <span>Guest User</span>
                            @endif
                        </a>
                        @if(Auth::check())
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{URL::route('auth.logout')}}"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main navbar -->
        <!-- Page header -->
        @include('layouts.breadcum')
        <!-- /page header -->
        <!-- Page container -->
        <div class="page-container">
            @include('layouts.message')
            <!-- Page content -->
            @include('layouts.content')    
        </div>
        <!-- Footer -->
        <div class="footer text-muted">
            &copy; {{date("Y")}}. <a href="https://streamlabs.com/" target="_blank">Streamlabs </a>
        </div>
        <!-- /footer -->
        @include('layouts.script')

        @yield('js')
        @stack('scripts-footer')
        @stack('scripts')
    </body>
</html>