<?php $__env->startSection('content'); ?>

<div class="container-fluid">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <b class="panel-title">Supplemental PR Items</b>
   <a class="back btn btn-sm btn-danger glyphicon glyphicon-arrow-left" href="<?php echo e(route('supplemental')); ?>"></a></div>
  <div class="panel-body">
<table class="table table-condensed borderless-head">
  <thead>
  <tr>
    <th><label>Supplemental PR #</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($query->pr_form_no); ?>" disabled></th>
    <th><label>Department:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($query->department); ?>" disabled></th>
    <th><label>Section:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($query->section); ?>" disabled></th>
    <th><label>Requestor Name:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->requestor_name); ?>" disabled></th>
    <th><label>Requestor Position:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->requestor_position); ?>" disabled></th>
  </tr>
  <tr>
    <th><label>Purpose:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->purpose); ?>" disabled></th>
    <th><label>Supplier Type:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->supplier_type); ?>" disabled></th>
    <th><label>Supplier Name:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->supplier_name); ?>" disabled></th>
    <th><label>Supplier Address:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($pr[0]->supplier_address); ?>" disabled></th>
    <th><label>Previous PR Number:</label> <input class="custom-border form-control input-sm" type="text" value="<?php echo e($query->prev_pr); ?>" disabled></th>
  </tr>
  <tr>
    <th>
      <a class="btn btn- btn-sm btn-primary glyphicon glyphicon-print" <?php if($list->count() < 1): ?> href="#" disabled <?php else: ?> href="<?php echo e(route('pr.print',$query->pr_form_no)); ?>" target="_blank" <?php endif; ?>></a>
    </th>
  </tr>
</thead>
</table>






<table class="table table-condensed table-bordered">

  <thead>
    <tr class="info">
      <th class="col-xs-1">Item #</th>
      <th class="col-xs-1">Qty.</th>
      <th class="col-xs-2">Unit</th>
      <th class="col-xs-3">Description</th>
      <th class="col-xs-2">Cost per Unit</th>
      <th class="col-xs-2">Cost per Item</th>
      <th class="col-xs-2">Action</th>
    </tr>
  </thead>
  <thead>
    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/pr/items/add/')); ?>" autocomplete="off" >
    <?php echo e(csrf_field()); ?>

        <tr>                            
          <th>
            <input type="hidden" value="<?php echo e($query->pr_form_no); ?>" name="prid" id="prid">
            <input type="hidden" value="<?php echo e($query->id); ?>" name="id_rel" id="id_rel">
            <input type="hidden" id="ppmpItemId" name="ppmp_item_id" value="">
            <?php echo e($count); ?>

          </th> 
          <th>
            <select class="form-control custom-border" name="itemqty" id="itemqty" onchange="multiply();">
              
            </select>
          </th>
          <th>
            <input value="" class="form-control custom-border" id="itemUnit" name="itemunit" readonly>
          </th>
          <th>
            <select class="form-control custom-border" name="itemdescription" id="itemdescription">
              <option value="" selected>Select Item</option>
              <?php $__currentLoopData = $query->ppmp->ppmpItems->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($items->id); ?>"><?php echo e($items->description); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select> 
          </th> 
          <th>
            <input type="text" class="form-control custom-border money-inp" name="itemcpu" id="itemcpu" value="0.00" oninput="multiply();">
          </th>
          <th>
            <input type="text" class="form-control custom-border money-inp" id="itemcpi" value="0.00" disabled>
          </th> 
          <th class="text-center">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-plus"></button>
          </th>
        </tr>
    </form>
  </thead>
<tbody>

<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexKey => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/update_items',$list->id)); ?>" autocomplete="off" >
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('PATCH')); ?>

    <input type="hidden" value="<?php echo e($list->pr_form_number); ?>" name='prlist' id='prlist'>
  <tr>
    <th>
      
    </th>
    <td>
      <input type="text" class="form-control custom-border input-sm" value="<?php echo e($list->pr_qty); ?>" name="qtylist" id="qtylist" >
    </td> 
    <td>
      <select class="form-control custom-border input-sm" name="unitlist" id="unitlist">
          <?php if($loop->parent): ?>
            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value='<?php echo e($unit->iso_code); ?>' title='<?php echo e($unit->iso_description); ?>' <?php if($unit->iso_code == $list->pr_unit): ?> selected <?php endif; ?>>
                        <?php echo e($unit->iso_name); ?>

                      </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>       
      </select>
    </td>
    <td>
            <select class="form-control input-sm custom-border" name="descriptionlist" id="descriptionlist">
              <option value="" selected>Select Item</option>
              <?php $__currentLoopData = $query->ppmp->ppmpItems->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($items->id); ?>"
                  <?php if($items->id == $list->pr_description): ?>
                  selected
                  <?php endif; ?>
                ><?php echo e($items->description); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
    </td> 
    <td>
      <input type="text" class="form-control custom-border input-sm money-inp" value="<?php echo e(number_format($list->pr_cost_per_unit)); ?>" name="cpulist" id="cpulist">
    </td>
    <td>
      <input type="text" class="form-control custom-border input-sm money-inp" value="<?php echo e(number_format($list->pr_estimated_cost)); ?>" disabled>
    </td> 
                           
    <td class="text-center">
      <button type="submit" class="btn btn-warning btn-xs glyphicon glyphicon-pencil"></button>
      <a class="btn btn-danger btn-xs glyphicon glyphicon-minus" href="<?php echo e(route('pr.items.delete',$list->id)); ?>"></a>
    </td>
    </tr>
    </form> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>

<tfoot>
    <tr class="info">
      <th colspan="5" class="money-inp">GRAND TOTAL</th>
      <th>
        <input class="table-form form-control input-sm money-inp" value="<?php echo e(number_format($grand_total,2)); ?>" type="text" disabled>
      </th>
    </tr>
</tfoot>
  
</table>


</div>

    
</div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  function multiply(){
    var total1=parseFloat($('#itemqty').val())*parseFloat($('#itemcpu').val());
    $("#itemcpi").val(total1);
  }

  $('table tbody tr').each(function(idx){
      $(this).children(":eq(0)").html(idx + 1);
  });

  $.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });
   
    $('select[name="itemdescription"]').on('change', function(e){
        var prItem_id = e.target.value;
        $("#ppmpItemId").val(prItem_id);
      //ajax
      $.get('/pr/items/get/' + prItem_id, function(data){
          var item_details = $.parseJSON(data);
          console.log(item_details);
          $("#itemUnit").val(item_details.unit);
          $('#itemqty').empty();
          for (var i = 1; i <= item_details.inventory; i++) {
            $('#itemqty').append('<option value ="'+ i +'">'+ i +'</option>');
          }
          $('#itemcpu').on('change', function(e){
            var unit_cost = e.target.value;
            if (parseFloat(unit_cost) > parseFloat(item_details.remaining_budget)) {
              alert('The cost is way beyond estimates!');
              $('#itemcpu').val(0.00);
              $('#itemcpi').val(0.00);
            }
          });
       }); 
    });

</script>

<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>