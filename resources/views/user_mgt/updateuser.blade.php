@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- registration form -->
        <div class="col-xs-5 col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Edit Usser</h3></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/edit_user',$edit_form->id) }}">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}


                        <div class="form-group{{ $errors->has('wholename') ? ' has-error' : '' }}">
                            <label for="wholename" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="wholename" type="text" class="form-control" name="wholename" value="{{ $edit_form->wholename }}" required autofocus>

                                @if ($errors->has('wholename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wholename') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label for="contact" class="col-md-4 control-label">Contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ $edit_form->contactno }}" required autofocus>

                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label" >Department</label>

                            <div class="col-md-6">
                                
                                <select name="department" value="{{ old('department') }}" onchange="showDiv(this)" class="form-control" required autofocus>

                                    @foreach ($dept as $key=>$dept)
                                        <option value='{{$dept->iso_code}}'

                                            @if($edit_form->department == $dept->iso_code)
                                                selected
                                            @endif

                                        >{{$dept->office_name}}</option>
                                    @endforeach
                                    
                                </select>

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $edit_form->name }}" readonly>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" disabled>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('userlvl') ? ' has-error' : '' }}">
                            <label for="userlvl" class="col-md-4 control-label">User Level</label>

                            <div class="col-md-6">
                                <select id="userlvl" type="text" class="form-control" name="userlvl" autofocus>
                                    <option value="0">User</option>
                                    <script type="text/javascript">

                                        function showDiv(elem){

                                           if(elem.value != "ICT"){
                                              document.getElementById('admin').style.display = 'none';
                                           }else{
                                              document.getElementById('admin').style.display = 'block';
                                           }
                                        }
                                    </script>
                                    <option id="admin" style="display:none;" value = "1" @if($edit_form->role == '1') selected @endif>Admin</option>
                                    
                                    
                                </select>

                                @if ($errors->has('userlvl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userlvl') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @if($edit_form->isBACSec == 1) 

                            <div class="checkbox col-md-5 col-md-offset-6">
                              <label><input name="bacs" id="bacs" type="checkbox" value="1" checked>Is BAC Secretariat?</label>
                            </div>
                        
                            @elseif($result->isEmpty())
                            <div class="checkbox col-md-5 col-md-offset-5">
                              <label><input name="bacs" id="bacs" type="checkbox" value="1">Assign as BAC Secretariat</label>
                            </div>
                        
                            @endif
                        </div>                    

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Update
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
