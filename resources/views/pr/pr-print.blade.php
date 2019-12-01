<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<style type="text/css">
		*{color:#262626;}

		/*[class^="col"] {border: 1px solid #FFF;}*/

		/*#logosfc{margin-top: 5px;}*/

		.well{
			border:solid #262626;
			border-radius: 0 !important;
			margin-top: 15px;
			background: #262626 !important;
			color: #fff !important;
			padding: 5px;
			font-size: 20px;
			font-weight: bold;
			text-align: center;
		}
		.header-pr div{font-size: 16px;font-weight: bold;}

		.header-pr .heading2{
			font-size: 18px !important;
			background: #262626 !important;
			color: #fff !important;
			text-align: center;
			font-weight: bold;
			border:1px solid #262626;
		}
		.content thead  tr th, .content thead  tr td, .content tbody tr td, .content tfoot tr th {
			vertical-align: middle !important;
			text-align: center;
			border: #262626 solid 1px !important;
		}
		.content tbody tr td{
			padding: 3px 3px;
		}
		.content thead  tr th,.content tfoot tr th{
			background:#bfbfbf;
		}

		hr{margin:0px; border: 1px solid #262626;}

		.head-label{margin-top: 1px;padding: 0px;}

		.topped{margin-top:10px;}
		.topped-border{border:1px solid #262626;}

	</style>
</head>
<body>

@php $check=1 @endphp
@foreach($results as $dos)
<div class="container-fluid">
	<!-- start of header -->
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 text-right">
				<img id="logosfc" src="{{asset('images/sfclogo.png')}}" width="60px" height="60px">
			</div>
            <div class="col-xs-8 text-center">
              <div class="row header-pr">
              	<div class="col-xs-12">REPUBLIC OF THE PHILIPPINES</div>
                <div class="col-xs-12">PROVINCE OF LA UNION</div>
                <div class="col-xs-12">CITY OF SAN FERNANDO</div>
              </div>
            </div>
            <div class="col-xs-2">
            	<div class="well">PR</div>
            </div>
		</div>
		<div class="col-xs-3">
		</div>
	</div>

	<div class="row header-pr" style="border:1px solid #262626;margin-top: 10px;">
		<div class="col-xs-12 heading2">
			@if($pr->pr_form_no == $pr->prev_pr.'-01') SUPPLEMENTAL @endif PURCHASE REQUEST
		</div>
	</div>
	<div class="row topped topped-border">
		<div class="col-xs-4" style="padding:10px;">
			<div class="col-xs-12">
				<div class="col-xs-4 head-label">DEPARTMENT:</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-12 head-label">{{$dept->office_name}}<hr></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">SECTION:</div>
				<div class="col-xs-9" style="padding: 0px;">@if($pr->section == "")&nbsp;@else{{$section->office_name}}@endif<hr></div>
			</div>
		</div>
		<div class="col-xs-4" style="padding:10px;">
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">PR No.:</div>
				<div class="col-xs-9" style="padding: 0px;">{{$pr->pr_form_no}}<hr></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">SAI No.:</div><div class="col-xs-9" style="padding: 0px;">&nbsp;<hr></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">ObR No.:</div><div class="col-xs-9" style="padding: 0px;">&nbsp;<hr></div>
			</div>
		</div>
		<div class="col-xs-4" style="padding:10px;">
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">Date:</div>
				<div class="col-xs-9" style="padding: 0px;">{{$dt->Format('F j, Y')}}<hr></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">Date:</div><div class="col-xs-9" style="padding: 0px;">&nbsp;<hr></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-3 head-label">Date:</div><div class="col-xs-9" style="padding: 0px;">&nbsp;<hr></div>
			</div>
		</div>
	</div>

	<!-- content -->
	<div class="row topped">
		<table class="table table-condensed table-bordered content">
			<thead>
				<tr>
					<th style='width:7%;'>ITEM NO.</th>
					<th style='width:7%;'>QTY</th>
					<th style='width:7%;'>UNIT</th>
					<th style='width:49%;'>DESCRIPTION</th>
					<th style='width:15%;'>ESTIMATED UNIT OF</th>
					<th style='width:15%;'>ESTIMATED COST</th>
				</tr>
			</thead>	

			<tbody>
			@foreach($dos as $list)	
			    <tr>
			      <td>{{$check++}}</td>
			      <td>{{$list->pr_qty}}</td>
			      <td>{{$list->pr_unit}}</td>
			      <td>
			      	@php
			      		$ppmpitem = App\PpmpItem::find($list->pr_description);
			      	@endphp
			      	{{$ppmpitem->description}}
			      </td>
			      <td style='text-align: right;'>{{number_format($list->pr_cost_per_unit,2)}}</td>
			      <td style='text-align: right;'>{{number_format($list->pr_estimated_cost,2)}}</td>
			    </tr>
			    
			@endforeach
			@if($dos->count() < 15)
				@for($i = $dos->count(); $i < 15; $i++)
	                    <tr>
	                    	@for($j = 0; $j < 6; $j++)
	                    	<td>&nbsp;</td>
	                    	@endfor
	                    </tr>
	        	@endfor
	        @endif
	        <tr style="background-color: #b0b1b2;">
				<td colspan="5" style="text-align: right;">SUB-TOTAL</td>
				<td style="text-align: right;">&#8369;&nbsp; {{number_format($dos->sum('pr_estimated_cost'),2)}}</td>
			</tr>
			</tbody>
			<tfoot>
				<tr style="background-color: #b0b1b2;">
				    <th colspan="5" style="text-align: right;">GRAND TOTAL</th>
				  	<th style="text-align: right;">&#8369;&nbsp; {{number_format($grand_total,2)}}</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- footer -->
	<div class="row" style="margin-top:5px;">
		<table style='width:100%;border:1px solid #262626;font-size:12px;margin-left:auto;margin-right:auto;' cellspacing='0' cellpadding='3'>
			<tr>
				<td style='width:39%; font-weight:bold;text-align:left;border:1px solid #262626;'>
				REQUESTING OFFICE<br/><br/><br/>
				</td>
				<td style='width:60%;border:1px solid #262626;vertical-align:top;font-weight:bold;' colspan='2' rowspan='3'>
				PURPOSE<br/>
				<div style='width:100%;text-align:center;font-weight:normal;font-size:11pt;'>
					{{$pr->purpose}}
				</div>
				</td>
			</tr>
			<tr>
				<td style='border:1px solid #262626;height:10px;text-align:center;text-transform:uppercase;font-weight:bold;'>
				{{$pr->requestor_name}}
				</td>
			</tr>
			<tr>
				<td style='text-align:center;border:1px solid #262626;text-transform:uppercase;height:10px;font-weight:bold'>
				{{$pr->requestor_position}}
				</td>
			</tr>
			<tr>
				<td colspan='3' style='background-color:#262626;height:20px;'>
			</tr>
			<tr>
				<td style='width:33%; font-weight:bold;text-align:left;border:1px solid #262626;'>
				APPROPRIATION AVAILABLE
				</td>
				<td style='width:33%; font-weight:bold;text-align:left;border:1px solid #262626;'>
				FUNDS AVAILABLE
				</td>
				<td style='width:33%; font-weight:bold;text-align:left;border:1px solid #262626;'>
				APPROVED
				</td>
			</tr>
			<tr>
				<td style='border:1px solid #262626;height:25px;text-align:center;text-transform:uppercase;font-weight:bold;'>
				
				</td>
				<td style='border:1px solid #262626;height:25px;text-align:center;text-transform:uppercase;font-weight:bold;'>
				
				</td>
				<td style='border:1px solid #262626;height:25px;text-align:center;text-transform:uppercase;font-weight:bold;'>
				
				</td>
			</tr>
			<tr>
				<td style='width:33%; font-weight:bold;text-align:center;border:1px solid #262626;text-transform:uppercase;'>
				{{$aa->name}}<br/>
				{{$aa->position}}
				</td>
				<td style='width:33%; font-weight:bold;text-align:center;border:1px solid #262626;text-transform:uppercase;'>
				{{$c->name}}<br/>
				{{$c->position}}
				</td>
				<td style='width:33%; font-weight:bold;text-align:center;border:1px solid #262626;text-transform:uppercase;'>
				{{$approval->name}}<br/>
				{{$approval->position}}
				</td>
			</tr>
		</table>
	</div>


</div>
@endforeach
<span style="page-break-after:avoid;"></span>



<!-- scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- end scripts -->
</body>
</html>