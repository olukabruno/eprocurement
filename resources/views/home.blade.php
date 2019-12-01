@extends('layouts.app')
@section('content')
<div class="container-fluid">
	@if(\Session::has('error'))
	<div class="alert alert-danger">
	{{\Session::get('error')}}
</div>
@endif
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b class="panel-title">Welcome {{Auth::user()->wholename}}!</b>
			</div>
		</div>
	</div>
</div>
</div>
@endsection