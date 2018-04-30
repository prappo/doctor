@extends('layouts.app')
@section('title','Users List')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <div class="content">
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach(\App\User::all() as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td> {{$user->type}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-danger" data-id="{{$user->id}}">Delete</a>
                                    <a class="btn btn-primary" href="{{url('/user/edit')}}/{{$user->id}}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>
        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');


            swal({
                title: "Are you sure ?",
                text: "Do you want to delete this user ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                html: true
            }, function () {
                $.ajax({
                    url: '{{url('/admin/user/delete')}}',
                    type: 'POST',
                    data: {
                        'id': id
                    }, success: function (data) {
                        if (data == "success") {
                            swal("Success", "User deleted", "success");
                            location.reload();
                        } else {
                            swal("Error", data, "warning");
                        }
                    },
                    error: function (data) {
                        swal("Error", "Something went wrong", "error");
                        console.log(data.responseText);
                    }
                })
            });

        })
    </script>
@endsection