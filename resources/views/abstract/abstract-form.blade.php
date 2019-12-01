@extends('layouts.app')
@section('content')
<?php
	include('../public/php/databaseConnection.php');
?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><b class="panel-title">Abstract of Quotation</b><a href="{{route('abstract.view')}}" class="back btn btn-danger btn-sm glyphicon glyphicon-arrow-left" title="Back"></a></div>
	  <div class="panel-body">
	  	<table class="table table-condensed borderless-head tbl-custom">
	  		<form id="abstract_form" method="POST" action="{{route('abstract.update',$abstract->id)}}">
	  		{{ csrf_field() }}
	  		{{ method_field('PATCH') }}
	  		<thead>
	  			<tr>
	  			 	<th><label>Purchase Request #</label> <input class="form-control input-sm" type="text" value="{{$abstract->pr_number}}" disabled></th>
	  			 	<th><label>Procurement Of</label> <input class="form-control input-sm" type="text" value="{{$abstract->proc_details}}" disabled></th>
	  			 	<th><label>Requestor Name</label> <input class="form-control input-sm" type="text" value="{{$abstract->requestor_name}}" disabled></th>
	  			 	<th><label>Requesting Office</label> <input class="form-control input-sm" type="text" value="{{$abstract->office}}" disabled></th>
	  			</tr>
	  			<tr>
	  				<th class="col-xs-2">
	  					<label>Selected Bidder</label>
	  					<select class="form-control input-sm" name="bidder">
	  						<option value="">None</option>
	  						@foreach($select_bidder as $key01 => $bidder)
	  						<option value="{{$bidder->id}}" @if(!empty($selected_bidder)) @if($bidder->id == $selected_bidder->id) selected @endif @endif>{{$bidder->supplier}}</option>
	  						@endforeach
	  					</select>
	  				</th>
	  			 	<th class="col-xs-3">
	  					<label>Reason</label>
	  					<select class="form-control input-sm" name="reason">	
	  						<option value='0'@if($abstract->reason == 0) selected @endif>Lowest and Responsive Price Quotation</option>
	  						<option value='1' @if($abstract->reason == 1) selected @endif>Most Responsive Price Quotation</option>
	  					</select>
	  				</th>
	  				<th colspan="2">
	  					<label>Notes on Selected Bidder</label>
	  					<input class="form-control input-sm" name="notes" type="text" value="{{$abstract->notes}}" required="required">
	  				</th>
	  				<th class="text-right">
	  					<button title="Update" class="btn btn-primary btn-sm glyphicon  glyphicon-pencil" 
	  					 	@if ($query->count() == 0) disabled @endif type="submit">
	  					</button>
	  					<a 
	  					@if($as > 0)
	  						href="{{route('abstract.print',$abstract->pr_number)}}"
	  						target="_blank"
	  					@else
	  						href="#"
	  						disabled
	  					@endif
	  					title="Print" class="btn btn-success btn-sm glyphicon glyphicon-print"></a> 
	  				@if($query->count() >= 3)
	  					<button type="button" title="Add Supplier" class="btn btn-sm glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal">
	  					</button>
	  				@endif
	  				</th>
	  			</tr>
	  		</thead>
	  	</form>
	  	</table>

		<div>
			<table class="table table-responsive table-bordered table-condensed table-hover">
			  <thead class="text-center">
			  	<tr class="center-t">
			  		<th  rowspan="4" class="col-xs-3">Particulars</th>
			  		<th rowspan="4" class="col-xs-1">Qty</th>
			  		<th  rowspan="4" class="col-xs-1">Unit</th>
			  		@foreach($query as $keystone => $supplierid)
			  		<th colspan="2">
			  			<button type="button" id="editSupplierBtn{{$keystone}}" title="Edit Supplier" data-toggle="modal" data-target="#editSupplier" class="btn btn-warning btn-xs glyphicon glyphicon-pencil" value="{{$supplierid->id}}" onclick="getData({!!$keystone!!});"></button>
			  			@if($pr->supplier_name != "")
			  			@else
			  			<a href="{{route('supplier.delete',$supplierid->id)}}" class="btn btn-danger btn-xs glyphicon glyphicon-minus"></a>
			  			@endif
			  		</th>
			  		@endforeach
			  		<!-- if the suppliers is lesser than 3 generate blank -->
					@if($query->count() < 3)
						@if($pr->supplier_name != "")
							@for($i=$query->count();$i < 1 ;$i++)
								<th colspan="2">
									<button type="button" title="Add Supplier" class="btn btn-xs glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal"></button>
								</th>	
							@endfor
						@else
							@for($i=$query->count();$i < 3 ;$i++)
								<th colspan="2">
									<button type="button" title="Add Supplier" class="btn btn-xs glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal"></button>
								</th>	
							@endfor
						@endif
					@endif
			  	</tr>
			  	<tr class="center-t">
			  		

			  		@php $counter = 0; @endphp
			  		@foreach($query as $key => $suppliername)
			  		@php $counter++; @endphp
    				<th colspan="2" class="col-xs-2">Supplier {{$counter}}</th>		
					@endforeach
					
					<!-- if the suppliers is lesser than 3 generate blank -->
					@if($query->count() < 3)
						@for($i=$query->count();$i < 3 ;$i++)
							<th colspan="2" class="col-xs-2">Supplier {{$i+1}}</th>	
						@endfor
					@endif

			  	</tr>
			  	<tr>

			  		@foreach($query as $indexKey => $suppliers)
			  		<td colspan="2" class="col-xs-2 someCell">{{$suppliers->supplier}}</td>
			  		@endforeach

			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		@if($query->count() < 3)
						@for($i=$query->count();$i < 3 ;$i++)
							<td colspan="2" class="col-xs-2 someCell">N/A</td>	
						@endfor
					@endif
	
			  	</tr>
			  	<tr class="center-t">
			  		
			  		@foreach($query as $key => $prices)
			  		<th class="col-xs-1">Price/Unit</th>
			  		<th class="col-xs-1">Price/Item</th>
			  		@endforeach
			  		
			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		@if($query->count() < 3)
						@for($i=$query->count();$i < 3 ;$i++)
							<th class="col-xs-1">Price/Unit</th>
			  				<th class="col-xs-1">Price/Item</th>	
						@endfor
					@endif

			  	</tr>
			  </thead>
			  <tbody>
			  	@foreach($abstract_items as $key2 => $items)
			  	<tr>
			  		<td>{{$items->particulars}}</td>
			  		<td style="text-align: center;">{{$items->qty}}</td>
			  		<td style="text-align: center;">{{$items->unit}}</td>
			  		
			  		@foreach($query as $key3 => $prices3)
		  			<?php
		  			$qry = mysqli_query($conn,"select * from abstract_supplier a, abstract_price b where a.id=b.supplier_id and a.id='$prices3->id' and b.item_id='$items->id' ");

		  			$count = mysqli_num_rows($qry);

		  			echo "<td style='text-align:right'>";
		  			for($a=1;$a<=mysqli_num_rows($qry);$a++){
		  				$data = mysqli_fetch_assoc($qry);
		  				echo number_format($data['unit_price'],2);
		  				echo "<td style='text-align:right'>";
		  				echo number_format($data['total_price'],2);
		  				echo "</td>";
		  			}
		  			echo "</td>";
		  			?>
		  			@endforeach
			  		
			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		@if($query->count() < 3)
						@for($i=$query->count();$i < 3 ;$i++)
							<td style='text-align:right' class="col-xs-1"></td>
			  				<td style='text-align:right' class="col-xs-1"></td>	
						@endfor
					@endif
			  		
			  		
			  	</tr>
			  	@endforeach
			  </tbody>
			  <tfoot>
			  	<tr style="background-color: #CCC;">
			  		<th style="text-align: right;">TOTAL</th>
			  		<th></th>
			  		<th></th>
			  		@foreach($query as $grand => $total)
			  		<th class="col-xs-1"></th>
			  		<th class="col-xs-1" style="text-align: right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;&nbsp;</span>
			  			<?php
			  				$qid = $total->id;
			  				$total_query = mysqli_query($conn,"select SUM(total_price) as value_sum from abstract_price a, abstract_supplier b, abstract_items c WHERE a.supplier_id = b.id and b.id=$qid and a.item_id = c.id");
			  				$data2 = mysqli_fetch_assoc($total_query);
			  				
			  				echo number_format($data2['value_sum'],2);
			  			?>
			  		</th>
			  		@endforeach
			  		@if($query->count() < 3)
						@for($i=$query->count();$i < 3 ;$i++)
							<td style='text-align:right' class="col-xs-1"></td>
			  				<td style='text-align:right' class="col-xs-1"></td>	
						@endfor
					@endif
			  	</tr>
			  </tfoot>
			</table>
			{{$query->links()}}
		</div>
		
	
	</div>
