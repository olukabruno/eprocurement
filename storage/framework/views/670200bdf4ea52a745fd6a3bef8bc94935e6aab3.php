<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">View All Available PR</b></div>
        <div class="panel-body">
          <?php echo $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false); ?>

        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Request for Quotation</b></div>
        <div class="panel-body">
          <?php echo $dt2->html()->table(['id' => 'dt2','class' => 'table table-condensed table-bordered table-hover'],false); ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $dt1->html()->scripts(); ?>

<?php echo $dt2->html()->scripts(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>