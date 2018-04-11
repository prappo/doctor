@extends('layouts.app')
@section('title','Messenger Bot')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="fb-bot"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Facebook Messenger Bot <i class="fa fa-comment"></i> </h3>
                                <p>Build logic for your page to reply automatically</p>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="question">If Sender Say ...</label>
                                    <input type="text" class="form-control" id="question"
                                           placeholder="Your visitors message to your page">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Then Reply ..</label>
                                    <input type="text" class="form-control" id="answer" placeholder="Your reply ..">
                                </div>
                                <div class="form-group">
                                    <label for="answer">For this page</label>
                                    <select class="form-control" id="pages">
                                        @foreach(\App\FacebookPages::where('userId',Auth::user()->id)->get() as $fbpage)
                                        <option value="{{$fbpage->pageId}}">{{$fbpage->pageName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="addData" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add reply
                                </button>
                            </div>

                        </div>
                        <!-- /.box -->

                        {{--table start form here--}}




                    </div>
                    <div class="col-md-6" align="center">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">FB Bot Config</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="matchAcc">Message matching accuracy %</label>
                                    <input type="text" value="{{\App\Http\Controllers\Data::get('matchAcc')}}"
                                           class="form-control" id="matchAcc" placeholder="Recommend : 75">
                                </div>
                                <div class="form-group">
                                    <label for="exMsg">Exception reply</label>
                                    <input type="text" class="form-control"
                                           value="{{\App\Http\Controllers\Data::get('exMsg')}}" id="exMsg"
                                           placeholder="Type reply message if doesn't match">
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="saveConfig" class="btn btn-success btn-block"><i class="fa fa-save"></i> Save</button>
                                <br><br>
                                <h3><a href="{{url('/extend')}}">Integrate Facebook Messenger Bot into Your Website</a></h3>
                            </div>

                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Available questions and answers</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>

                                <th>Question</th>
                                <th>Answer</th>
                                <th>For</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d->question}}</td>
                                    <td>{{$d->answer}}</td>
                                    <td>{{\App\Http\Controllers\Data::getPageName($d->pageId)}}</td>
                                    <td><a class="chatbotdel" data-id="{{$d->id}}" href="#"><span
                                                    class="badge bg-red"><i
                                                        class="fa fa-times"></i> Delete</span></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->

                </div>
                </div>
            </div>
            </section>
        </div>
    </div>
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
@section('js')
<script>
    $('#saveConfig').click(function () {
        $.ajax({
            type:'POST',
            url:'{{url('/save/fb/bot/config')}}',
            data:{
                'matchAcc':$('#matchAcc').val(),
                'exMsg':$('#exMsg').val()
            },
            success:function (data) {
                if(data=='success'){
                    alert("Settings updated");
                    location.reload();
                }
                else{
                    alert(data);
                    console.log(data);
                }
            },
            error:function(data){
                alert("Something went wrong, Please check the console message");
                console.log(data.responseText);
            }
        })
    });
    $('.chatbotdel').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
           type:'POST',
            url:'{{url('/fb/delquestion')}}',
            data:{
                'id':id
            },
            success:function (data) {
                if(data=="success"){
                    swal('Success',"Deleted !",'success');
                    location.reload();
                }else {
                    swal("Error",data,'error');
                }
            },
            error:function (data) {
                swal('Error',data,'error');
            }
        });
    })
</script>
@endsection

