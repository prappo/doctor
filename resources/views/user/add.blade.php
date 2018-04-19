@extends('layouts.app')
@section('title','Add User')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>

            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new user</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" required class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" id="name" placeholder="Full Name">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">Type</label>

                                <div class="col-sm-10">
                                    <select class="form-control" id="type">
                                        <option id="patient">Patient</option>
                                        <option id="doctor">Doctor</option>
                                        <option id="admin">Admin</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button id="add" type="button" class="btn btn-block btn-info pull-right">Add new user
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>
        $('#add').click(function () {
            $.ajax({
                url: '{{url('/user/add')}}',
                type: 'POST',
                data: {
                    'email': $('#email').val(),
                    'name': $('#name').val(),
                    'password': $('#password').val(),
                    'type': $('#type').val()
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "New user created", "success");
                    } else {
                        swal("Error", data, "error");
                    }
                }, error: function (data) {
                    swal("Error", "Something went wrong", "error");
                    console.log(data.responseText);
                }
            });
        })
    </script>
@endsection

















