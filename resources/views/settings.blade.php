@extends('layouts.app')
@section('title','Settings')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                {{-- Select theme--}}


                <div class="row">
                    {{--Facebook settings--}}

                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-gears"></i> Settings</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="fbAppId">App ID</label>
                                    <input class="form-control" value="{{ $fbAppId }}" id="fbAppId"
                                           placeholder="Your facebook app id"
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <label for=fbAppSec">App Secret</label>
                                    <input class="form-control" value="{{ $fbAppSec }}" id="fbAppSec"
                                           placeholder="Your facebook app secret" type="text">
                                </div>


                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                @if($fbAppId != "")
                                    <a href="{{ $loginUrl }}" class="btn btn-facebook"><i
                                                class="fa fa-facebook-square"></i> Connect with facebook</a>
                                @endif
                                <button id="fbSettingSave" class="btn btn-success"><i class="fa fa-save"></i> Save
                                </button>
                            </div>

                        </div>
                    </div>


                </div>

            </section>
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>


    </script>
@endsection
@section('css')

@endsection

