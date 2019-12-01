@extends('layouts.app')
@section('content')
<style type="text/css">
	[class^="col"] {padding-bottom:0px;margin-bottom: 1px;}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b class="panel-title">Add Items</b><a href="{{route('ppmp.index')}}" class="back btn btn-danger btn-sm glyphicon glyphicon-arrow-left"></a>
				</div>
				<div class="panel-body">
				<div class="row">
				<form action="{{route('ppmp.items', $ppmp_id)}}" method="post" >
				{{ csrf_field() }}
					<div class="col-md-6 clearfix">
						<div class="col-md-12 form-group {{ $errors->has('code') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Code:</label>
							<div class="col-md-12">
							<input class="form-control input-sm" list="groups" name="code">
							<datalist id="groups">
								@foreach($grouped as $groupName => $codes)
								<option>{{$groupName}}</option>
								@endforeach
								@if(isset($groupName) == TRUE)
									@if($groupName == 'OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES'))
									@else
									<option>OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES</option>
									@endif
								@endif
								
							</datalist>
							@if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">General Description:</label>
							<div class="col-md-12">
							<textarea name="description" class="form-control input-sm" style="resize: none;" rows="3"autofocus>{{ old('description') }}</textarea>
							@if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-6 form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Quantity:</label>
							<div class="col-md-12">
							<input value="{{ old('quantity') }}" type="text" name="quantity" class="form-control input-sm" autofocus>
							@if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        	</div>
						</div><br><br>	
						<div class="col-md-6 form-group {{ $errors->has('unit') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Unit:</label>
							<div class="col-md-12">
							<input class="form-control input-sm" list="units" name="unit">
							<datalist id="units">
								@foreach($units as $unit)
								<option {{ old('unit') == $unit->iso_code ? 'selected' : '' }} value="{{$unit->iso_code}}">{{$unit->iso_name}}</option>
								@endforeach
							</datalist>
							
							@if ($errors->has('unit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('unit') }}</strong>
                                </span>
                            @endif
                            </div>
						</div>
						<div class="col-md-6 form-group {{ $errors->has('estimated_budget') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Estimated Budget:</label>
							<div class="col-sm-12">
							<input value="{{ old('estimated_budget') }}" type="text" name="estimated_budget" class="form-control input-sm" autofocus>
							@if ($errors->has('estimated_budget'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estimated_budget') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-6 form-group {{ $errors->has('mode') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Mode of Procurement:</label>
							<div class="col-sm-12">
							<input class="form-control input-sm" list="modes" name="mode">
							<datalist id="modes">
								<option>Public Bidding</option>
								<option>Limited Source Bidding</option>
								<option>Direct Contracting</option>
								<option>Repeat Order</option>
								<option>Shopping</option>
								<option>Negotiated Procurement</option>
								<option>Small Value</option>
                            	<option>Agency-To-Agency</option>
							</datalist>
							@if ($errors->has('mode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mode') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-12 text-right" style="margin-top: 10px;">
							<div class="col-md-12"><button type="submit" class="btn btn-sm btn-primary">Submit</button></div>	
						</div>
					</div>

					{{-- Schedule/Milestones of Activity --}}
					
					<div class="col-md-6 clearfix">
						<b>Schedule/Milestone of Activities</b>
                        <hr style="margin: 0px 0px 10px 0px;">

                        @for($s=1; $s<=12; $s++)
                        @php $month_num = $s-1; @endphp
						<div class="col-md-4 form-group {{ $errors->has('schedule.'.$month_num) ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">{{strtoupper(date('M', mktime(0, 0, 0, $s, 1)))}}</label>
							<div class="col-md-12">
								<input value="{{ old('schedule.'.$month_num,0) }}" name="schedule[{{$month_num}}]" id="sched1" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.'.$month_num))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.'.$month_num) }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						@endfor
						
					</div>
				</form>
				
					
				</div>
				<br>
				@include('PPMP.PpmpItemTable')
				</div> 
			</div>
		</div>
	</div>
	<div class="row">
		
	</div>
</div>

@endsection
