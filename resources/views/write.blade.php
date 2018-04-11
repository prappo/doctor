@extends('layouts.app')
@section('title','Write')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i style="color:#4A67AD" class="fa fa-facebook-square"></i> Write post
                            Facebook post</h3>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="box-body">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="r" id="imagetype" value="imagetype">
                                                <i class="fa fa-image"></i> <kbd><b>Image Post</b></kbd>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="r" id="sharetype" value="sharetype">
                                                <i class="fa fa-link"></i> <kbd><b>Link Post</b></kbd>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="r" id="texttype" value="texttype"
                                                       checked="checked">
                                                <i class="fa fa-font"></i> <kbd><b>Text Only</b></kbd>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div data-step="8"
                                     data-intro="Write whatever you want to post. You can use emoji by simply clicking emoji button on top right or pressing tab key"
                                     class="form-group">
                                    <input type="hidden" id="postId">
                                    <textarea class="form-control" rows="4"
                                              id="status"
                                              placeholder="Type your content here"></textarea>
                                </div>


                                {{--<div data-step="2"--}}
                                {{--data-intro="Title for your post, Title is not available for linkedin, twitter and skype"--}}
                                {{--class="form-group">--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-sm-12">--}}
                                {{--<input id="dataTitle" class="form-control"--}}
                                {{--placeholder="Title"--}}
                                {{--type="text">--}}
                                {{--</div>--}}

                                {{--</div>--}}
                                {{--</div>--}}

                                <div id="linkoption" data-step="4"
                                     data-intro="Link that you want to share, This is only available for facebook & linkedin"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input id="link" type="text" class="form-control"
                                                   placeholder="Link of content">
                                        </div>

                                    </div>
                                </div>
                                <div id="imgoption" data-step="5"
                                     data-intro="Select your image file that you want to post. Image posting is not available for wordpress and skype"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="uploadimage" method="post" enctype="multipart/form-data">
                                                <label>Select Your Image</label><br/>
                                                <input class="" type="file" name="file"
                                                       id="file"/><br>
                                                <input class="btn btn-xs btn-success" type="submit" value="Upload"
                                                       id="imgUploadBtn"/>
                                                <input value="" type="hidden" id="image">
                                                <div id="imgMsg"></div>
                                            </form>
                                        </div>

                                    </div>
                                </div>



                            </div>


                            <div data-step="9" data-intro="Options available according to your settings"
                                 style="padding-left: 10px" class="form-group">
                                <div class="btn-group btn-group-xs" data-toggle="buttons">
                                    @if(\App\Http\Controllers\Data::myPackage('fb'))
                                        @if(!empty(\App\Http\Controllers\Data::get('fbAppId')))
                                            <label class="btn btn-primary bg-blue">
                                                <input id="fbCheck" type="checkbox" autocomplete="off"><i
                                                        class="fa fa-facebook"></i>
                                                Facebook page
                                            </label>

                                            <label class="btn btn-primary bg-blue">
                                                <input id="fbgCheck" type="checkbox" autocomplete="off"><i
                                                        class="fa fa-users"></i>
                                                Facebook group
                                            </label>
                                        @endif
                                    @endif


                                </div>

                            </div>


                            <div class="form-group" style="padding-left:10px">


                                <div id="fbPages" style="display: none;" class="form-group">
                                    <fieldset class="scheduler-border">
                                        Select your page{{ count($fbPages) > 1 ? 's' : null }} list

                                        <select id="fbPages">
                                            @foreach($fbPages as $fb)
                                                <option id="{{$fb->pageId}}"
                                                        value="{{$fb->pageToken}}">{{$fb->pageName}}</option>
                                            @endforeach
                                        </select>


                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left:10px">
                                <div id="fbGroupsSection" style="display: none">
                                    <fieldset class="scheduler-border">
                                        Your facebook group{{ count($fbGroups) > 1 ? 's' : null }} list

                                        <select id="fbgroups">
                                            @foreach($fbGroups as $fbg)
                                                <option value="{{$fbg->pageId}}">{{$fbg->pageName}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left:10px">
                                <div class="row">
                                    <div class="col-md-10">
                                        <button data-step="10" data-intro="Hit me to give me permission for posting"
                                                id="write"
                                                class="btn btn-block" style="background-color: #4A67AD;color: white"><i
                                                    class="fa fa-edit"></i>
                                            Post to Facebook
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <button data-step="11" data-intro="Click here to schedule your post"
                                                id="addschedule"
                                                class="btn btn-success"><i class="fa fa-calendar"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="loading" style="display: none;" class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>


                            {{--scheduling start--}}


                            {{--scheduling end--}}


                        </div>
                        <div class="col-md-6">

                            <div id="ss" style="display: none;" class="form-group">
                                <div style="padding: 10px">
                                    <img src="{{url('/images/optimus/click_here.png')}}">
                                    <button id="sclose" class="btn btn-danger pull-right btn-xs"><i
                                                class="fa fa-times"></i> Close
                                    </button>
                                    <input type="text" id="time">
                                </div>
                                <br>
                                <div style="padding:10px;" class="form-group">
                                    <button id="saveschedule" class="btn btn-info btn-block"><i class="fa fa-plus"></i>
                                        Add to Schedule
                                    </button>
                                    <br>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="fbMsgSu" style="display:none;" class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                Successfully posted to Facebook
                            </div>

                            <div id="fbMsgEr" style="display: none;" class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <div id="fbMsgErConsole"> Sorry Something went wrong </div>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        </div>

        @include('components.footer')
    </div>

    {{-- Content creator start --}}

    <div class="modal fade modal-fullscreen" id="creatorModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Content creator</h4>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <canvas height="600" width="500" id="c"></canvas>
                            </div>

                            <div class="col-md-6">
                                {{-- canvas properties --}}

                                <div class="row" style="margin-right:10px">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Tools</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <form role="form">
                                            <div class="box-body">


                                                {{-- here --}}


                                                <div class="panel-group" id="accordion" role="tablist"
                                                     aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseOne"
                                                                   aria-expanded="true" aria-controls="collapseOne">
                                                                    <i class="fa fa-file-o"></i> Background
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse in"
                                                             role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="panel-body">
                                                                <label for="cColor">Background Color</label>
                                                                <input type="color" id="cColor">
                                                                <button type="button" id="btnCColorChange"
                                                                        class="btn btn-primary btn-xs">Change
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseTwo"
                                                                   aria-expanded="false" aria-controls="collapseTwo">
                                                                    <i class="fa fa-paint-brush"></i> Draw
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="panel-collapse collapse"
                                                             role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                <label><input type="checkbox" id="enableDrawing">
                                                                    Enable</label>
                                                                <input type="color" id="drawingColor">
                                                                <input type="text" value="10" id="drawingSize">
                                                                <input type="button" class="btn btn-primary btn-xs"
                                                                       value="Done" id="drawingChange">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseThree"
                                                                   aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="fa fa-image"></i> Add Image
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThree" class="panel-collapse collapse"
                                                             role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                <input class="form-control" type="file" id="imageLoader"
                                                                       name="imageLoader"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseFour"
                                                                   aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="fa fa-font"></i> Add Text
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseFour" class="panel-collapse collapse"
                                                             role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                Text <input type="text" value="Hellow world" id="cText"><br>
                                                                Select color <input type="color" id="cTextColor"><br>
                                                                Size <input type="text" id="cTextSize" value="30"><br>
                                                                <input type="button" id="cTextAdd" value="Add text"
                                                                       class="btn btn-primary btn-xs">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseFive"
                                                                   aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="fa fa-stop"></i> Add Rectangle
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseFive" class="panel-collapse collapse"
                                                             role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                Select Color <input type="color" id="rectColor"><br>
                                                                <input type="button" id="makeRect" value="Create"
                                                                       class="btn btn-xs btn-primary">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                   data-toggle="collapse"
                                                                   data-parent="#accordion" href="#collapseSix"
                                                                   aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="fa fa-circle-o"></i> Add Circle
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseSix" class="panel-collapse collapse"
                                                             role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                Select Color <input type="color" id="circleColor"><br>
                                                                <input type="button" id="makeCircle" value="Create"
                                                                       class="btn btn-xs btn-primary">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <input type="button" class="btn btn-danger btn-xs"
                                                       value="Delete selected Object" id="delete">

                                            </div>
                                            <!-- /.box-body -->


                                        </form>
                                    </div>

                                </div>


                                <div class="row">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="imageSaver" class="btn btn-primary">Download Image
                                    </button>
                                    <button type="button" id="createContent" class="btn btn-success">Create</button>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Content creator end--}}
    <div class="modal fade modal-fullscreen" id="contentListModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Created content list</h4>
                    <div class="modal-body">
                        <div id="contentList">

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Content list start--}}



    {{-- Content List end--}}
