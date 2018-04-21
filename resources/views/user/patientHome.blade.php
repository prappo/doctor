@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>
            <div class="row">
                <div class="col-md-4">
                    @if($doctors)

                        @foreach($doctors as $user)

                            @if($user->isOnline())
                                <div class="col-md-12">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-aqua-active">
                                            <h3 class="widget-user-username"><i
                                                        class="fa fa-user-md"></i> {{$user->name}}</h3>
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{url('/images/optimus/logo-login.png')}}"
                                                 alt="User Avatar">
                                        </div>
                                        <div class="box-footer">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b> {{$user->bio}} </b>
                                                </div>


                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header"><a href="#"><i
                                                                        class="fa fa-circle text-success"></i> <b
                                                                        style="color: green">Online</b></a></h5>

                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <div class="description-block">
                                                        <button data-name="{{$user->name}}" data-to="{{$user->id}}"
                                                                data-from="{{Auth::user()->id}}"
                                                                id="{{$user->id}}"
                                                                class="btn btn-doc btn-success btn-block"><i
                                                                    class="fa fa-phone"></i> Contact
                                                        </button>

                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>

                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>

                            @endif

                        @endforeach
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="col-md-11">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3><i class="fa fa-dashboard"></i> Dashboard</h3>
                            </div>

                            <div class="box-body">
                                @if(\App\Call::where('from',Auth::user()->id)->where('status','pending')->count() == 1)
                                    <div id="goo">
                                        <input type="hidden" id="jobId"
                                               value="{{\App\Call::where('from',Auth::user()->id)->where('status','pending')->value('id')}}">
                                    </div>

                                @endif
                                @foreach(\App\Call::where('from',Auth::user()->id)->where('status','pending')->get() as $call)
                                    <div class="box">
                                        <div class="box-header">
                                            {{\Carbon\Carbon::parse($call->created_at)->diffForHumans()}}
                                        </div>
                                        <div class="box-body">
                                            You sent a request to {{\App\User::where('id',$call->to)->value('name')}}.
                                            Please wait.
                                        </div>
                                        <div class="box-footer">

                                            <button class="btn btn-danger btn-decline" data-id="{{$call->id}}"><i
                                                        class="fa fa-times"></i> Cancel the request
                                            </button>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                            <div class="box-footer">
                                <p id="msg"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>

        if (document.getElementById('goo')) {
            var jobId = $("#jobId").val();
            setInterval(function () {
                sync(jobId);
            }, 3000);
        }
        $('.btn-doc').click(function () {
            var to = $(this).attr('data-to');
            var from = $(this).attr('data-from');
            var name = $(this).attr('data-name');

            swal({
                title: "Are you sure?",
                text: "You are going to contact with this doctor",
                type: "",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                html: false
            }, function () {

                contact(from, to, name);


            });


        });

        function contact(from, to, name) {
            $.ajax({
                url: '{{url('/call')}}',
                type: 'POST',
                data: {
                    'from': from,
                    'to': to
                },
                success: function (data) {
                    if (data == "success") {

                        location.reload();
                    } else {
                        swal("Warning", data, "warning");
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong", "error");
                    console.log(data.responseText);
                }
            })
        }


        $('.btn-decline').click(function () {
            var id = $(this).attr('data-id');


            swal({
                title: "Are you sure ?",
                text: "Do you want to cancel this request ?",
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


        function sync(id) {
            $.ajax({
                type: 'POST',
                url: '{{url('/call/sync')}}',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data.msg == "confirm") {
                        doctorName = data.doctorName;
                        doctorContact = data.doctorContact;
                        swal("Accepted !", doctorName + " Accepted your request and here is his skype id : '" + doctorContact + "' \n He is online and waiting for you. Please contact him as soon as possible")
                    } else if (data.msg == "done") {
                        alert("Feed back form will appear");
                    }


                }
            });
        }
    </script>
@endsection














