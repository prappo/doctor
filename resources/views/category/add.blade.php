@extends('layouts.app')
@section('title','Category')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>

            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Category Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="txtCategory" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <br>
                                <button class="btn btn-success btn-block" id="add"><i class="fa fa-plus"></i> Add
                                    Category
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-4">
                                <lable>Category</lable>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="category">
                                    @foreach(\App\Category::all() as $cat)
                                        <option value="{{$cat->id}}">{{$cat->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <div class="col-md-4">
                                <lable>Doctor</lable>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="doctor">
                                    @foreach(\App\User::where('type','Doctor')->get() as $doc)
                                        <option value="{{$doc->id}}">{{$doc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block" id="assign"><i class="fa fa-user-md"></i> Assign
                            Doctor
                        </button>
                    </div>
                </div>

            </div>


        </div>

        @include('components.footer')
    </div>
@endsection

@section('js')
    <script>
        $("#add").click(function () {
            $.ajax({
                url: '{{url('/category/add')}}',
                type: 'POST',
                data: {
                    'value': $('#txtCategory').val()
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "New category added", "success");
                        location.reload();
                    } else {
                        swal("Warning !", data, "warning");
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong", "error");
                    console.log(data.responseText);
                }
            });

        });

        $('#assign').click(function () {
            $.ajax({
                url: '{{url('/category/assign')}}',
                type: 'POST',
                data: {
                    'userId': $('#doctor').val(),
                    'cat': $('#category').val()
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Doctor assigned to this category", "success");
                        location.reload();
                    } else {
                        swal("Warning!", data, "warning");
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong", "error");
                    console.log(data.responseText);
                }
            });
        })
    </script>
@endsection


