</div>

<!-- Add Supplier Modal -->
  <div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title">Add Supplier</div>
        </div>
        <form name="new_supplier" action="{{Route('abstract.supplier')}}" method="POST">
        	{{ csrf_field() }}
        	<input type="hidden" name="abstract_id" value="{{$abstract->id}}">
        	<input type="hidden" name="abstract_pr" value="{{$abstract->pr_number}}">
        <div class="modal-body">
        	<div class="row">
        		<div class="col-xs-4">
        			<label style="font-size: 12px;">Supplier Name</label>
        			<input name="supplier_name" class="form-control input-sm" type="text" 
        			@if($pr->supplier_name != "") value = "{{$pr->supplier_name}}" @endif 
        			required="required">
        		</div>
        		<div class="col-xs-3">
        			<label style="font-size: 12px;">Supplier Address</label>
        			<input name="supplier_address" class="form-control input-sm" type="text" value="" required="required">
        		</div>
        		<div class="col-xs-3">
        			<label style="font-size: 12px;">Canvasser Name</label>
        			<input name="canv_name" class="form-control input-sm" type="text" value="" required="required">
        		</div>
        		<div class="col-xs-2">
        			<label style="font-size: 12px;">Department</label> 
	  			 	 <select name="canv_dept" class="form-control input-sm" type="text">
	  			 	 	<option value="{{$abstract->office}}">{{$abstract->office}}</option>
	  			 	 	<option value="GSO">GSO</option>
	  			 	 </select>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Budget Allocation</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;{{number_format($pr->budget_alloc,2)}}" disabled>
        		</div>
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Estimated Cost</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;{{number_format($pr_item->sum('pr_estimated_cost'),2)}}" disabled>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-12">
        			<fieldset><legend style="font-size: 14px">Supplier Prices</legend>
		        	<table class="table table-condensed table-bordered">
		        		<thead>
		        			<tr class="info">
			        			<th class="col-xs-5">Particulars</th>
			        			<th class="col-xs-1">Qty</th>
			        			<th class="col-xs-1">Unit</th>
			        			<th>Unit Price</th>
			        			<th>Total Price</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			@foreach($abstract_items as $indexKey => $list)
		        			<tr>
		        				<td>
		        					<input type="hidden" name="item[]" value="{{$list->id}}">
		        					{{$list->particulars}}
		        				</td>
			        			<td style="padding: 0px;">
			        				<input type="numeric" id="quantity{{$indexKey}}" name="qty[]" class="form-control input-sm"  value="{{$list->qty}}" readonly>
			        			</td>
			        			<td>
			        				{{$list->unit}}
			        			</td>
			        			<td style="padding: 0px;">
									<input type="numeric" id="estimated_unit{{$indexKey}}" name="unit_price[]" class="text-right form-control input-sm"  oninput="multiply({!!$indexKey!!});" value="0">
			        			</td>
			        			<td style="padding: 0px;">
			        				<input id="estimated_cost{{$indexKey}}" name="total_price[]" class="text-right estimated_cost form-control input-sm" oninput="multiply({!!$indexKey!!});" value="0" disabled>
			        			</td>
		        			</tr>
		        			@endforeach
		        		</tbody>
		        		<tfoot>
						    <tr class="info">
						      <th colspan="4">GRAND TOTAL</th>
						      <th style="padding: 0px;">
								<div class="input-group">
			        				<span class="input-group-addon">&#8369;</span>
			        				<input id="grandtotal"  value="" class="text-right form-control input-sm" disabled>
			        			</div>
						      </th>
						    </tr>
						</tfoot>
		        	</table>
        		</div>
        	</div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Submit</button>
          <!-- <a href="" title="Generate Abstract" class="btn btn-primary btn-xs">Submit</a> -->
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Supplier Modal -->
  <div class="modal fade" id="editSupplier" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title">Add Supplier</div>
        </div>
        <form name="update_supplier" method="POST">
        	{{ csrf_field() }}
        	{{ method_field('PATCH') }}
        	<input type="hidden" name="supplier_id2" value="">
        	<input type="hidden" name="abstract_id2" value="{{$abstract->id}}">
        	<input type="hidden" name="abstract_pr2" value="{{$abstract->pr_number}}">
        <div class="modal-body">
        	<div class="row">
        		<div class="col-xs-4">
        			<label style="font-size: 12px;">Supplier Name</label>
        			<input name="supplier_name2" class="form-control input-sm" type="text" value="" required="required">
        		</div>
        		<div class="col-xs-3">
        			<label style="font-size: 12px;">Supplier Address</label>
        			<input name="supplier_address2" class="form-control input-sm" type="text" value="" required="required">
        		</div>
        		<div class="col-xs-3">
        			<label style="font-size: 12px;">Canvasser Name</label>
        			<input name="canv_name2" class="form-control input-sm" type="text" value="" required="required">
        		</div>
        		<div class="col-xs-2">
        			<label style="font-size: 12px;">Department</label> 
	  			 	 <select name="canv_dept2" class="form-control input-sm" type="text">
	  			 	 	<option id="opt1" value="{{$abstract->office}}">{{$abstract->office}}</option>
	  			 	 	<option id="opt2" value="GSO">GSO</option>
	  			 	 </select>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Budget Allocation</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;{{number_format($pr->budget_alloc,2)}}" disabled>
        		</div>
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Estimated Cost</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;{{number_format($pr_item->sum('pr_estimated_cost'),2)}}" disabled>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-12">
        			<fieldset><legend style="font-size: 14px">Supplier Prices</legend>
		        	<table id="edittable" class="table table-condensed table-bordered">
		        		<thead>
		        			<tr class="info">
			        			<th class="col-xs-5">Particulars</th>
			        			<th class="col-xs-1">Qty</th>
			        			<th class="col-xs-1">Unit</th>
			        			<th>Unit Price</th>
			        			<th>Total Price</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<tr></tr>
		        		</tbody>
		        		<tfoot>
						    <tr class="info">
						      <th colspan="4">GRAND TOTAL</th>
						      <th style="padding: 0px;">
								<div class="input-group">
			        				<span class="input-group-addon">&#8369;</span>
			        				<input id="grandtotal2"  value="" class="text-right form-control input-sm" readonly="">
			        			</div>
						      </th>
						    </tr>
						</tfoot>
		        	</table>
        		</div>
        	</div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>


