@extends('layouts.auth')
@section('title', 'Login')
@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><img src="{{ url('images/optimus/logo-login.png') }}" alt="Optimus"><b>Optimus</b></a>
        </div>

        <div class="login-box-body">

            <form role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-group has-feedback">
                        <input type="email" placeholder="Your email" class="form-control" name="email"
                               value="{{ old('email') }}" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row" align="center" style="padding-left:15px;padding-right: 15px">


                    <button type="submit" class="btn btn-block btn-success btn-block btn-flat">Sign In</button>
                    <br>
                    Or<br>
                    <a href="{{ url('/register') }}" class="">Register</a>

                </div>
            </form>
        </div>
    </div>
@endsection
