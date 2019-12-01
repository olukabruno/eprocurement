<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b class="panel-title">Add New PPMP</b>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="<?php echo e(route('ppmp.store')); ?>" method="post" onsubmit="return dt(event)">
						<?php echo e(csrf_field()); ?>

						<div class="form-group <?php echo e($errors->has('year') ? ' has-error' : ''); ?>">
							<label for="year" class="col-xs-4 control-label">Select Year:</label>
							<div class="col-xs-6">
								<input type="text" class="form-control" name="year">
								<?php if($errors->has('year')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('year')); ?></strong>
                                </span>
                            	<?php endif; ?>
							</div>
							<div class="col-xs-2">
								<button type="submit" class="btn btn-success glyphicon glyphicon-plus"></button>
							</div>
						</div>
					</form>
					<?php echo $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false); ?>

				</div>
			</div>
		</div>
	</div>
</div>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $dt1->html()->scripts(); ?>


<script type="text/javascript">
function dt(e){
	// e.preventDefault();
	if ($('input[name="year"]').val() < 1998) {
		alert('Invalid Year');
		return false;
	}
		return true;
	
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>