@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <!-- Your main wrapper -->
  <div class="panel panel-default">
    <div class="panel-title">
        <ul class="nav nav-tabs">
            <li @if(\Route::current()->getName() == 'rbd') class="active" @endif>
                <a href="{{ route('rbd') }}"  aria-expanded="false" aria-haspopup="true" v-pre>Requestor by Department</a>
            </li>
            <li @if(\Route::current()->getName() == 'aa') class="active" @endif>
                <a href="{{ route('aa') }}" aria-expanded="false" aria-haspopup="true" v-pre>Appropriation Available</a>
            </li>
            <li @if(\Route::current()->getName() == 'cash') class="active" @endif>
                <a href="{{ route('cash') }}"  aria-expanded="false" aria-haspopup="true" v-pre>Cash Availability</a>
            </li>
            <li @if(\Route::current()->getName() == 'pra') class="active" @endif>
                <a href="{{ route('pra') }}"  aria-expanded="false" aria-haspopup="true" v-pre>PR Approval</a>
            </li>
        </ul>
    </div>
    <div class="tab-content panel-body">
      <div class="panel-group">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
            <!-- registration form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Signatory</h3>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ url('/registersignatory') }}">
                {{ csrf_field() }}
                    <!-- hidden inputs -->
                    <input type="hidden" id="hidden-val" name="hidden-val" value="{{ $hidden_val }}">
                    <input type="hidden" name="status" value='0'>
                        <!-- department -->
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label" >Department</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <select id="department" type="text" class="form-control" name="department" required autofocus>
                                    <option>Choose Department</option>
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
                        <!-- name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label">Name</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- position -->
                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label">Position</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autofocus>
                                @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-sm-offset-3"><button type="submit" class="btn btn-primary">Register</button></div>
                        </div>
                    </form>
                    </div>
            </div><!--panel-->
            </div><!-- col -->

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                <!-- table -->
                @include('signatory.signatories-table')
            </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
         ajax: {
            url: @if (\Route::current()->getName() == 'aa') "{{ route('data.aa') }}" @elseif (\Route::current()->getName() == 'cash')"{{ route('data.c') }}" @elseif (\Route::current()->getName() == 'pra') "{{ route('data.a') }}" @else "{{ route('data.r') }}" @endif,
        },

        columns: [
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {data: 'dept', name: 'dept'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection