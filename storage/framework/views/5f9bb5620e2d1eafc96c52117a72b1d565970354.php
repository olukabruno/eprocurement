<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">View All Available PR</b></div>
        <div class="panel-body">
          <?php echo $dt2->html()->table(['id' => 'dt2','class' => 'table table-condensed table-bordered table-hover'],false); ?>

        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Abstract of Quotation</b></div>
        <div class="panel-body">
          <?php echo $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false); ?>

        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title">Specify Procurement</div>
        </div>
        <div class="modal-body">
          <form id="generate_supp" class="form-horizontal" method="POST" action="">
            <?php echo e(csrf_field()); ?>

            <label>Procurement Of:</label><input class="form-control imput-sm" name="proc_details" required>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-sm">Submit</button>
          <!-- <a href="" title="Generate Abstract" class="btn btn-primary btn-xs">Submit</a> -->
        </div>
        </form>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $dt2->html()->scripts(); ?>

<?php echo $dt1->html()->scripts(); ?>


<script type="text/javascript">
  var table = $('#dt2').DataTable();
  $('#dt2 tbody').on( 'click', 'tr', function () {
      var data = table.row( this ).data();
      $("#generate_supp").attr("action", "/abstract/generate/"+data['id']);
  } );
</script>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>