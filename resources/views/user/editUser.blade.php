@extends('layouts.app')
@section('title','Edit User')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>
            <div class="content">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Update user</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label">Email</label>

                                        <div class="col-sm-8">
                                            <input type="email" value="{{$data->email}}" required class="form-control"
                                                   id="email" placeholder="Email">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">Name</label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->name}}" type="text" required class="form-control"
                                                   id="name" placeholder="Full Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name_bangla" class="col-sm-4 control-label">Name ( Bangla )</label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->name_bangla}}" type="text" required
                                                   class="form-control"
                                                   id="name_bangla" placeholder="Full Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio1" class="col-sm-4 control-label">Bio 1</label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->bio}}" type="text" required class="form-control"
                                                   id="bio1" placeholder="Write here">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio1_bangla" class="col-sm-4 control-label">Bio 1 ( Bangla )</label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->bio_bangla}}" type="text" required
                                                   class="form-control"
                                                   id="bio1_bangla" placeholder="Write here">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio2" class="col-sm-4 control-label">Bio 2</label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->bio_a}}" type="text" required class="form-control"
                                                   id="bio2" placeholder="Write here">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio2_bangla" class="col-sm-4 control-label">Bio 2 ( Bangla
                                            ) </label>

                                        <div class="col-sm-8">
                                            <input value="{{$data->bio_a_bangla}}" type="text" required
                                                   class="form-control"
                                                   id="bio2_bangla" placeholder="Write here">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="skype" class="col-sm-4 control-label">Skype </label>

                                        <div class="col-sm-8">
                                            <input {{$data->skype}} type="text" required class="form-control" id="skype"
                                                   placeholder="Write here">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="password" class="col-sm-4 control-label">Password</label>

                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password"
                                                   placeholder="Password">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="type" class="col-sm-4 control-label">Type</label>

                                        <div class="col-sm-8">
                                            <input type="text" id="type" disabled value="{{$data->type}}">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                    <button id="update" type="button" class="btn btn-block btn-info pull-right">Update
                                        user
                                    </button>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>
                        <!-- /.box -->

                    </div>
                </div>
            </div>
        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>
        $('#update').click(function () {
            $.ajax({
                url: '{{url('/user/update')}}',
                type: 'POST',
                data: {
                    'userId':'{{$id}}',
                    'email': $('#email').val(),
                    'name': $('#name').val(),
                    'name_bangla': $('#name_bangla').val(),
                    'bio1': $('#bio1').val(),
                    'bio1_bangla': $('#bio1_bangla').val(),
                    'bio2': $('#bio2').val(),
                    'bio2_bangla': $('#bio2_bangla').val(),
                    'skype': $('#skype').val(),
                    'password': $('#password').val(),
                    'type': $('#type').val()
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "User information updated", "success");
                        location.reload();
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

















