@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- registration form -->
        <div class="col-xs-5 col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>

                <div class="panel-body">

                    <form class="form-horizontal px-3" method="POST" action="{{ url('/info') }}">

                        {{ csrf_field() }}

                          <div class="row">

                            <div class="col-md-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control mb-3" name="first_name" value="{{ old('first_name') }}" autofocus>
                            @if ($errors->has('first_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                            </div>

                            <div class="col-md-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control mb-3" name="last_name" value="{{ old('last_name') }}">
                            @if ($errors->has('last_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control mb-3" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            </div>

                            <div class="col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="email">Phone</label>
                            <input id="phone" type="text" class="form-control mb-3" name="phone" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                            <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                            </div>

                            <div class="col-md-6 {{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department">Department</label>
                            <select name="department" value="{{ old('department') }}" onchange="showDiv(this)" class="form-control mb-3" required autofocus>
                            @foreach ($dept as $key=>$dept)
                            <option value='{{$dept->iso_code}}'>{{$dept->office_name}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('department'))
                            <span class="help-block">
                            <strong>{{ $errors->first('department') }}</strong>
                            </span>
                            @endif
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control mb-3" name="username" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                            <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>
                            <input id="password" type="text" class="form-control mb-3" name="password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            </div>

                            <div class="col-md-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-password-confirmation">Password Comfirmation</label>
                                <input id="password_confirmation" type="password" class="form-control mb-3" name="password_confirmation" required>
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 {{ $errors->has('userlvl') ? ' has-error' : '' }}">
                              <label for="role">User Level</label>
                              <select id="role" type="text" class="form-control" name="role" required autofocus>
                              <option value="0">Select role</option>
                              @foreach ($role as $key=>$role)
                              <option value='{{ $role->id }}'>{{ $role->name }}</option>
                              @endforeach
                              </select>
                              @if ($errors->has('role'))
                              <span class="help-block">
                              <strong>{{ $errors->first('role') }}</strong>
                              </span>
                              @endif
                            </div>

                          </div>



                        <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>


        <!-- update edit edelete-->
        <div class="container-fluid col-xs-7 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Records </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-striped table-condensed table-bordered table-hover'],false) !!}
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<!-- view all records -->

@endsection


@section('script')

{!! $dataTable->scripts() !!}

@endsection
