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
                <hr>
                <div class="row" style="padding:20px">
                    <div class="col-md-6">
                        @foreach(\App\Category::all() as $cat)
                            <li style="list-style-type: none">
                                <div class="box">
                                    <div class="box-header">
                                        <h3><i class="fa fa-circle-o"
                                               style="color:black"></i> {{$cat->value}}</h3>
                                    </div>

                                    <div class="box-footer">
                                        <div class="btn-group">
                                            <button data-id="{{$cat->id}}" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-times"></i> Delete
                                            </button>
                                            <button data-value="{{$cat->value}}" data-id="{{$cat->id}}"
                                                    class="btn btn-edit btn-primary btn-xs"><i
                                                        class="fa fa-edit"></i> Edit
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </li>

                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach(\App\User::where('type','Doctor')->get() as $doctor)
                            @if($doctor->cat != "")
                                <i style="color:blue" class="fa fa-circle"></i> {{$doctor->name}} assigned
                                to {{\App\Category::where('id',$doctor->cat)->value('value')}} category <br>

                            @endif
                        @endforeach
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
        });
        $('.btn-danger').click(function (data) {
            var id = $(this).attr('data-id');
            if (confirm("Are you sure you want to delete this category ?")) {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/cat/delete')}}',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == "success") {
                            location.reload();
                        } else {
                            swal("Error !", data, "warning");
                        }
                    },
                    error: function (data) {
                        swal("Error", "Something went wrong", "error");
                        console.log(data.responseText);
                    }
                })
            }

        });

        $('.btn-edit').click(function () {
            var id = $(this).attr('data-id');
            var value = $(this).attr('data-value');
            var msgBox = prompt(value);
            if (msgBox != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/cat/edit')}}',
                    data: {
                        'id': id,
                        'value': msgBox
                    },
                    success: function (data) {
                        if (data == "success") {
                            alert("Success");
                            location.reload();
                        } else {
                            swal("Error", data, "warning");
                        }
                    },
                    error: function (data) {
                        swal("Error", "Something went wrong", "warning");
                        console.log(data.responseText);
                    }

                });
            } else {
                alert("Can't be empty");
            }

        });


    </script>
@endsection


















