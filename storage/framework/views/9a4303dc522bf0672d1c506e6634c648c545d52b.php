<?php $__env->startSection('content'); ?>
<?php
	include('../public/php/databaseConnection.php');
?>

<div class="container-fluid">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><b class="panel-title">Abstract of Quotation</b><a href="<?php echo e(route('abstract.view')); ?>" class="back btn btn-danger btn-sm glyphicon glyphicon-arrow-left" title="Back"></a></div>
	  <div class="panel-body">
	  	<table class="table table-condensed borderless-head tbl-custom">
	  		<form id="abstract_form" method="POST" action="<?php echo e(route('abstract.update',$abstract->id)); ?>">
	  		<?php echo e(csrf_field()); ?>

	  		<?php echo e(method_field('PATCH')); ?>

	  		<thead>
	  			<tr>
	  			 	<th><label>Purchase Request #</label> <input class="form-control input-sm" type="text" value="<?php echo e($abstract->pr_number); ?>" disabled></th>
	  			 	<th><label>Procurement Of</label> <input class="form-control input-sm" type="text" value="<?php echo e($abstract->proc_details); ?>" disabled></th>
	  			 	<th><label>Requestor Name</label> <input class="form-control input-sm" type="text" value="<?php echo e($abstract->requestor_name); ?>" disabled></th>
	  			 	<th><label>Requesting Office</label> <input class="form-control input-sm" type="text" value="<?php echo e($abstract->office); ?>" disabled></th>
	  			</tr>
	  			<tr>
	  				<th class="col-xs-2">
	  					<label>Selected Bidder</label>
	  					<select class="form-control input-sm" name="bidder">
	  						<option value="">None</option>
	  						<?php $__currentLoopData = $select_bidder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key01 => $bidder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  						<option value="<?php echo e($bidder->id); ?>" <?php if(!empty($selected_bidder)): ?> <?php if($bidder->id == $selected_bidder->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($bidder->supplier); ?></option>
	  						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  					</select>
	  				</th>
	  			 	<th class="col-xs-3">
	  					<label>Reason</label>
	  					<select class="form-control input-sm" name="reason">	
	  						<option value='0'<?php if($abstract->reason == 0): ?> selected <?php endif; ?>>Lowest and Responsive Price Quotation</option>
	  						<option value='1' <?php if($abstract->reason == 1): ?> selected <?php endif; ?>>Most Responsive Price Quotation</option>
	  					</select>
	  				</th>
	  				<th colspan="2">
	  					<label>Notes on Selected Bidder</label>
	  					<input class="form-control input-sm" name="notes" type="text" value="<?php echo e($abstract->notes); ?>" required="required">
	  				</th>
	  				<th class="text-right">
	  					<button title="Update" class="btn btn-primary btn-sm glyphicon  glyphicon-pencil" 
	  					 	<?php if($query->count() == 0): ?> disabled <?php endif; ?> type="submit">
	  					</button>
	  					<a 
	  					<?php if($as > 0): ?>
	  						href="<?php echo e(route('abstract.print',$abstract->pr_number)); ?>"
	  						target="_blank"
	  					<?php else: ?>
	  						href="#"
	  						disabled
	  					<?php endif; ?>
	  					title="Print" class="btn btn-success btn-sm glyphicon glyphicon-print"></a> 
	  				<?php if($query->count() >= 3): ?>
	  					<button type="button" title="Add Supplier" class="btn btn-sm glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal">
	  					</button>
	  				<?php endif; ?>
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
			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keystone => $supplierid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  		<th colspan="2">
			  			<button type="button" id="editSupplierBtn<?php echo e($keystone); ?>" title="Edit Supplier" data-toggle="modal" data-target="#editSupplier" class="btn btn-warning btn-xs glyphicon glyphicon-pencil" value="<?php echo e($supplierid->id); ?>" onclick="getData(<?php echo $keystone; ?>);"></button>
			  			<?php if($pr->supplier_name != ""): ?>
			  			<?php else: ?>
			  			<a href="<?php echo e(route('supplier.delete',$supplierid->id)); ?>" class="btn btn-danger btn-xs glyphicon glyphicon-minus"></a>
			  			<?php endif; ?>
			  		</th>
			  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  		<!-- if the suppliers is lesser than 3 generate blank -->
					<?php if($query->count() < 3): ?>
						<?php if($pr->supplier_name != ""): ?>
							<?php for($i=$query->count();$i < 1 ;$i++): ?>
								<th colspan="2">
									<button type="button" title="Add Supplier" class="btn btn-xs glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal"></button>
								</th>	
							<?php endfor; ?>
						<?php else: ?>
							<?php for($i=$query->count();$i < 3 ;$i++): ?>
								<th colspan="2">
									<button type="button" title="Add Supplier" class="btn btn-xs glyphicon glyphicon-plus" data-toggle="modal" data-target="#modal"></button>
								</th>	
							<?php endfor; ?>
						<?php endif; ?>
					<?php endif; ?>
			  	</tr>
			  	<tr class="center-t">
			  		

			  		<?php $counter = 0; ?>
			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $suppliername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  		<?php $counter++; ?>
    				<th colspan="2" class="col-xs-2">Supplier <?php echo e($counter); ?></th>		
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					<!-- if the suppliers is lesser than 3 generate blank -->
					<?php if($query->count() < 3): ?>
						<?php for($i=$query->count();$i < 3 ;$i++): ?>
							<th colspan="2" class="col-xs-2">Supplier <?php echo e($i+1); ?></th>	
						<?php endfor; ?>
					<?php endif; ?>

			  	</tr>
			  	<tr>

			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexKey => $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  		<td colspan="2" class="col-xs-2 someCell"><?php echo e($suppliers->supplier); ?></td>
			  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		<?php if($query->count() < 3): ?>
						<?php for($i=$query->count();$i < 3 ;$i++): ?>
							<td colspan="2" class="col-xs-2 someCell">N/A</td>	
						<?php endfor; ?>
					<?php endif; ?>
	
			  	</tr>
			  	<tr class="center-t">
			  		
			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  		<th class="col-xs-1">Price/Unit</th>
			  		<th class="col-xs-1">Price/Item</th>
			  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  		
			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		<?php if($query->count() < 3): ?>
						<?php for($i=$query->count();$i < 3 ;$i++): ?>
							<th class="col-xs-1">Price/Unit</th>
			  				<th class="col-xs-1">Price/Item</th>	
						<?php endfor; ?>
					<?php endif; ?>

			  	</tr>
			  </thead>
			  <tbody>
			  	<?php $__currentLoopData = $abstract_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  	<tr>
			  		<td><?php echo e($items->particulars); ?></td>
			  		<td style="text-align: center;"><?php echo e($items->qty); ?></td>
			  		<td style="text-align: center;"><?php echo e($items->unit); ?></td>
			  		
			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $prices3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
		  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  		
			  		<!-- if the suppliers is lesser than 3 generate blank -->
			  		<?php if($query->count() < 3): ?>
						<?php for($i=$query->count();$i < 3 ;$i++): ?>
							<td style='text-align:right' class="col-xs-1"></td>
			  				<td style='text-align:right' class="col-xs-1"></td>	
						<?php endfor; ?>
					<?php endif; ?>
			  		
			  		
			  	</tr>
			  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </tbody>
			  <tfoot>
			  	<tr style="background-color: #CCC;">
			  		<th style="text-align: right;">TOTAL</th>
			  		<th></th>
			  		<th></th>
			  		<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grand => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  		<th class="col-xs-1"></th>
			  		<th class="col-xs-1" style="text-align: right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;&nbsp;</span>
			  			<?php
			  				$qid = $total->id;
			  				$total_query = mysqli_query($conn,"select SUM(total_price) as value_sum from abstract_price a, abstract_supplier b, abstract_items c WHERE a.supplier_id = b.id and b.id=$qid and a.item_id = c.id");
			  				$data2 = mysqli_fetch_assoc($total_query);
			  				
			  				echo number_format($data2['value_sum'],2);
			  			?>
			  		</th>
			  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  		<?php if($query->count() < 3): ?>
						<?php for($i=$query->count();$i < 3 ;$i++): ?>
							<td style='text-align:right' class="col-xs-1"></td>
			  				<td style='text-align:right' class="col-xs-1"></td>	
						<?php endfor; ?>
					<?php endif; ?>
			  	</tr>
			  </tfoot>
			</table>
			<?php echo e($query->links()); ?>

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
        <form name="new_supplier" action="<?php echo e(Route('abstract.supplier')); ?>" method="POST">
        	<?php echo e(csrf_field()); ?>

        	<input type="hidden" name="abstract_id" value="<?php echo e($abstract->id); ?>">
        	<input type="hidden" name="abstract_pr" value="<?php echo e($abstract->pr_number); ?>">
        <div class="modal-body">
        	<div class="row">
        		<div class="col-xs-4">
        			<label style="font-size: 12px;">Supplier Name</label>
        			<input name="supplier_name" class="form-control input-sm" type="text" 
        			<?php if($pr->supplier_name != ""): ?> value = "<?php echo e($pr->supplier_name); ?>" <?php endif; ?> 
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
	  			 	 	<option value="<?php echo e($abstract->office); ?>"><?php echo e($abstract->office); ?></option>
	  			 	 	<option value="GSO">GSO</option>
	  			 	 </select>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Budget Allocation</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;<?php echo e(number_format($pr->budget_alloc,2)); ?>" disabled>
        		</div>
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Estimated Cost</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;<?php echo e(number_format($pr_item->sum('pr_estimated_cost'),2)); ?>" disabled>
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
		        			<?php $__currentLoopData = $abstract_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexKey => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        			<tr>
		        				<td>
		        					<input type="hidden" name="item[]" value="<?php echo e($list->id); ?>">
		        					<?php echo e($list->particulars); ?>

		        				</td>
			        			<td style="padding: 0px;">
			        				<input type="numeric" id="quantity<?php echo e($indexKey); ?>" name="qty[]" class="form-control input-sm"  value="<?php echo e($list->qty); ?>" readonly>
			        			</td>
			        			<td>
			        				<?php echo e($list->unit); ?>

			        			</td>
			        			<td style="padding: 0px;">
									<input type="numeric" id="estimated_unit<?php echo e($indexKey); ?>" name="unit_price[]" class="text-right form-control input-sm"  oninput="multiply(<?php echo $indexKey; ?>);" value="0">
			        			</td>
			        			<td style="padding: 0px;">
			        				<input id="estimated_cost<?php echo e($indexKey); ?>" name="total_price[]" class="text-right estimated_cost form-control input-sm" oninput="multiply(<?php echo $indexKey; ?>);" value="0" disabled>
			        			</td>
		        			</tr>
		        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        	<?php echo e(csrf_field()); ?>

        	<?php echo e(method_field('PATCH')); ?>

        	<input type="hidden" name="supplier_id2" value="">
        	<input type="hidden" name="abstract_id2" value="<?php echo e($abstract->id); ?>">
        	<input type="hidden" name="abstract_pr2" value="<?php echo e($abstract->pr_number); ?>">
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
	  			 	 	<option id="opt1" value="<?php echo e($abstract->office); ?>"><?php echo e($abstract->office); ?></option>
	  			 	 	<option id="opt2" value="GSO">GSO</option>
	  			 	 </select>
        		</div>
        	</div>
        	<div class="row" style="margin-top: 10px;">
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Budget Allocation</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;<?php echo e(number_format($pr->budget_alloc,2)); ?>" disabled>
        		</div>
        		<div class="col-xs-6">
        			<label style="font-size: 12px;">Estimated Cost</label>
        			<input class="form-control input-sm" type="text" value="&#8369;&nbsp;<?php echo e(number_format($pr_item->sum('pr_estimated_cost'),2)); ?>" disabled>
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


<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

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


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>