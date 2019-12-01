@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">View All Available PR</b></div>
        <div class="panel-body">
          {!! $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false) !!}
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Request for Quotation</b></div>
        <div class="panel-body">
          {!! $dt2->html()->table(['id' => 'dt2','class' => 'table table-condensed table-bordered table-hover'],false) !!}
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
