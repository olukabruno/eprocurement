@extends('layouts.app')
@section('content')
<style type="text/css">
	[class^="col"] {padding-bottom:0px;margin-bottom: 1px;}
</style>
@php $sched = explode(",", $item_data->schedule); @endphp
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b class="panel-title">Add Items</b><a href="{{route('ppmp.edit',$ppmp_id)}}" class="back btn btn-danger btn-sm glyphicon glyphicon-arrow-left"></a>
				</div>
				<div class="panel-body">
				<div class="row">
				<form action="{{route('ppmpi.update', [$ppmp_id, $id])}}" method="post" >
				{{ csrf_field() }}
				{{method_field('PATCH')}}
					<div class="col-md-6 clearfix">
						<div class="col-md-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">General Description:</label>
							<div class="col-md-12">
							<textarea name="description" class="form-control input-sm" style="resize: none;" rows="3"autofocus>{{ $item_data->description or old('description') }}</textarea>
							@if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-12 form-group {{ $errors->has('code') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Code:</label>
							<div class="col-md-12">
							<input class="form-control input-sm" list="groups" name="code" value="{{$item_data->code or old('code')}}">
							<datalist id="groups">
								@foreach($grouped as $groupName => $codes)
								<option {{ old('code') == $groupName ? 'selected' : '' }}>{{$groupName}}</option>
								@endforeach
							</datalist>
							@if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
							</div>
						</div>
						<div class="col-md-6 form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">Quantity:</label>
							<div class="col-md-12">
							<input value="{{ $item_data->qty or old('quantity') }}" type="text" name="quantity" class="form-control input-sm" autofocus>
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
							<input class="form-control input-sm" list="units" name="unit" value="{{$item_data->unit}}">
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
							<input value="{{ $item_data->estimated_budget or old('estimated_budget') }}" type="text" name="estimated_budget" class="form-control input-sm" autofocus>
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
							
							<input value="{{ $item_data->procurement_mode or old('mode') }}" list="modes" name="mode" class="form-control input-sm" autofocus>
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
							<div class="col-md-12"><button type="submit" class="btn btn-sm btn-warning">Update</button></div>	
						</div>
					</div>

					{{-- Schedule/Milestones of Activity --}}
					
					<div class="col-md-6 clearfix">
						<b>Schedule/Milestone of Activities</b>
                        <hr style="margin: 0px 0px 10px 0px;">

						<div class="col-md-4 form-group {{ $errors->has('schedule.0') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">JAN:</label>
							<div class="col-md-12">
								<input value="{{ $sched[0] or old('schedule.0',0) }}" name="schedule[0]" id="sched1" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.0'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.0') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.1') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">FEB:</label>
							<div class="col-md-12">
								<input value="{{ $sched[1] or old('schedule.1',0) }}" name="schedule[1]" id="sched2" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.1'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.1') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.2') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">MAR:</label>
							<div class="col-md-12">
								<input value="{{$sched[2] or old('schedule.2',0) }}" name="schedule[2]" id="sched3" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.2') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.3') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">APR:</label>
							<div class="col-md-12">
								<input value="{{$sched[3] or old('schedule.3',0) }}" name="schedule[3]" id="sched4" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.3'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.3') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.4') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">MAY:</label>
							<div class="col-md-12">
								<input value="{{$sched[4] or old('schedule.4',0) }}" name="schedule[4]" id="sched5" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.4'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.4') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.5') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">JUN:</label>
							<div class="col-md-12">
								<input value="{{$sched[5] or old('schedule.5',0) }}" name="schedule[5]" id="sched6" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.5'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.5') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.6') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">JUL:</label>
							<div class="col-md-12">
								<input value="{{$sched[6] or old('schedule.6',0) }}" name="schedule[6]" id="sched7" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.6'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.6') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.7') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">AUG:</label>
							<div class="col-md-12">
								<input value="{{$sched[7] or old('schedule.7',0) }}" name="schedule[7]" id="sched8" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.7'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.7') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.8') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">SEP:</label>
							<div class="col-md-12">
								<input value="{{$sched[8] or old('schedule.8',0) }}" name="schedule[8]" id="sched9" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.8'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.8') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.9') ? ' has-error' : '' }}">
							 <label class="col-md-12 input-sm control-label">OCT:</label>
							<div class="col-md-12">
								<input value="{{$sched[9] or old('schedule.9',0) }}" name="schedule[9]" id="sched10" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.9'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.9') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.10') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">NOV:</label>
							<div class="col-md-12">
								<input value="{{$sched[10] or old('schedule.10',0) }}" name="schedule[10]" id="sched11" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.10'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.10') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
						<div class="col-md-4 form-group {{ $errors->has('schedule.11') ? ' has-error' : '' }}">
							<label class="col-md-12 input-sm control-label">DEC:</label>
							<div class="col-md-12">
								<input value="{{$sched[11] or old('schedule.11',0) }}" name="schedule[11]" id="sched12" class="form-control input-sm" autofocus  >
								@if ($errors->has('schedule.11'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule.11') }}</strong>
                                </span>
                        		@endif
                            </div>
						</div>
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
