@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <!-- Your main wrapper -->


      <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            <!-- registration form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b class="panel-title">Add New Purchase Request</b>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ url('/pr/submit') }}">
                {{ csrf_field() }}
                <input type="hidden" id="pr_status" name="pr_status" value="Pending">
                <input type="hidden" id="pr_created" name="pr_created_by" value="{{ Auth::User()->id }}">
                        <!-- pr_no -->
                        <div class="form-group {{ $errors->has('pr_number') ? ' has-error' : '' }}">
                            <label for="pr_number" class="col-md-4 col-xs-8 control-label" >PR Number</label>
                            <div class="col-md-8 col-xs-16">
                            <input type="hidden" name="pr_unique" value={{$pr_unique}}>
                            <input id="pr_number" type="text" class="form-control" name="pr_number" value="{{ $pr_number }}" readonly autofocus>
                                    @if ($errors->has('pr_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_number') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <!-- department -->
                        <div class="form-group {{ $errors->has('pr_department') ? ' has-error' : '' }} {{ $errors->has('pr_section') ? ' has-error' : '' }}">
                            <label for="pr_department" class="col-md-4 col-xs-8 control-label" >Department</label>
                            <div class="col-md-4 col-xs-8">
                            <input id="pr_department" type="text" class="form-control" name="pr_department" @if($user->department == 'ICT') value="ADM" @else value="{{$user->department}}" @endif readonly required autofocus>
                                    @if ($errors->has('pr_department'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_department') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="col-md-4 col-xs-8">
                            <input id="pr_section" type="text" class="form-control" name="pr_section" placeholder="Section" @if($user->department == 'ICT') value="{{$user->department}}" @else value="" @endif readonly required autofocus>
                                    @if ($errors->has('pr_section'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_section') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <!-- Purpose -->
                        <div class="row form-group {{ $errors->has('pr_purpose') ? ' has-error' : '' }}">
                                <label for="pr_purpose" class="col-md-4 col-xs-8 control-label">Purpose</label>
                                <div class="col-md-8 col-xs-16">
                                    <textarea style="resize: none; height: 65px;" id="pr_purpose" class="form-control" name="pr_purpose" value="{{ old('pr_purpose') }}" autofocus></textarea>
                                    @if ($errors->has('pr_purpose'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_purpose') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <!-- Requestor Name -->
                        <div class="row form-group {{ $errors->has('pr_requestor_name') ? ' has-error' : '' }}">
                                <label for="pr_requestor_name" class="col-md-4 col-xs-8 control-label">Requestor</label>
                                <div class="col-md-8">
                                    <input id="pr_requestor_name" type="text" class="form-control" placeholder="Name" name="pr_requestor_name" @if(empty($requestor)) value="" @else value="{{$requestor->name}}" readonly @endif autofocus>
                                    @if ($errors->has('pr_requestor_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_requestor_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <!-- Requestor Position -->
                        <div class="row form-group {{ $errors->has('pr_requestor_position') ? ' has-error' : '' }}">
                                <label for="pr_requestor_position" class="col-md-4 col-xs-8 control-label"></label>
                                <div class="col-md-8">
                                    <input id="pr_requestor_position" type="text" class="form-control" placeholder="Position" name="pr_requestor_position"  @if(empty($requestor)) value="" @else value="{{$requestor->position}}" readonly @endif autofocus>
                                    @if ($errors->has('pr_requestor_position'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_requestor_position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <!-- Supplier/Dist Type -->
                        <div class="row form-group {{ $errors->has('pr_supplier_type') ? ' has-error' : '' }}">
                                <label for="pr_supplier_type" class="col-md-4 col-xs-8 control-label">Supplier Type</label>
                                <div class="col-md-8">
                                    <select id="disttype" class="form-control" name="pr_supplier_type" required>
                                        <option value="Canvass">Canvass</option>
                                        <option value="Government Agency">Government Agency</option>
                                        <option value="Sole Distributor">Sole Distributor</option>
                                    </select>
                                    @if ($errors->has('pr_supplier_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_supplier_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <!-- supplier details -->
                        <div  class="dist row form-group {{ $errors->has('pr_supplier_name') ? ' has-error' : '' }}">
                                <label for="pr_supplier_name" id="label-comp" class="col-md-4 col-xs-8 control-label">Supplier Name</label>
                                <div id="supplier_details" class="col-md-8">
                                    <input id="dist-name" type="text" class="form-control" name="pr_supplier_name" autofocus readonly>
                                   
                                    @if ($errors->has('pr_supplier_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_supplier_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                
                        </div>

                        <div class="row form-group {{ $errors->has('pr_budget_alloc') ? ' has-error' : '' }}">
                                <label for="pr_budget_alloc" class="col-md-4 col-xs-8 control-label">PPMP Budget</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                    <input id="pr_budget_alloc" type="text" class="form-control" name="pr_budget_alloc" value="{{ old('pr_budget_alloc',number_format($ppmp->remaining_budget, 2)) }}" readonly autofocus>
                                    <span class="input-group-addon">Pesos</span>
                                    </div>
                                    <h5><strong>*Attatch PPMP as proof</strong></h5>
                                    @if ($errors->has('pr_budget_alloc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pr_budget_alloc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                        </div>


                        <div class="form-group">
                            <div class="col-md-3 col-sm-offset-4"><button type="submit" class="btn btn-primary"
                                @if($ppmp->remaining_budget < 1 )
                                disabled
                                @endif
                                >Register</button></div>
                        </div>
                    </form>
                    </div>
            </div><!--panel-->
            </div><!-- col -->

            <div class="col-md-8">
                <!-- table -->
                        <!-- update edit edelete-->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <b class="panel-title">View Purchase Request</b>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-condensed table-bordered table-hover'],false) !!}
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
      </div>
    </div>



@endsection


@section('script')

{!! $dataTable->scripts() !!}

<script type="text/javascript">
    
    $(document).ready(function() {
      //PR Supplier
         $('#disttype').change(
            function () {
                var method = $('option:selected', this).text();
                if (method == "Canvass")
                {
                    $("#dist-name").prop('readonly', true);
                    $("#dist-name").prop('required', true);
                }else
                {
                    $("#dist-name").prop('readonly', false);
                    $("#dist-name").prop('required', false);
                }
        });

     
    });
</script>
@endsection