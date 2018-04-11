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
                <li class="treeview @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) active @endif">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>{{trans('sidebar.Admin Panel')}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) menu-open @endif" style="display: @if(Request::is('admin') || Request::is('user/add') || Request::is('user/list') || Request::is('admin/options')) block @else none @endif">
                        <li @if(Request::is('admin')) class="active" @endif><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>
                                <span>{{trans('sidebar.Admin Dashboard')}}</span></a></li>
                        <li @if(Request::is('user/add')) class="active" @endif><a href="{{ url('/user/add') }}"><i class="fa fa-plus-circle"></i>
                                <span>{{trans('sidebar.Add User')}}</span></a>
                        </li>
                        <li @if(Request::is('user/list')) class="active" @endif><a href="{{ url('/user/list') }}"><i class="fa fa-users"></i>
                                <span>{{trans('sidebar.Users')}}</span></a></li>
                        <li @if(Request::is('admin/options')) class="active" @endif><a href="{{ url('/admin/options') }}"><i class="fa fa-key"></i>
                                <span>{{trans('sidebar.Admin Options')}}</span></a></li>

                        {!! \App\Http\Controllers\Plugins::menu("admin") !!}

                    </ul>
                </li>

            @endif
            <li @if(Request::is('home')) class="active" @endif ><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>{{trans('sidebar.Dashboard')}}</span>
                </a></li>
            <li @if(Request::is('write')) class="active" @endif ><a href="{{ url('/write') }}"><i class="fa fa-edit"></i> <span>{{trans('sidebar.Post')}}</span></a>
            </li>

            <li @if(Request::is('facebook')) class="active" @endif ><a href="{{ url('/facebook') }}"><i
                            class="fa fa-files-o"></i><span>{{trans('sidebar.Facebook Pages')}} </span></a></li>
            <li @if(Request::is('fbgroups')) class="active" @endif ><a href="{{ url('/fbgroups') }}"><i
                            class="fa fa-users"></i><span>{{trans('sidebar.Facebook Groups')}} </span></a></li>
            <li @if(Request::is('conversations')) class="active" @endif ><a href="{{ url('/conversations') }}"><i
                            class="fa fa-comments"></i><span>{{trans('sidebar.Conversations')}} </span></a></li>

            <li @if(Request::is('fb/bot')) class="active" @endif><a href="{{ url('/fb/bot') }}"><i class="fa fa-commenting-o"></i>
                    <span>{{trans('sidebar.Messenger Bot')}}</span></a></li>

            <li @if(Request::is('fbmassgrouppost')) class="active" @endif ><a href="{{ url('/fbmassgrouppost') }}"><i
                            class="fa fa-bolt"></i><span>{{trans('sidebar.Mass Public Group Post')}} </span></a>
            </li>

            <li @if(Request::is('fb/mass/own/grope/post')) class="active" @endif ><a href="{{ url('/fb/mass/own/grope/post') }}"><i
                            class="fa fa-bolt"></i><span>{{trans('sidebar.Mass Own Group Post')}} </span></a>
            </li>
            <li @if(Request::is('facebook/masscomment')) class="active" @endif ><a href="{{ url('/facebook/masscomment') }}"><i
                            class="fa fa-comment"></i><span>{{trans('sidebar.Facebook Mass Comment')}} </span></a><li @if(Request::is('facebook/masscomment')) class="active" @endif ><a href="{{ url('/facebook/masscomment') }}"><i
                            class="fa fa-comment"></i><span>{{trans('sidebar.Facebook Mass Comment')}} </span></a>
            </li>
            <li @if(Request::is('masssend')) class="active" @endif ><a href="{{ url('/masssend') }}"><i
                            class="fa fa-star"></i><span>{{trans('sidebar.Facebook Mass Send')}} </span></a></li>
            <li @if(Request::is('campaign')) class="active" @endif ><a href="{{ url('/campaign') }}"><i
                            class="fa fa-send"></i><span>{{trans('Campaign')}} </span></a></li>

            {{--<li @if(Request::is('stream')) class="active" @endif><a href="{{url('/stream')}}"><i class="fa fa-fire"></i> <span>Stream</span></a></li>--}}
            <li @if(Request::is('extend')) class="active" @endif><a href="{{url('/extend')}}"><i class="fa fa-code"></i> <span>Website Integration</span></a></li>
            <li @if(Request::is('monitor')) class="active" @endif ><a href="{{url('/monitor')}}"><i class="fa fa-user-secret"></i> <span>Monitor</span></a></li>
            <li @if(Request::is('capture')) class="active" @endif ><a href="{{url('/capture')}}"><i class="fa fa-database"></i> <span>Capture</span></a></li>
            <li @if(Request::is('scraper')) class="active" @endif ><a href="{{ url('scraper') }}"><i
                            class="fa fa-search"></i><span>{{trans('sidebar.Facebook Search')}}</span> </a></li>

            {!! \App\Http\Controllers\Plugins::menu("facebook") !!}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span>{{trans('sidebar.Schedule')}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: none">

                    <li><a href="{{ url('/schedule/day') }}"><i class="fa fa-list-ul"></i>
                            <span>{{trans('sidebar.Posts')}}</span></a></li>


                </ul>
            </li>

            <li @if(Request::is('settings')) class="active" @endif ><a href="{{ url('/settings') }}"><i
                            class="fa fa-gear"></i><span>{{trans('sidebar.Settings')}}</span></a></li>
            <li @if(Request::is('profile')) class="active" @endif ><a href="{{ url('/profile') }}"><i class="fa fa-user"></i>
                    <span>{{trans('sidebar.Profile')}}</span></a></li>


            {!! \App\Http\Controllers\Plugins::menu("all") !!}


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
