@extends('layouts.app')
@section('content')

<div class="container-fluid">
<div class="panel panel-default">
  <div class="panel-heading">Supplemental Purchase Request Form</div>
  <div class="panel-body">
  <div class="row">
    <div class="col-md-5 col-lg-5">
        <div class="panel panel panel-default">
          <div class="panel-heading">View Available PR</div>
          <div class="panel-body">
            {!! $dt2->html()->table(['id' => 'dt2','class' => 'table table-condensed table-bordered table-hover'],false) !!}
          </div>
        </div>
    </div>

    <div class="col-md-7 col-lg-7">
    {!! $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false) !!}
    </div>
  


  </div>
  </div>
</div>
</div>

@endsection

@section('script')

{!! $dt1->html()->scripts() !!}
{!! $dt2->html()->scripts() !!}

@endsection





