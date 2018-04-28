<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->

        <span class="logo-mini"><img
                    src="@if(Auth::user()->theme == 'skin-black' || Auth::user()->theme == 'skin-black-light') @if(\App\Http\Controllers\Settings::getSettings('logo')==""){{ url('/images/optimus/logo-login.png')}} @else {{url('/uploads')}}/{{\App\Http\Controllers\Settings::getSoftwareSettings('logo')}} @endif @else {{ url('/images/optimus/logo-mini.png') }} @endif"
                    alt="Doctor"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img
                    src="@if(Auth::user()->theme == 'skin-black' || Auth::user()->theme == 'skin-black-light') @if(\App\Http\Controllers\Settings::getSettings('logo')=="") {{ url('/images/optimus/logo-login.png')}} @else {{url('/uploads')}}/{{\App\Http\Controllers\Settings::getSoftwareSettings('logo')}} @endif @else {{ url('/images/optimus/logo-mini.png') }} @endif"
                    alt="Doctor"><b>Doctor</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(Auth::user()->type == "Doctor")
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{\App\Call::where('to',Auth::user()->id)->where('status','pending')->count()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You
                                have {{\App\Call::where('to',Auth::user()->id)->where('status','pending')->count()}}
                                notifications
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach(\App\Call::where('to',Auth::user()->id)->where('status','pending')->get() as $call)
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-aqua"></i> <b>{{\App\User::where('id',$call->from)->value('name')}}</b> sent you a request
                                            </a>
                                        </li>

                                    @endforeach

                                </ul>
                            </li>
                            <li class="footer"><a href="{{url('/user/home')}}">View all</a></li>
                        </ul>
                    </li>

                @endif


                <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img @if(Auth::user()->img == "") src="{{ url('/images/admin-lte/avatar.png') }}"
                                 @else src="{{Auth::user()->img}}" @endif class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ \Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <img @if(Auth::user()->img == "") src="{{ url('/images/admin-lte/avatar.png') }}"
                                     @else src="{{Auth::user()->img}}" @endif class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{ \Auth::user()->name }}
                                    <small>{{ \Auth::user()->email }}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('/profile')}}"
                                       class="btn btn-default btn-flat">{{trans('navigation.Profile')}}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}"
                                       class="btn btn-default btn-flat">{{trans('navigation.Sign out')}}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
            </ul>
        </div>
    </nav>
</header>