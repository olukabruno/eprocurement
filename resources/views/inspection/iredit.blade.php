@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">Edit Inspection Report</b></div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{route('ir.update', $ir->id)}}" method="POST">
            {{ csrf_field() }}
            {{method_field('put')}}
            <input type="hidden" name="date" value="{{$ir->po_date}}">
            <input type="hidden" name="pr_number" value="{{$ir->pr_number}}">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group {{ $errors->has('supplier') ? ' has-error' : '' }}">
                    <label for="supplier" class="col-md-5 control-label">Supplier</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="supplier" value="{{ old('supplier', $ir->supplier) }}" readonly="" required="">
                        @if ($errors->has('supplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group {{ $errors->has('po_no') ? ' has-error' : '' }}">
                    <label for="po_no" class="col-md-5 control-label">PO Number</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="po_no" value="{{ old('po_no', $ir->po_no) }}" readonly="" required="">
                        @if ($errors->has('po_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('po_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>               
              <div class="col-md-12">
                <div class="form-group {{ $errors->has('requisitioning_office') ? ' has-error' : '' }}">
                    <label for="requisitioning_office" class="col-md-5 control-label">Requisitioning Office</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="requisitioning_office" value="{{ old('requisitioning_office', $ir->requisitioning_office) }}" required="">
                        @if ($errors->has('requisitioning_office'))
                            <span class="help-block">
                                <strong>{{ $errors->first('requisitioning_office') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group {{ $errors->has('invoice_no') ? ' has-error' : '' }}">
                    <label for="invoice_no" class="col-md-5 control-label">Invoice Number</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="invoice_no" value="{{ old('invoice_no', $ir->invoice_no) }}" required="">
                        @if ($errors->has('invoice_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invoice_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                                <div class="form-group {{ $errors->has('property_officer') ? ' has-error' : '' }}">
                    <label for="property_officer" class="col-md-5 control-label">Property Officer</label>
                    <div class="col-md-7">
                        <input class="form-control" list="propertyOfficer" name="property_officer" required="" value="{{$ir->property_officer}}">
                          <datalist id="propertyOfficer">
                            <option>Alexander G. Flores</option>
                          </datalist>
                        @if ($errors->has('property_officer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('property_officer') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group {{ $errors->has('inspection_officer') ? ' has-error' : '' }}">
                    <label for="inspection_officer" class="col-md-5 control-label">Inspection Officer</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="inspection_officer" value="{{$ir->inspection_officer}}" required="">
                        @if ($errors->has('inspection_officer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('inspection_officer') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group text-center">
                  <button class="btn btn-warning" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Inspection Report</b></div>
        <div class="panel-body">
             {!! $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false) !!}
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

{!! $dt1->html()->scripts() !!}

@endsection





