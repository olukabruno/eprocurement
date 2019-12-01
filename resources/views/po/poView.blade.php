@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">View All Available PR</b></div>
        <div class="panel-body">
          {!! $dt2->html()->table(['id' => 'dt2','class' => 'table table-condensed table-bordered table-hover'],false) !!}
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Purchase Order</b></div>
        <div class="panel-body">
          {!! $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false) !!}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="poModal" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Purchase Order Form Details</b></div>
        </div>
        <div class="modal-body">
          <form id="submitPurchaseOrder" class="form-horizontal" method="POST" action="">
            {{ csrf_field() }}
            <div class="row">

              <div class="col-md-6">
                <div class="form-group {{ $errors->has('supplier') ? ' has-error' : '' }}">
                    <label for="supplier" class="col-md-5 control-label">Supplier</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="supplier" value="{{ old('supplier') }}" readonly="readonly">
                        @if ($errors->has('supplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('supplier_address') ? ' has-error' : '' }}">
                    <label for="supplier_address" class="col-md-5 control-label">Supplier Address</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="supplier_address" value="{{ old('supplier_address') }}" readonly="readonly">
                        @if ($errors->has('supplier_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier_address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('tin_number') ? ' has-error' : '' }}">
                    <label for="tin_number" class="col-md-5 control-label">TIN Number</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="tin_number" value="{{ old('tin_number') }}">
                        @if ($errors->has('tin_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tin_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('mode') ? ' has-error' : '' }}">
                    <label for="mode" class="col-md-5 control-label">Mode of Procurement</label>
                    <div class="col-md-7">
                        <select  class="form-control" name="mode" value="{{ old('mode') }}" required="required">
                            <option value="Public Bidding">Public Bidding</option>
                            <option value="Limited Source Bidding">Limited Source Bidding</option>
                            <option value="Direct Contracting">Direct Contracting</option>
                            <option value="Repeat Order">Repeat Order</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Negotiated Procurement">Negotiated Procurement</option>
                            <option value="Small Value">Small Value</option>
                            <option value="Agency-To-Agency">Agency-To-Agency</option>
                        </select>
                        @if ($errors->has('mode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_place') ? ' has-error' : '' }}">
                    <label for="delivery_place" class="col-md-5 control-label">Place of Delivery</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="delivery_place" value="{{ old('delivery_place') }}" required="required">
                        @if ($errors->has('delivery_place'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_place') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('delivery_date') ? ' has-error' : '' }}">
                    <label for="delivery_date" class="col-md-5 control-label">Date of Delivery</label>
                    <div class="col-md-7">
                        <input type="date" class="form-control" name="delivery_date" value="{{ old('delivery_date') }}" >
                        @if ($errors->has('delivery_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('delivery_term') ? ' has-error' : '' }}">
                    <label for="delivery_term" class="col-md-5 control-label">Delivery Term</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="delivery_term" value="{{ old('delivery_term') }}">
                        @if ($errors->has('delivery_term'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_term') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('payment_term') ? ' has-error' : '' }}">
                    <label for="payment_term" class="col-md-5 control-label">Payment Term</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="payment_term" value="{{ old('payment_term') }}">
                        @if ($errors->has('payment_term'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment_term') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-sm">Submit</button>
          <!-- <a href="" title="Generate Abstract" class="btn btn-primary btn-xs">Submit</a> -->
        </div>
        </form>
      </div>
    </div>
</div>

@endsection

@section('script')

{!! $dt2->html()->scripts() !!}
{!! $dt1->html()->scripts() !!}

<script type="text/javascript">
$( document ).ready(function() {
    var table = $('#dt2').DataTable();
    $('#dt2 tbody').on( 'click', 'tr', function () {
        var tblId = table.row( this ).data();

        $.get("/po/"+tblId['pr_form_no'], function(data, status){
          $( "input[name='supplier']" ).val(data['supplier']);
          $( "input[name='supplier_address']" ).val(data['supplier_address']);
        });

        $("#submitPurchaseOrder").attr("action", "/po/submit/"+tblId['id']);
    });
});
</script>

@endsection





