@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">FORGOT YOUR PASSWORD?</div>
                <div class="panel-body">
                    Please contact your administrator <br><br>
                    <strong>IT SECTION</strong><br>
                    Office of the City Administrator<br>
                    687-8100 loc. (139)<br><br>
                    <a class="btn btn-default" href="{{ route('home') }}">Back to login page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection