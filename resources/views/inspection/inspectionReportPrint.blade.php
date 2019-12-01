<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<style type="text/css">
		*{
			color:#262626;
		}
		[class^="col"] {
		    /*border: 1px solid #ccc;*/
		}
		hr{margin:0px; border: 1px solid #262626;}
		.content thead  tr th, .content thead  tr td, .content tbody tr td, .content tfoot tr th {
			vertical-align: middle !important;
			text-align: center;
			border: #262626 solid 1px !important;
		}
		.content tbody tr td{
			padding: 1px 1px;
		}
		.well{
			border: 1px solid #262626;
			border-radius: 0 !important;
			padding: 3px;
		}
	
	</style>
</head>
<body>
@foreach($abstract_items as $items)
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 text-center"><h4><b><i>ACCEPTANCE AND INSPECTION REPORT</i></b></h4></div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center"><h5><u>City Government of San Fernando</u></h5></div>
	</div>
	<div class="row" style="border:1px solid #262626;">
		<div class="col-xs-12">&nbsp;</div>
		<div class="col-xs-12" style="padding: 1px 5px 5px 5px;">
			<div class="col-xs-6 " style="padding: 0px;">
				<div class="col-xs-2" style="padding:2px 0px 0px;">Supplier:</div>
				<div class="col-xs-10" style="padding: 0px;">{{$ir->supplier}}<hr></div>
			</div>
			<div class="col-xs-4" style="padding: 0px;">
				<div class="col-xs-4" style="padding:2px 0px 0px;">AIR No.:</div>
				<div class="col-xs-8" style="padding: 0px;">{{$ir->id}}<hr></div>
			</div>
		</div><br>
		<div class="col-xs-12" style="padding: 1px 5px 5px 5px;">
			<div class="col-xs-3" style="padding: 0px;">
				<div class="col-xs-4" style="padding:2px 0px 0px;">PO No.:</div>
				<div class="col-xs-8" style="padding: 0px;">{{$ir->po_no}}<hr></div>
			</div>
			<div class="col-xs-3" style="padding: 0px;">
				<div class="col-xs-4" style="padding:2px 0px 0px;">Date:</div>
				<div class="col-xs-8" style="padding: 0px;">{{$ir->po_date}}<hr></div>
			</div>
			<div class="col-xs-3" style="padding: 0px;">
				<div class="col-xs-5" style="padding:2px 0px 0px;">Invoice No.:</div>
				<div class="col-xs-7" style="padding: 0px;">{{$ir->invoice_no}}<hr></div>
			</div>
			<div class="col-xs-3" style="padding: 0px;">
				<div class="col-xs-4" style="padding:2px 0px 0px;">Date:</div>
				<div class="col-xs-8" style="padding: 0px;">&nbsp;<hr></div>
			</div>
		</div><br>
		<div class="col-xs-12" style="padding: 1px 5px 5px 5px;">
			<div class="col-xs-4" style="padding:2px 0px 0px;">Requisitioning Office/Department:</div>
			<div class="col-xs-8" style="padding: 0px;">{{$office->office_name}}<hr></div>
		</div>
		<div class="col-xs-12">&nbsp;</div>
	</div>
	<div class="row">
		<table class="table table-condensed content">
			<thead>
				<tr>
					<th class="col-xs-1"><i>Item No.</i></th>
					<th class="col-xs-1"><i>Unit</i></th>
					<th class="col-xs-8"><i>Description</i></th>
					<th class="col-xs-1"><i>Quantity</i></th>
				</tr>
			</thead>
			<tbody>
			@foreach($items as $item_no => $item)
				<tr>
					<td>{{$item_no + 1}}</td>
					<td>{{$item->unit}}</td>
					<td style="text-align: left;">&nbsp;{{$item->particulars}}</td>
					<td>{{$item->qty}}</td>
				</tr>
			@endforeach
			@if($items->count() < 35)
				@for($i=$items->count();$i < 35 ;$i++)
				<tr>
					@for($j=0;$j < 4;$j++)
					<td>&nbsp;</td>
					@endfor
				</tr>
				@endfor
			@endif
			</tbody>
		</table>
	</div>
	<div class="row text-center" style="margin-top:-21px;">
		<div class="col-xs-6" style="border:1px solid #262626; padding: 5px;"><b>ACCEPTANCE</b></div>
		<div class="col-xs-6" style="border:1px solid #262626; padding: 5px;"><b>INSPECTION</b></div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="border:1px solid #262626;">
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-4">Date Recieved:</div>
			<div class="col-xs-8">&nbsp;<hr></div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-2" style="padding: 0px;"><div style="margin: 0px;" class="well"></div></div>
			<div class="col-xs-10">Complete</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-2"  style="padding: 0px;"><div style="margin: 0px;" class="well"></div></div>
			<div class="col-xs-10">Partial</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12 text-center">{{$ir->property_officer}}<hr></div>
			<div class="col-xs-12 text-center">Property Officer</div>
		</div>
		<div class="col-xs-6" style="border:1px solid #262626;">
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-5">Date Inspected:</div>
			<div class="col-xs-7">&nbsp;<hr></div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12 text-right">Inspected, verified and found</div>
			<div class="col-xs-2 text-right">OK</div>
			<div class="col-xs-2" style="padding: 0px;"><div style="margin: 0px;" class="well"></div></div>
			<div class="col-xs-8">&nbsp;</div>
			<div class="col-xs-12 text-right">As to quantity and specifications</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12 text-center">{{$ir->inspection_officer}}<hr></div>
			<div class="col-xs-12 text-center">Inspection Officer/Committee</div>
		</div>
	</div>
</div>
@endforeach
<span style="page-break-after:avoid;"></span>
</body>
</html>