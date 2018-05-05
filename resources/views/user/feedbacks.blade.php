@extends('layouts.app')
@section('title','Feedback')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>

            <div class="content">
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{\App\User::where('id',$data->docId)->value('name')}}</td>
                            <td>{{\App\User::where('id',$data->userId)->value('name')}}</td>
                            <td> {{\Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}</td>
                            <td>{{$data->comment}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Comment</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>

        @include('components.footer')
    </div>
@endsection


















