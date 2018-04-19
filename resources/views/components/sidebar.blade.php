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



                <li @if(Request::is('user/add')) class="active" @endif ><a href="{{ url('/user/add') }}"><i
                                class="fa fa-plus"></i> <span>{{trans('sidebar.Add User')}}</span>
                    </a></li>

                <li @if(Request::is('admin/user/edit')) class="active" @endif ><a href="{{ url('/admin/user/edit') }}"><i
                                class="fa fa-dashboard"></i> <span>{{trans('sidebar.Edit User')}}</span>
                    </a></li>



            @endif



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
