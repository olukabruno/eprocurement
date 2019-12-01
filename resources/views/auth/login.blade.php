@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              
                <div class="panel-heading">
                    <div class="text-center"><img src="{{asset('images/ubunifu.png')}}" alt="img"></div>
                    <div class="text-center"><h4>Procurement Management Systems</h4></div>
                </div>

                <div class="panel-body">

                    <form  method="POST" action="{{ route('login') }}">

                        {{ csrf_field() }}

                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 input-sm control-label">Username</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="input-sm form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 input-sm control-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="input-sm form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="col-md-6 checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12">


                                <a class="btn btn-link" href="{{ route('resetpword') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            &copy; 2019 Uganda Technology & Mgt University<br>
                            UTAMU<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
