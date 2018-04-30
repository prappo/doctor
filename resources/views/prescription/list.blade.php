@extends('layouts.app')
@section('title','Prescription')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <div style="padding:10px" class="row">
                <div class="col-md-12">
                    <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Doctor Name</th>
                            <th>Patient Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td><b>{{\Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}</b> ({{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}})</td>
                                <td><a>{{\App\User::where('id',$data->to)->value('name')}}</a></td>
                                <td>{{\App\User::where('id',$data->from)->value('name')}}</td>
                                <td><a target="_blank" class="btn btn-success"
                                       href="{{url('/user/prescription')}}/{{$data->pId}}"><i
                                                class="fa fa-download"></i> Download Prescription </a></td>
                            </tr>
                        @endforeach

                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Doctor Name</th>
                            <th>Patient Name</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>


        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')

@endsection

















