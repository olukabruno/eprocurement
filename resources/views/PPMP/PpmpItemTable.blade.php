<div class="row">
					{{-- View Item --}}
					<div class="col-md-12">
						<div class="table-responsive">
						<table class="table table-bordered table-hover table-condensed" style="table-layout: fixed;">
							<thead>
								<tr>
									<th rowspan="2" style="word-wrap: break-word; width: 6%;text-align: center;">Code</th>
									<th rowspan="2" style="word-wrap: break-word;width: 40%;text-align: center;">General Description</th>
									<th rowspan="2" style="word-wrap: break-word;width: 5%;text-align: center;">Qty/Size</th>
									<th rowspan="2" style="word-wrap: break-word;width: 10%;text-align: center;">Unit</th>
									<th rowspan="2" style="word-wrap: break-word;width: 15%;text-align: center;">Estimated Budget</th>
									<th rowspan="2"  style="word-wrap: break-word;width: 10%;text-align: center;">Stock</th>
									<th rowspan="2" style="word-wrap: break-word;width: 15%;text-align: center;">Mode Of Procurement</th>
									<th colspan="12" style="word-wrap: break-word;width: 50%;text-align: center;">Schedule/Milestone of Activities</th>
									
									<th style="width: 10%;text-align: center;">
										@if($grouped->count() > 0)
										<a href="{{route('ppmp.print',$ppmp_id)}}" target="_blank" class="btn btn-success btn-xs glyphicon glyphicon-print"></a>
										@endif
									</th>
									
								</tr>
								<tr>
									@for($m=1; $m<=12; ++$m)
									   <th style="width: 1%;text-align: center;"> {{strtoupper(date('M', mktime(0, 0, 0, $m, 1)))}} </th>
									@endfor
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($grouped->count() < 1)
									<tr>
										<td colspan = "20" style="text-align: center;">No data available in table</td>
									</tr>
								@endif
								@foreach($grouped as $key => $group)
								<tr>
									<th colspan="20" class="info">{{strtoUpper($key)}}</th>
								</tr>
									@foreach($group as $key2 => $items)
									@php $schedule = explode(",", $items['schedule']); @endphp
										<tr>
											<td></td>
											<td style="word-wrap: break-word; text-align: left;">{{$items['description']}}</td>
											<td style="word-wrap: break-word; text-align: center;">{{$items['qty']}}</td>
											<td style="word-wrap: break-word; text-align: center;">{{$items['unit']}}</td>
											
											<td style="text-align: right;">{{number_format($items['estimated_budget'],2)}}</td>
											<td style="word-wrap: break-word; text-align: center;">{{$items['inventory']}}</td>
											<td style="text-align: left;">{{$items['procurement_mode']}}</td>
											@foreach($schedule as $milestones)
											<td style="text-align: center;">
												@if($milestones != 0)
													{{$milestones}}
												@endif
											</td>
											@endforeach
											
											<td style="text-align: center;"><a title="edit" href="{{route('ppmpi.edit', [$ppmp_id , $items['id']])}}" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>&nbsp;<a href="{{route('ppmpi.delete', [$ppmp_id , $items['id']])}}" title="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus"></a></td>
								
										</tr>
									@endforeach
								@php
									$sub_total = $grouped->map(function ($row) 
									{
										return $row->sum('estimated_budget');
									});
									
									
								@endphp
								@if($loop->last)
								@else
								<tr class="warning">
										<td></td>
										<td colspan="3" style="text-align: right;">SUB-TOTAL</td>
										<td style="text-align: right;">
											&#8369;
											@if(isset($sub_total) == true)
												{{number_format($sub_total[$key], 2)}}
											@else
												0.00
											@endif
										</td>
										@for($th = 0; $th <= 13 ; $th++)
										<th></th>
										@endfor
									</tr>
								@endif
								@endforeach
							</tbody>
							@if($grouped->count() > 0)
							<tfoot>
								<tr class="success">
									<th style="text-align: right;" colspan="4">TOTAL</th>
									<th style="text-align: right;">
										&#8369;
										@php
											$st = $sub_total->toArray();
											$count = count($st);
											if(array_key_exists('OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES', $st)){
												$grand_total =  array_sum($st) - $st['OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES'];
											}else{
												$grand_total = array_sum($st);
											}
										@endphp
										@if(isset($sub_total) == true)
											{{number_format($grand_total, 2)}}
										@else
										0.00
										@endif	
									</th>
									@for($ftr = 0; $ftr <= 13 ; $ftr++)
									<th></th>
									@endfor
								</tr>
							</tfoot>
							@endif
						</table>
						</div>
					</div>
				</div>