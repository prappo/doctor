@extends('layouts.app')
@section('title','Profile')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">

            </section>
            <div style="padding:30px">
                <table>
                    <tr>
                        <td><h3><b>Name: </b></h3></td>
                        <td><h3>{{Auth::user()->name}}</h3></td>
                    </tr>
                    <tr>
                        <td><h3><b>Email: </b></h3></td>
                        <td><h3>{{Auth::user()->email}}</h3></td>
                    </tr>
                    <tr>
                        <td><h3><b>Skype ID: </b></h3></td>
                        <td><h3>{{Auth::user()->skype}}</h3></td>
                    </tr>

                    <tr>
                        <td><h3><b>Bio: </b></h3></td>
                        <td><h3>{{Auth::user()->bio}}</h3></td>
                    </tr>
                </table>
            </div>

        </div>

        @include('components.footer')
    </div>
@endsection


















