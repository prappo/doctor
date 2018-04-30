@extends('layouts.app')
@section('title','Add User')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>


            @foreach($datas as $data)
                <div id="box" style="background: white" class="container">
                    <div class="row">
                        <div class="col-md-6 pull-left">
                            <b>
                                <h4 style="color:#35773B">{{\App\User::where('id',$data->to)->value('name')}}</h4>
                            </b>
                            <b style="color: #34298A">{{\App\User::where('id',$data->to)->value('bio')}}</b><br>
                            <b style="color: #34298A">{{\App\User::where('id',$data->to)->value('bio_a')}}</b> <br>
                            <b style="color: #35773B">Email: {{\App\User::where('id',$data->to)->value('email')}}</b>
                        </div>

                        <div class="col-md-6 text-right">
                            <b><h4 style="color:#35773B">{{\App\User::where('id',$data->to)->value('name_bangla')}}</h4></b>
                            <b style="color: #34298A">{{\App\User::where('id',$data->to)->value('bio_bangla')}}</b><br>
                            <b style="color: #34298A">{{\App\User::where('id',$data->to)->value('bio_a_bangla')}}</b> <br>
                            <b style="color: #35773B">Email: {{\App\User::where('id',$data->to)->value('email')}}</b>
                        </div>
                    </div>
                    <div id="statusTop" class="row">

                        <div class="col-md-2">
                            <b>PDI-{{$data->pId}}</b>
                        </div>
                        <div class="col-md-3">
                            <b>Name: {{\App\User::where('id',$data->from)->value('name')}}</b>
                        </div>
                        <div class="col-md-3">
                            <b>SEX: {{$data->sex}}</b>
                        </div>
                        <div class="col-md-2">
                            <b>Age: {{$data->age}}</b>
                        </div>
                        <div class="col-md-2">
                            <b>Date: {{\Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}</b>
                        </div>

                    </div>
                    <div class="row">
                        <div id="" class="col-md-4">
                            <h4><b style="color:#34298A">Chief Complaints :</b><br></h4>
                            <div class="text-left" style="padding-left: 10px" align="center">
                                {{--<b>#38 Wks</b><br>--}}
                                {{--<b>#Weakness</b><br>--}}
                                {{--<b>#Joint pain</b>--}}
                                {!! $data->chief_complaints !!}
                            </div>

                            <h4><b style="color:#34298A">General Examinations</b><br></h4>
                            <div class="text-left" style="padding-left: 10px" align="center">
                                {{--<b>Pulse: 75</b><br>--}}
                                {{--<b>B/P: 120/80</b><br>--}}

                                {!! $data->general_examinations !!}


                            </div>

                            <h4><b style="color:#34298A">Advice for investigations</b><br></h4>
                            <div class="text-left" style="padding-left: 10px" align="center">
                                {!! $data->advice_for_investigations !!}

                            </div>
                        </div>

                        <div id="rightDev" class="col-md-8">
                            <div style="padding:10px" class="row">
                                <img height="50" width="50" src="{{url('/images/optimus/rx.png')}}">
                            </div>
                            <div class="row">
                                <div class="text-left" style="padding-left: 10px" align="center">
                                    {!! $data->rx !!}

                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="text-left" style="padding-left: 10px" align="center">
                                    <h4><b style="color:blue">Advice:</b></h4>
                                    {!! $data->advice !!}


                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="text-left" style="padding-left: 10px" align="center">
                                    <h4><b style="color:blue">Next visit date:</b></h4>
                                    <b>{{$data->next_visit_date}}</b><br>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="statusBottom" class="row">

                        <div class="col-md-4 text-left">{!! \App\Http\Controllers\SettingsController::getP_left() !!}
                        </div>
                        <div class="col-md-4 text-center">

                        </div>
                        <div class="col-md-4 text-right">{!! \App\Http\Controllers\SettingsController::getP_right() !!}
                        </div>

                    </div>

                </div>

            @endforeach
            <div style="padding:35px" class="row">

                <button id="btnSave" class="btn btn-success"><i class="fa fa-download"></i> Download Prescription
                </button>
            </div>

        </div>

        @include('components.footer')
    </div>
@endsection
@section('css')
    <style>


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
                            .appendTo("body")[0].click();

                        // Convert and download as image
//                    Canvas2Image.saveAsPNG(canvas);
//                    $("#img-out").append(canvas);
                        // Clean up
                        document.body.removeChild(canvas);
                    }
                });
            });
        });


    </script>

@endsection



















