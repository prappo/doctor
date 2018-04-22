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
                            <div id="btnGroup">
                                <button class="btn btn-success btn-confirm" data-id="{{$call->id}}">Confirm</button>
                                <button class="btn btn-danger btn-decline" data-id="{{$call->id}}">Decline</button>
                            </div>

                            <div style="display:none" id="job">
                                <h1 id="timer"></h1>
                                <div class="form-group">
                                    <label class="form-control">Prescription</label>
                                    <textarea id="pTxt" class="form-control" rows="4" placeholder="Type here.."></textarea>
                                </div>
                                <button data-id="{{$call->id}}" data-to="{{$call->to}}" data-from="{{$call->from}}"
                                        id="timerStop"
                                        class="btn btn-success btn-block">Finish
                                </button>
                            </div>
                            <div id="msgDiv" style="display: none">
                                <h3 style="color: green" id="msg"></h3>
                            </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.1/timer.jquery.min.js"></script>
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
                confirmButtonColor: "green",
                confirmButtonText: "Yes",
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
                            $('#btnGroup').hide();
                            $('#job').show();
                            $('#timer').timer();

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

        $('#timerStop').click(function () {
            var to = $(this).attr('data-to');
            var from = $(this).attr('data-from');
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '{{url('/call/done')}}',
                data: {
                    'id': id,
                    'time':$('#timer').text(),
                    'pTxt':$('#pTxt').val()
                },
                success: function (data) {
                    if (data == "success") {
                        $('#timer').timer('pause');
                        $('#job').hide(200);
                        swal("Wow !", "Job done! Thank you for your service", "success");
                        $("#msg").html("Your service time : " + $("#timer").text());
                        $("#msgDiv").show(200);
                    } else {
                        swal("Error", data, "error");
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








