@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- registration form -->
        <div class="col-xs-5 col-md-5">
            
            <div class="panel panel-default">
                <div class="panel-heading">Distributor Details</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('soledistreg') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name/Company</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('certificate') ? ' has-error' : '' }}">
                            <label for="certificate" class="col-md-4 control-label">Certificate of Sole Distributor</label>

                            <div class="col-md-6">
                                <input id="certificate" type="file" class="form-control" name="certificate"  accept="application/pdf" required autofocus>

                                @if ($errors->has('certificate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('certificate') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>

        <!--table-->
        <div class="container-fluid col-xs-7 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Distributors</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                                @forelse($records as $key=>$record)
                                <tr>
                                    <td class="col-xs-3">{{$record->name}}</td>
                                    <td class="col-xs-3">{{$record->address}}</td>
                                    <td class="col-xs-1">
                                       
                                        <a class="btn btn-info btn-xs" href="{{ asset('storage/'.$record->file_name) }}" target="_blank" title="View Certificate"><span class="glyphicon glyphicon-file"></span></a>
                                        <a class="btn btn-danger btn-xs" href="{{ URL::to('soledist/delete/'.$record->id) }}" title="Delete" onclick="return confirm('WARNING.'+'\n'+'Deleting sole distributor. Continue?');"><span class="glyphicon glyphicon-minus"></span></a>
                                    </td>
                                       
                                    </td> 
                                </tr>
                             
                                @empty
                                 <tr >
                                    <td colspan="2">
                                    NO RESULTS FOUND
                                    <td>
                                 </tr>
                                @endforelse
                                 

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end table -->

    </div>
</div>


@endsection
