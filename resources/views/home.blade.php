@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">


                <div class="row">
                    <div class="col-md-6">
                        <!-- USERS LIST -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Doctors</h3>

                                <div class="box-tools pull-right">
                                    <span class="label label-success">8 Doctors Available</span>


                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                    <li>
                                        <img src="{{url('/images/admin-lte/avatar.png')}}" alt="User Image">
                                        <a class="users-list-name" href="#"><i class="fa fa-circle text-success"></i>
                                            Doctor 1</a>
                                        <a class="btn btn-xs btn-primary">Contact</a>
                                    </li>
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!--/.box -->
                    </div>
                    <div class="col-md-6">
                        <!-- USERS LIST -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">How to contact with Doctor</h3>

                                <div class="box-tools pull-right">


                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias eligendi enim fugiat
                                    numquam possimus? A autem eaque facilis, ipsam iste laboriosam magni mollitia neque
                                    placeat praesentium quam, quibusdam rerum tenetur, vel vero. Aliquam, consequatur
                                    delectus dicta ea enim molestiae nihil odit perspiciatis possimus quod repellat,
                                    similique suscipit totam, velit voluptate.
                                </p>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!--/.box -->
                    </div>
                </div>
            </section>


        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')

@endsection