@endsection



@section('script')

<script type="text/javascript">
var getData,multiply, grandTotal, editMultiply , editGrandTotal;
$( document ).ready(function() {
    if($('.someCell').text().length >= 30) {
    // change the font size of it's text
    $('.someCell').css("font-size", "12px");
	}

	 getData = function(e){
		var supplier_id = $('#editSupplierBtn'+e).val();
    	$.get("/abstract/edit/"+supplier_id, function(data, status){
    		console.log(data);
          $( "input[name='supplier_id2']" ).val(data[0]['id']);
          	$( "input[name='supplier_name2']" ).val(data[0]['supplier']);
          	$( "input[name='supplier_address2']" ).val(data[0]['supplier_address']);
          	$( "input[name='canv_name2']" ).val(data[0]['canvasser_name']);
          	
            $('#edittable tbody tr').not(':first').not(':last').remove();
            var html = '';
            for(var i = 0; i < data[1].length; i++){
                html += '<tr>'+
                            '<td><input type="hidden" name="edit_item[]" value="' + data[1][i]['id'] +'">'+ data[1][i]['particulars'] + '</td>' +
                            '<td><input type="text" id="quantity2'+i+'" name="edit_qty[]" class="form-control input-sm"  value="' + data[1][i]['qty'] +' " readonly>' + '</td>' +
                            '<td>' + data[1][i]['unit'] + '</td>' +
                            '<td><input type="text" id="estimatedUnit2'+i+'" name="edit_price[]" class="text-right form-control input-sm"  oninput="editMultiply('+i+');" value="' + data[1][i]['unit_price'] +' ">' + '</td>' +
                            '<td><input id="estimatedCost2'+i+'" name="total_price[]" class="text-right estimated-cost2 form-control input-sm" oninput="editMultiply('+i+');" value="' + data[1][i]['total_price'] + '" disabled></td>' +
                        '</tr>';
                }
            $('#edittable tbody tr').first().after(html);
        });

        $( "form[name='update_supplier']" ).attr("action", "/abstract/supplier/update/"+ supplier_id);
	}

	multiply = function(id)
	{
		var qty = parseFloat(document.getElementById("quantity"+id).value);
		var price_unit=parseFloat(document.getElementById("estimated_unit"+id).value);
		document.getElementById("estimated_cost"+id).value = qty*price_unit;
		grandTotal();		
	}

	grandTotal = function()
	{
		var items = document.getElementsByClassName("estimated_cost");
		var itemCount = items.length;
		var total = 0;
		for(var i = 0; i < itemCount; i++)
		{
			total = total +  parseFloat(items[i].value);
		}
		document.getElementById("grandtotal").value = total;
	}


	editMultiply = function(n)
	{
		
		var qty2 = parseFloat(document.getElementById("quantity2"+n).value);
		var price_unit2=parseFloat(document.getElementById("estimatedUnit2"+n).value);
		document.getElementById("estimatedCost2"+n).value = qty2*price_unit2;

		editGrandTotal();		
	}
	editGrandTotal = function()
	{
		var items2 = document.getElementsByClassName("estimated-cost2");
		var itemCount2 = items2.length;
		var total2 = 0;
		for(var k = 0; k < itemCount2; k++)
		{
			total2 = total2 +  parseFloat(items2[k].value);
		}
		document.getElementById("grandtotal2").value = total2;
	}
});
	
</script>


@endsection


