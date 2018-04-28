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

            <div style="padding-left:20px;padding-right:20px;padding-top:20px" class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{\App\Call::where('to',Auth::user()->id)->count()}}</h3>

                            <p>Total Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-plus"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{\App\Call::where('to',Auth::user()->id)->where('status','done')->count()}}</h3>

                            <p>Job Done</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-plus"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{\App\Prescription::where('from',Auth::user()->id)->count()}}</h3>

                            <p>Prescriptions given</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-table"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{\App\Feedback::where('docId',Auth::user()->id)->count()}}</h3>

                            <p>Total Feedback</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comments"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div style="padding-left:20px;padding-right:20px" class="row">
                <div class="col-md-12">
                    <marquee class="label-info"><b>News : Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Dolorum molestias nulla quibusdam voluptatibus.</b></marquee>

                </div>
            </div>
            <div style="padding:20px" class="row">
                <div class="col-md-6" style="border: 1px black solid;">
                    <div id="calendar"></div>
                </div>
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
                                    <button class="btn btn-success btn-confirm" data-id="{{$call->id}}">Confirm
                                    </button>
                                    <button class="btn btn-danger btn-decline" data-id="{{$call->id}}">Decline
                                    </button>
                                </div>

                                <div style="display:none" id="job">
                                    <h1 id="timer"></h1>
                                    <button id="writePrescription" class="btn btn-primary btn-block"><i
                                                class="fa fa-edit"></i> Write Prescription
                                    </button>
                                    <br>

                                    <div style="display:none" id="prescriptionDiv">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input type="text" id="pName"
                                                   value="{{\App\User::where('id',$call->from)->value('name')}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Sex</label>
                                            <select class="form-control" id="sex">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control" id="age">
                                        </div>

                                        <div class="form-group">
                                            <label>Chief Complaints</label>
                                            <textarea id="chiefComplaints" class="form-control" rows="4"
                                                      placeholder="Type here.."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>General Examinations</label>
                                            <textarea id="generalExaminations" class="form-control" rows="4"
                                                      placeholder="Type here.."></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label>Advice for investigations</label>
                                            <textarea id="adviceForInvestigations" class="form-control" rows="4"
                                                      placeholder="Type here.."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Advice for Patient</label>
                                            <textarea id="advice" class="form-control" rows="4"
                                                      placeholder="Type here.."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Next visit date</label>
                                            <input type="date" class="form-control" id="date">
                                        </div>

                                        <div class="form-group">
                                            <label>Prescription</label>
                                            <textarea id="pTxt" class="form-control" rows="4"
                                                      placeholder="Type here.."></textarea>
                                        </div>
                                    </div>


                                    <button data-id="{{$call->id}}" data-to="{{$call->to}}"
                                            data-from="{{$call->from}}"
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

                <div style="padding:20px" class="row">


                </div>


            </div>


        </div>


        @include('components.footer')

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">

@endsection
@section('js')
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
    <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.1/timer.jquery.min.js"></script>
    <script>
        $('#calendar').fullCalendar({
            weekends: true, // will hide Saturdays and Sundays
            left: 'title',
            center: '',
            right: 'today prev,next'
        });

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
                    'time': $('#timer').text(),
                    'pTxt': $('#pTxt').val(),
                    'pName': $('#pName').val(),
                    'sex': $('#sex').val(),
                    'age':$('#age').val(),
                    'chiefComplaint':$('#chiefComplaints').val(),
                    'generalExaminations':$('#generalExaminations').val(),
                    'adviceForInvestigations':$('#adviceForInvestigations').val(),
                    'advice':$('#advice').val(),
                    'date':$('#date').val()
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


        });
        $('#writePrescription').click(function () {
            $('#prescriptionDiv').toggle();
        })
    </script>
@endsection








