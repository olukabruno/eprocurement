<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <!-- Styles -->


    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/releway.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lato.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @guest
        @else
        <div class="navbar navbar-default navbar-static-top" >
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}" style="padding: 10px 1px 5px;">
                        <img src="{{asset('images/sfclogo.png')}}" width="30px" height="30px">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">





                            <li><a href="{{route('ppmp.index')}}">PPMP Form</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Purchase Request<span class="caret"></span></a>

                                 <ul class="dropdown-menu">
                                    <li><a href="{{ url('/pr/form') }}">Add Purchase Request</a></li>
                                    <li><a href="{{route('supplemental')}}">Supplemental Purchase Request</a></li>
                                    @if(Auth::user()->isBACSec == 1 || Auth::user()->role == 1)
                                        <li><a href="{{route('pr.bac')}}">Close Purchase Request</a></li>
                                    @endif
                                    <!-- <li><a href="http://bfgs.sanfernandocity.gov.ph/">Archives (Old system)</a></li> -->
                                    <li><a href="{{route('pr.archive')}}">Archives (Current system)</a></li>
                                </ul>

                            </li>

                            <li><a href="{{route('rfq')}}">RFQ Form</a></li>

                            <li><a href="{{route('abstract.view')}}">Abstract</a></li>

                            <li><a href="{{route('po.index')}}">Purchase Order</a></li>

                            <li><a href="{{route('ir.index')}}">Inspection Report</a></li>


                            @if(Auth::user()->role == 1)



                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Settings<span class="caret"></span></a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/usermgt') }}">User Management</a></li>
                                    <li><a href="{{ url('/signatory') }}">Signatories</a></li>
                                    <li><a href="{{ url('/soledist') }}">Distributors</a></li>
                                    <li><a href="{{route('unit.view')}}">Unit</a></li>
                                    <!-- <li><a href="#">Logs</a></li> -->
                                </ul>
                            </li>
                            @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/changePassword') }}">Change Password</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                    </ul>
                </div>
            </div>
        </div>
        @endguest
    @include('layouts.FlashMessage')
    @yield('content')

    </div>

    <!-- Scripts -->
    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 2000);
    });
    </script>
    @yield('script')




</body>
</html>
