@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{trans('dashboard.Dashboard')}}</h1>
            </section>

            <div class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number">{{\App\User::all()->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-send"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Requests</span>
                                <span class="info-box-number">{{\App\Call::all()->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Prescriptions</span>
                                <span class="info-box-number">{{\App\Prescription::all()->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Feedbacks</span>
                                <span class="info-box-number">{{\App\Feedback::all()->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <hr>
                <h4>Online Users :

                </h4>
                <hr>
                @if($users)

                    @foreach($users as $user)

                        @if($user->isOnline())
                            <a href="#"><i class="fa fa-circle text-success"></i> </i> <b>{{$user->name}} </b> ( {{$user->type}} )</a> <br>
                        @endif

                    @endforeach
                @endif
            </div>



        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')

@endsection