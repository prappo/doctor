@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{trans('dashboard.Dashboard')}}</h1>
            </section>

            @if($users)

                @foreach($users as $user)

                    @if($user->isOnline())
                        <li>{{$user->name}}</li>
                    @endif

                @endforeach
            @endif

        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')

@endsection