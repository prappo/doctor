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

            <div class="col-md-6">
                @foreach(\App\Call::where('to',Auth::user()->id)->where('status','pending')->get() as $call)
                    <div class="box">
                        <div class="box-header">
                            {{\Carbon\Carbon::parse($call->created_at)->diffForHumans()}}
                        </div>
                        <div class="box-body">
                            {{\App\User::where('id',$call->from)->value('name')}} want to contact with you
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-confirm" data-id="{{$call->id}}">Confirm</button>
                            <button class="btn btn-danger btn-decline" data-id="{{$call->id}}">Decline</button>
                        </div>
                    </div>

                @endforeach
            </div>

            <div class="col-md-6">
                <div class="status">

                </div>
            </div>


        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>


        $('.btn-decline').click(function () {
            var id = $(this).attr('data-id');


            swal({
                title: "Are you sure ?",
                text: "Do you want to cancel this request from patient ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, cancel it!",
                closeOnConfirm: false,
                html: true
            }, function () {
                $.ajax({
                    url: '{{url('/call/decline')}}',
                    type: 'POST',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == "success") {
                            swal("Success", "Declined", "success");
                            location.reload();
                        } else {
                            swal("Error", data, "error");
                        }

                    }, error: function (data) {
                        swal("Error", "Something went wrong", "error");
                        console.log(data.responseText);
                    }
                })
            });

        });

        $('.btn-confirm').click(function () {
            var id = $(this).attr('data-id');


            swal({
                title: "Are you sure ?",
                text: "Do you want to confirm this request from patient ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, cancel it!",
                closeOnConfirm: false,
                html: true
            }, function () {
                $.ajax({
                    url: '{{url('/call/confirm')}}',
                    type: 'POST',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == "success") {
                            swal("Success", "Confirmed", "success");

                        } else {
                            swal("Error", data, "error");
                        }

                    }, error: function (data) {
                        swal("Error", "Something went wrong", "error");
                        console.log(data.responseText);
                    }
                })
            });

        });
    </script>
@endsection








