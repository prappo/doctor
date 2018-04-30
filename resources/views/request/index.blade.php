@extends('layouts.app')
@section('title','All Requests')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Doctor Name</th>
                                <th>Patient Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach(\App\Call::all() as $data)
                                <tr>
                                    <td><b>{{\Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}</b> ({{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}})</td>
                                    <td><a>{{\App\User::where('id',$data->to)->value('name')}}</a></td>
                                    <td>{{\App\User::where('id',$data->from)->value('name')}}</td>
                                    <td>{{$data->status}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                            <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Doctor Name</th>
                                <th>Patient Name</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        @include('components.footer')
    </div>
@endsection


