@endsection
@section('css')

    {{--<style>--}}
    {{--fieldset.scheduler-border {--}}
    {{--border: 1px groove #ddd !important;--}}
    {{--padding: 0 1.4em 1.4em 1.4em !important;--}}
    {{--margin: 0 0 1.5em 0 !important;--}}
    {{---webkit-box-shadow: 0px 0px 0px 0px #000;--}}
    {{--box-shadow: 0px 0px 0px 0px #000;--}}
    {{--}--}}


    {{--legend.scheduler-border {--}}
    {{--font-size: 1.2em !important;--}}
    {{--font-weight: bold !important;--}}
    {{--text-align: left !important;--}}
    {{--width: auto;--}}
    {{--padding: 0 10px;--}}
    {{--border-bottom: none;--}}
    {{--}--}}

    {{--</style>--}}
    <style>

        /* .modal-fullscreen */
        .modal-fullscreen {

        }

        .modal-fullscreen .modal-content {

            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .modal-fullscreen .modal-dialog {
            margin: 0;
            margin-right: auto;
            margin-left: auto;
            width: 100%;
        }

        @media (min-width: 768px) {
            .modal-fullscreen .modal-dialog {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .modal-fullscreen .modal-dialog {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .modal-fullscreen .modal-dialog {
                width: 1170px;
            }
        }
    </style>
@endsection
@section('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.16/fabric.min.js"></script>
    <script>
        $(document).ready(function () {
//            content creator start
//==========================================


            var canvas = new fabric.Canvas('c', {
                backgroundColor: 'rgb(240,240,240)'
            });

//            change background color

            $('#btnCColorChange').click(function () {
                canvas.backgroundColor = $('#cColor').val();
                canvas.renderAll();
            });
//            Delete selected object


            function deleteObjects() {
                var activeObject = canvas.getActiveObject(),
                    activeGroup = canvas.getActiveGroup();
                if (activeObject) {
                    if (confirm('Are you sure?')) {
                        canvas.remove(activeObject);
                    }
                }
                else if (activeGroup) {
                    if (confirm('Are you sure?')) {
                        var objectsInGroup = activeGroup.getObjects();
                        canvas.discardActiveGroup();
                        objectsInGroup.forEach(function (object) {
                            canvas.remove(object);
                        });
                    }
                }
            }

            $("#delete").click(function () {
                canvas.isDrawingMode = false;
                deleteObjects();
            });

//            enable/disable drawing mode

            $("#enableDrawing").change(function () {
                if (this.checked) {
                    canvas.isDrawingMode = true;
                } else {
                    canvas.isDrawingMode = false;
                }
            });

//            change drawing properties
            $('#drawingChange').click(function () {
                canvas.freeDrawingBrush.color = $('#drawingColor').val();
                canvas.freeDrawingBrush.width = $('#drawingSize').val();
            });

            $('#cTextAdd').click(function () {
                var newText = new fabric.Text($('#cText').val(), {
                    fontSize: $('#cTextSize').val(),
                    fill: $('#cTextColor').val()

                });

                canvas.add(newText);


            });

            $('#makeRect').click(function () {
                var rect = new fabric.Rect({
                    left: 100,
                    top: 100,
                    fill: $('#rectColor').val(),
                    width: 50,
                    height: 50

                });
                canvas.add(rect);
            });

            $('#makeCircle').click(function () {
                var circle = new fabric.Circle({
                    radius: 20, fill: $('#circleColor').val(), left: 100, top: 100
                });
                canvas.add(circle);
            });


//            save image

            function download(url, name) {
// make the link. set the href and download. emulate dom click
                $('<a>').attr({href: url, download: name})[0].click();
            }

            function downloadFabric(name) {
//  convert the canvas to a data url and download it.
                download(canvas.toDataURL(), name + '.png');
            }

            $('#imageSaver').click(function () {
                downloadFabric("content");
            });


            var imageLoader = document.getElementById('imageLoader');
            imageLoader.addEventListener('change', handleImage, false);

            function handleImage(e) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var img = new Image();
                    img.onload = function () {
                        var imgInstance = new fabric.Image(img, {
                            scaleX: 0.2,
                            scaleY: 0.2
                        });
                        canvas.add(imgInstance);
                    }
                    img.src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }

            $('#createContent').click(function () {
                var dataURL = canvas.toDataURL();
                $.ajax({
                    type: 'POST',
                    url: "{{url('/content/upload')}}",
                    data: {
                        imageData: dataURL
                    },
                    success: function (data) {
                        if (data['status'] == "success") {
                            $('#imgPreview').attr('src', '{{url('/uploads')}}/' + data['fileName']);
                            $('#image').val(data['fileName']);
                            $('#imagetype').prop('checked', true);
                            $('#creatorModal').modal('toggle');
                        } else {
                            alert(data);
                        }

                    },
                    error: function (data) {
                        alert("Something went wrong, Please check the console message");
                        console.log(data.responseText);
                    }
                });
            });

            $('#btnContentList').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/content/list')}}',
                    data: {},
                    success: function (data) {
                        $('#contentList').html(data);
                    },
                    error: function (data) {
                        alert("Can't load Content list,Something went wrong, Please check console message");
                        console.log(data.responseText);
                    }
                });
            });


//========================================================================
//            Content creator end
            flatpickr("#time", {
                minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
//                maxDate: "2017-12-20",
                enableTime: true,

                // create an extra input solely for display purposes
                altInput: true,
                altFormat: "F j, Y h:i K",
                @if(Auth::user()->timeFormat == 12)
                time_24hr: false
                @else
                time_24hr: true
                @endif
            });

            $('#caption').hide(200);
            $('#imgoption').hide(200);
            $('#desOption').hide(200);
            $('#linkoption').hide(200);

            $('#texttype').click(function () {

                $('#caption').hide(200);
                $('#imgoption').hide(200);
                $('#desOption').hide(200);
                $('#linkoption').hide(200);
            })

            $('#imagetype').click(function () {
                $('#imgoption').show(200);

                $('#desOption').hide(200);
                $('#linkoption').hide(200);
                $('#caption').hide(200);
            });

            $('#sharetype').click(function () {

                $('#caption').show(200);

                $('#desOption').show(200);
                $('#linkoption').show(200);
            });

            $('#dataTitle').on('input', function (e) {
                if ($('#sharetype').is(':checked')) {
                    if ($('#dataTitle').val().length == 0) {
                        $('.name').html('<span class="defaultName"></span>');
                    }
                    else {
                        $('.name').text($('#dataTitle').val());
                    }
                }


            });


            $('#description').on('input', function (e) {
                if ($('#description').val().length == 0) {
                    $('.description').html('<span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span>');
                }
                else {
                    $('.description').html($('#description').val());
                }

            });


            $('#caption').on('input', function (e) {
                if ($('#caption').val().length == 0) {
                    $('.caption').html('<span class="defaultCaption"></span>');
                }
                else {
                    $('.caption').html($('#caption').val());
                }

            });

            var count = 0;
            setTimeout(
                function () {
                    if (count <= 3) {
                        $('.emojionearea-editor').bind("DOMSubtreeModified", function () {
                            if ($(this).text().length == 0) {
                                $('.message').html('<span class="defaultMessage"></span>');
                            }
                            else {
                                $('.message').html($(this).html());
                            }


                        });
                    }
                    count++;

                }, 1000);


        });

        //        content creator

        //        Upload image to canvas


    </script>
@endsection

