@extends('layouts.app')
@section('title','Facebook Scraper')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">


                {{--table start--}}
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i
                                        class="fa fa-search"></i> Facebook Search
                                Feed</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i
                                        class="fa fa-database"></i> Collected Phone numbers & Emails
                            </a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="box no-border">
                                <div class="box-header">
                                    <div align="center" class="row">
                                        <div class="col-md-6">
                                            <input id="query" placeholder="Type here what you are looking for"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <select id="type" class="form-control">
                                                <option value="page">Page</option>
                                                <option value="place">Place</option>
                                                <option value="event">Event</option>
                                                <option value="group">Group</option>
                                                <option value="user">User</option>

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control" placeholder="Limit" value="10" type="text"
                                                   id="limit">
                                        </div>
                                        <div class="col-md-2">
                                            <button id="search" class="btn btn-success"><i class="fa fa-search"></i>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="scraper" class="box-body">
                                    {{-- table was here--}}
                                </div>
                                {{--End box--}}

                                {{--table end--}}


                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table id="mytable" class="table table-bordered table-striped" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Page Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Website</th>
                                    <th>Used keyword to search</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach(\App\PageScraper::where('userId',Auth::user()->id)->get() as $d)
                                    <tr>

                                        <td>{{$d->pageName}}</td>
                                        <td>{{$d->emails}}</td>
                                        <td>{{$d->phone}}</td>
                                        <td>{{$d->website}}</td>
                                        <td>{{$d->words}}</td>


                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Page Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Website</th>
                                    <th>Used keyword to search</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- /.tab-pane -->


                    </div>
                    <!-- /.tab-content -->
                </div>

            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>

        $('#search').click(function () {

            if ($('#query').val() == '') {
                return swal('Please enter keyword');
            }
            else {
                $('#scraper').html(
                    '<div align="center"><h3>Searching ......</h3><br><img src="{{url('/images/optimus/social/loader.gif')}}">'
                );
                $.ajax({
                    type: 'POST',
                    url: '{{url('/scraper')}}',
                    data: {
                        'data': $('#query').val(),
                        'type': $('#type').val(),
                        'limit': $('#limit').val(),
                    },
                    success: function (data) {
                        $('#scraper').html(data);
//                            console.log(data);
                        var table = $('#mytable').DataTable({

                            dom: '<""flB>tip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    text: '<button class="btn btn-success btn-xs fak"><i class="fa fa-file-excel-o"></i> Export all to excel</button>'
                                },
                                {
                                    extend: 'csv',
                                    text: '<button class="btn btn-warning btn-xs fak"><i class="fa fa-file-o"></i> Export all to csv</button>'
                                },
                                {
                                    extend: 'pdf',
                                    text: '<button class="btn btn-danger btn-xs fak"><i class="fa fa-file-pdf-o"></i> Print all in pdf</button>'
                                },
                                {
                                    extend: 'print',
                                    text: '<button class="btn btn-default btn-xs fak"><i class="fa fa-print"></i> Print all</button>'
                                },
                            ]
                        });
                    }
                });
            }
        });

    </script>
@endsection
@section('css')
    <script src="{{url('opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('opt/sweetalert.css')}}">

@endsection