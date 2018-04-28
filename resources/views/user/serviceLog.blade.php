@extends('layouts.app')
@section('title','Service Log')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>

            <div class="col-md-12">
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{\App\User::where('id',$d->from)->value('name')}}</td>
                            <td>{{\Carbon\Carbon::parse($d->created_at)->format('Y-m-d')}}</td>
                            <td>{{$d->status}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                </table>
            </div>


        </div>
    </div>

        @include('components.footer')

@endsection

















