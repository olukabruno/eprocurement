<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<?php if(\Session::has('error')): ?>
	<div class="alert alert-danger">
	<?php echo e(\Session::get('error')); ?>

</div>
<?php endif; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b class="panel-title">Welcome <?php echo e(Auth::user()->wholename); ?>!</b>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>