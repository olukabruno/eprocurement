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
        <div class="panel-heading"><b class="panel-title">Inspection Report</b></div>
        <div class="panel-body">
             {!! $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false) !!}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="irModal" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Purchase Order Form Details</b></div>
        </div>
        <div class="modal-body">
          <form id="submitIR" class="form-horizontal" method="POST" action="">
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
                <div class="form-group {{ $errors->has('po_no') ? ' has-error' : '' }}">
                    <label for="po_no" class="col-md-5 control-label">PO No.</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="po_no" value="{{ old('po_no') }}" readonly="readonly">
                        @if ($errors->has('po_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('po_no') }}</strong>
                            </span>
                        @endif
                        <input type="hidden" name="date">
                        <input type="hidden" name="pr_number">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('requisitioning_office') ? ' has-error' : '' }}">
                    <label for="requisitioning_office" class="col-md-5 control-label">Requisitioning Office/Department</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="requisitioning_office" value="{{ old('requisitioning_office') }}" readonly="readonly">
                        @if ($errors->has('requisitioning_office'))
                            <span class="help-block">
                                <strong>{{ $errors->first('requisitioning_office') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-group {{ $errors->has('invoice_no') ? ' has-error' : '' }}">
                    <label for="invoice_no" class="col-md-5 control-label">Invoice no.</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="invoice_no" value="{{ old('invoice_no') }}" required="required  ">
                        @if ($errors->has('invoice_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invoice_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('property_officer') ? ' has-error' : '' }}">
                    <label for="property_officer" class="col-md-5 control-label">Property Officer</label>
                    <div class="col-md-7">
                        <input class="form-control" list="propertyOfficer" name="property_officer">
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
                <div class="form-group {{ $errors->has('inspection_officer') ? ' has-error' : '' }}">
                    <label for="inspection_officer" class="col-md-5 control-label">Inspection Officer</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="inspection_officer" required="">
                        @if ($errors->has('inspection_officer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('inspection_officer') }}</strong>
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

        $.get("/ir/"+tblId['pr_form_no'], function(data, status){
          console.log(data);
          $( "input[name='supplier']" ).val(data['supplier']);
          $( "input[name='po_no']" ).val(data['po_id']);
          $( "input[name='requisitioning_office']" ).val(data['requisitioning_office']);
          $( "input[name='date']" ).val(data['date']);
          $( "input[name='pr_number']" ).val(data['pr_number']);
        });

        $("#submitIR").attr("action", "/ir/submit/"+tblId['id']);
    });
});
</script>

@endsection





