<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img @if(Auth::user()->img == "") src="{{ url('/images/admin-lte/avatar.png') }}"
                     @else src="{{Auth::user()->img}}" @endif class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            {{--admin menu--}}
            @if(Auth::user()->type == 'admin')
                {{--<li class="treeview @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) active @endif">--}}
                {{--<a href="#">--}}
                {{--<i class="fa fa-th"></i>--}}
                {{--<span>{{trans('sidebar.Admin Panel')}}</span>--}}
                {{--<i class="fa fa-angle-left pull-right"></i>--}}
                {{--</a>--}}

                {{--<ul class="treeview-menu @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) menu-open @endif"--}}
                {{--style="display: @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) block @else none @endif">--}}
                {{--<li @if(Request::is('admin')) class="active" @endif><a href="{{ url('/admin') }}"><i--}}
                {{--class="fa fa-dashboard"></i>--}}
                {{--<span>{{trans('sidebar.Dashboard')}}</span></a></li>--}}


                {{--</ul>--}}
                {{--</li>--}}

                <li @if(Request::is('user/home')) class="active" @endif ><a href="{{ url('/user/home') }}"><i
                                class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a></li>


                <li @if(Request::is('user/add')) class="active" @endif ><a href="{{ url('/user/add') }}"><i
                                class="fa fa-plus"></i> <span>{{trans('sidebar.Add User')}}</span>
                    </a></li>

                <li @if(Request::is('admin/user/edit')) class="active" @endif ><a
                            href="{{ url('/admin/user/edit') }}"><i
                                class="fa fa-dashboard"></i> <span>{{trans('sidebar.Edit User')}}</span>
                    </a></li>

                <li @if(Request::is('category/add')) class="active" @endif ><a
                            href="{{ url('/category/add') }}"><i class="fa fa-th-list"></i> <span>Categories</span>
                    </a>
                </li>


                <li @if(Request::is('user/prescriptions')) class="active" @endif ><a href="{{ url('/user/prescriptions') }}"><i
                                class="fa fa-edit"></i> <span>All Prescriptions</span>
                    </a></li>

                <li @if(Request::is('user/calls')) class="active" @endif ><a href="{{ url('/user/calls') }}"><i
                                class="fa fa-phone"></i> <span>Requests</span>
                    </a></li>

                <li @if(Request::is('user/feedback')) class="active" @endif ><a href="{{ url('/user/feedback') }}"><i
                                class="fa fa-reply"></i> <span>Feedback</span>
                    </a></li>

                <li @if(Request::is('admin/user/settings/update')) class="active" @endif ><a
                            href="{{ url('/admin/user/settings/update') }}"><i
                                class="fa fa-gears"></i> <span>Settings</span>
                    </a></li>

                <li><a href="{{ url('/logout') }}"><i
                                class="fa fa-sign-out"></i> <span>Logout</span>
                    </a></li>




            @endif

            @if(Auth::user()->type == "Doctor")
                <li @if(Request::is('user/home')) class="active" @endif ><a href="{{ url('/user/home') }}"><i
                                class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a></li>
                <li @if(Request::is('doctor/service')) class="active" @endif ><a href="{{ url('/doctor/service') }}"><i
                                class="fa fa-files-o"></i> <span>Service Log</span>
                    </a></li>

                <li @if(Request::is('user/prescriptions')) class="active" @endif ><a href="{{ url('/user/prescriptions') }}"><i
                                class="fa fa-edit"></i> <span>My Prescriptions</span>
                    </a></li>

                <li @if(Request::is('user/feedback')) class="active" @endif ><a href="{{ url('/user/feedback') }}"><i
                                class="fa fa-reply"></i> <span>Feedback</span>
                    </a></li>

                <li @if(Request::is('user/profile')) class="active" @endif ><a href="{{ url('/user/profile') }}"><i
                                class="fa fa-user-md"></i> <span>Profile</span>
                    </a></li>
                <li><a href="{{ url('/logout') }}"><i
                                class="fa fa-sign-out"></i> <span>Logout</span>
                    </a></li>
            @endif


            @if(Auth::user()->type == "Patient")
                <li @if(Request::is('user/home')) class="active" @endif ><a href="{{ url('/user/home') }}"><i
                                class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a></li>

                <li @if(Request::is('doctor/service')) class="active" @endif ><a href="{{ url('/doctor/service') }}"><i
                                class="fa fa-files-o"></i> <span>Service Log</span>
                    </a></li>

                <li @if(Request::is('user/prescriptions')) class="active" @endif ><a href="{{ url('/user/prescriptions') }}"><i
                                class="fa fa-edit"></i> <span>My Prescriptions</span>
                    </a></li>

                <li @if(Request::is('user/feedback')) class="active" @endif ><a href="{{ url('/user/feedback') }}"><i
                                class="fa fa-reply"></i> <span>Feedback</span>
                    </a></li>



                <li><a href="{{ url('/logout') }}"><i
                                class="fa fa-sign-out"></i> <span>Logout</span>
                    </a></li>
            @endif


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>























