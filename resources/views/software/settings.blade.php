@extends('layouts.app')
@section('title','Software Settings')
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
                                <h3 class="box-title">Software settings</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="news" class="col-sm-4 control-label">News</label>

                                        <div class="col-sm-8">
                                            <input type="text" value="{{\App\Http\Controllers\SettingsController::get_news()}}" class="form-control" id="news"
                                                   placeholder="News">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="p_left" class="col-sm-4 control-label">Prescription Left
                                            Corner</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{\App\Http\Controllers\SettingsController::getP_left()}}" id="p_left"
                                                   placeholder="Write here...">
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="p_right" class="col-sm-4 control-label">Prescription Right
                                            Corner</label>

                                        <div class="col-sm-8">
                                            <input type="text" value="{{\App\Http\Controllers\SettingsController::getP_right()}}" class="form-control" id="p_right"
                                                   placeholder="Write here...">
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                    <button id="update" type="button" class="btn btn-block btn-info pull-right">Update
                                        Settings
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
                type: 'POST',
                url: '{{url('/settings/update')}}',
                data: {
                    'p_left': $('#p_left').val(),
                    'p_right': $('#p_right').val(),
                    'news': $('#news').val()
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Settings updated !", "success");
                        location.reload();
                    } else {
                        swal("Error", data, "error");
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong", "error");
                    console.log(data.responseText);
                }
            })
        })
    </script>


@endsection

















