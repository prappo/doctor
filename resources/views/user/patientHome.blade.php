@extends('layouts.app')
@section('title','Dashboard (patient)')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{Auth::user()->name}}</h1>
            </section>
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-reply"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Feedback</span>
                                <span class="info-box-number">{{\App\Feedback::where('userId',Auth::user()->id)->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-send"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Request sent</span>
                                <span class="info-box-number">{{\App\Call::where('from',Auth::user()->id)->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div style="padding-left: 15px;padding-right: 15px" class="row">
                    <div class="col-md-12">
                        <marquee class="label-info">
                            <b> {{"News :".\App\Http\Controllers\SettingsController::get_news()}}</b>
                        </marquee>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <lable>Select Doctor category</lable>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="category">
                                    <option value="select">Select category</option>
                                    @foreach(\App\Category::all() as $cat)

                                        <option value="{{$cat->id}}">{{$cat->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="modal modal-success fade" id="modal-feedback">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">


                        <h4 class="modal-title">FeedBack</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Write your FeedBack</label>
                            <textarea id="txtFeedback" class="form-control" rows="3"
                                      placeholder="Write here ..."></textarea>
                            <br>
                            <button id="getP" class="btn btn-primary"><i
                                        class="fa fa-external-link"></i> Click here to get your prescription
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="docId">
                        <input type="hidden" id="patId">

                        <button id="btnModalHide" type="button" class="btn btn-outline">Submit Feedback</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal" id="modal-prescription">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">


                        <h4 class="modal-title">Your Prescription</h4>
                        <button id="btnSave" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                        <button data-dismiss="modal" class="btn btn-danger">Close</button>
                    </div>
                    <div class="modal-body">

                    {{--<div id="box" style="background: white" class="container">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-md-6 pull-left">--}}
                    {{--<b><h4 style="color:#35773B">Dr. Raihan Rabbani</h4></b>--}}
                    {{--<b style="color: #34298A">MBBS, FCPS, US Board Certified in Internal--}}
                    {{--Medicine</b><br>--}}
                    {{--<b style="color: #34298A">Consultant, Internal Medicine</b> <br>--}}
                    {{--<b style="color: #35773B">Email: doc1@email.com</b>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-6 text-right">--}}
                    {{--<b><h4 style="color:#35773B">ডাঃ রাইহান রাব্বানি</h4></b>--}}
                    {{--<b style="color: #34298A">এমবিবিএস, এফসিপিএস, ইউএস বোরড সারটিফাইড ইন ইন্তারনাল--}}
                    {{--মেডিসিন</b><br>--}}
                    {{--<b style="color: #34298A">কন্সাল্টেন্ট, ইন্তারনাল মেডীসিন</b> <br>--}}
                    {{--<b style="color: #35773B">Email: doc1@email.com</b>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div id="statusTop" class="row">--}}

                    {{--<div class="col-md-2">--}}
                    {{--<b>PDI-1232</b>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<b>Name: Prappo Islam Prince</b>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<b>SEX: M</b>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                    {{--<b>Age: 50</b>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                    {{--<b>Date: 02-04-2018</b>--}}
                    {{--</div>--}}

                    {{--</div>--}}


                    {{--<div class="row">--}}
                    {{--<div id="" class="col-md-4">--}}
                    {{--<h4><b style="color:#34298A">Chief Complaints :</b><br></h4>--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<b>#38 Wks</b><br>--}}
                    {{--<b>#Weakness</b><br>--}}
                    {{--<b>#Joint pain</b>--}}
                    {{--</div>--}}

                    {{--<h4><b style="color:#34298A">General Examinations</b><br></h4>--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<b>Pulse: 75</b><br>--}}
                    {{--<b>B/P: 120/80</b><br>--}}

                    {{--</div>--}}

                    {{--<h4><b style="color:#34298A">Advice for investigations</b><br></h4>--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<b>USG of whole Abdomen</b><br>--}}

                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div id="rightDev" class="col-md-8">--}}
                    {{--<div style="padding:10px" class="row">--}}
                    {{--<img height="50" width="50" src="{{url('/images/optimus/rx.png')}}">--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>--}}
                    {{--<b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>--}}
                    {{--<b>Tab. Zeefol -- ১-০-১ ------৩০ দিন</b><br>--}}


                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<br><br>--}}

                    {{--<div class="row">--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<h4><b style="color:blue">Advice:</b></h4>--}}
                    {{--<b>ভারি কাজ করবেন না </b><br>--}}


                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<br><br>--}}

                    {{--<div class="row">--}}
                    {{--<div class="text-left" style="padding-left: 10px" align="center">--}}
                    {{--<h4><b style="color:blue">Next visit date:</b></h4>--}}
                    {{--<b>12-4-2018</b><br>--}}


                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div id="statusBottom" class="row">--}}

                    {{--<div class="col-md-4 text-left">চেম্বার / বাসা ঃ ফেনী প্রাইভেট হাসপাতাল--}}
                    {{--এস এস কে রদ ( হলি ক্রিসেন্ট স্কুল সংলগ্ন ) , ফেনী<br>--}}
                    {{--রোগী দেখার সময় ঃ--}}
                    {{--সকাল ৯টা - দুপুর ২ টা , রাত ৮টা - রাত ১০টা--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 text-center">--}}

                    {{--</div>--}}
                    {{--<div class="col-md-4 text-right">চেম্বার/ বাসা ঃ চৌধুরি জেনেরাল হাসপাতাল--}}
                    {{--চৌমুখি পৌরসভা , নোয়াখালি--}}
                    {{--রগী দেখার সময় ঃ বিকাল ৪টা - রাত ৮টা--}}
                    {{--</div>--}}


                    {{--</div>--}}
                    {{--</div>--}}
                    <!-- lol section -->
                        <div id="pc">

                        </div>

                    </div>

                    <div class="modal-footer">


                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        @include('components.footer')
    </div>
@endsection

@section('css')
    <style>
        .modal-dialog {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            height: auto;
            min-height: 100%;
            border-radius: 0;
        }

        #statusTop {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }

        #rightDev {
            border-left: 2px solid black;
            min-height: 130px;
            padding: 20px;
        }

        #statusBottom {
            border-top: 2px solid black;
        }

        .container {
            border: 2px solid black;
        }


    </style>
@endsection


@section('js')
    <script src="{{url('/js')}}/html2canvas.js"></script>
    <script src="{{url('/js')}}/base64.js"></script>
    <script src="{{url('/js')}}/canvas2image.js"></script>
    <script>


        $(function () {
            $("#btnSave").click(function () {
                html2canvas($("#box"), {
                    onrendered: function (canvas) {
                        theCanvas = canvas;
                        document.body.appendChild(canvas);

                        var url = canvas.toDataURL();
                        $("<a>", {
                            href: url,
                            download: "prescription"
                        })
                            .on("click", function () {
                                $(this).remove()
                            })
                            .appendTo("body")[0].click()

                        // Convert and download as image
//                    Canvas2Image.saveAsPNG(canvas);
//                    $("#img-out").append(canvas);
                        // Clean up
                        //document.body.removeChild(canvas);
                    }
                });
            });
        });


    </script>
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
                        swal("Accepted !", doctorName + " Accepted your request and here is his skype id : '" + doctorContact + "' He is online and waiting for you. Please contact him as soon as possible")
                    } else if (data.msg == "done") {
                        $.ajax({
                            type: 'POST',
                            url: '{{url('/prescription/get')}}',
                            data: {
                                'pId': data.pId
                            },
                            success: function (data) {
                                $('#pc').html(data);
                            },
                            error: function (data) {
                                swal("Error", "Something went wrong", "warning");
                                console.log(data.responseText);

                            }

                        });
                        $('#docId').val(data.doctorId);
                        $('#patId').val(data.patientId);
                        $('#modal-feedback').modal();
//                        alert("Feed back form will appear");
                    }


                }
            });
        }

        $('#btnModalHide').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/user/feedback')}}',
                data: {
                    'doctorId': $('#docId').val(),
                    'patientId': $('#patId').val(),
                    'comment': $('#txtFeedback').val()

                },
                success: function (data) {
                    console.log(data.responseText);
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

            $('#modal-feedback').modal('hide');

            swal("Thanks !", "Your feedback will help us", "success");
        });

        $('#getP').click(function () {
            $('#modal-prescription').modal();
        });

        $('#category').on('change', function () {
            window.location.replace('{{url('/doctor/category')}}/' + $(this).val());
        })
    </script>
@endsection














