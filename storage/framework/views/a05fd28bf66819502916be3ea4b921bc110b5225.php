<?php $__env->startSection('content'); ?>
<style type="text/css">
	[class^="col"] {padding-bottom:0px;margin-bottom: 1px;}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b class="panel-title">Add Items</b><a href="<?php echo e(route('ppmp.index')); ?>" class="back btn btn-danger btn-sm glyphicon glyphicon-arrow-left"></a>
				</div>
				<div class="panel-body">
				<div class="row">
				<form action="<?php echo e(route('ppmp.items', $ppmp_id)); ?>" method="post" >
				<?php echo e(csrf_field()); ?>

					<div class="col-md-6 clearfix">
						<div class="col-md-12 form-group <?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">Code:</label>
							<div class="col-md-12">
							<input class="form-control input-sm" list="groups" name="code">
							<datalist id="groups">
								<?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $codes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option><?php echo e($groupName); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if(isset($groupName) == TRUE): ?>
									<?php if($groupName == 'OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES'): ?>)
									<?php else: ?>
									<option>OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES</option>
									<?php endif; ?>
								<?php endif; ?>
								
							</datalist>
							<?php if($errors->has('code')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('code')); ?></strong>
                                </span>
                            <?php endif; ?>
							</div>
						</div>
						<div class="col-md-12 form-group <?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">General Description:</label>
							<div class="col-md-12">
							<textarea name="description" class="form-control input-sm" style="resize: none;" rows="3"autofocus><?php echo e(old('description')); ?></textarea>
							<?php if($errors->has('description')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('description')); ?></strong>
                                </span>
                            <?php endif; ?>
							</div>
						</div>
						<div class="col-md-6 form-group <?php echo e($errors->has('quantity') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">Quantity:</label>
							<div class="col-md-12">
							<input value="<?php echo e(old('quantity')); ?>" type="text" name="quantity" class="form-control input-sm" autofocus>
							<?php if($errors->has('quantity')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('quantity')); ?></strong>
                                </span>
                            <?php endif; ?>
                        	</div>
						</div><br><br>	
						<div class="col-md-6 form-group <?php echo e($errors->has('unit') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">Unit:</label>
							<div class="col-md-12">
							<input class="form-control input-sm" list="units" name="unit">
							<datalist id="units">
								<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php echo e(old('unit') == $unit->iso_code ? 'selected' : ''); ?> value="<?php echo e($unit->iso_code); ?>"><?php echo e($unit->iso_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</datalist>
							
							<?php if($errors->has('unit')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('unit')); ?></strong>
                                </span>
                            <?php endif; ?>
                            </div>
						</div>
						<div class="col-md-6 form-group <?php echo e($errors->has('estimated_budget') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">Estimated Budget:</label>
							<div class="col-sm-12">
							<input value="<?php echo e(old('estimated_budget')); ?>" type="text" name="estimated_budget" class="form-control input-sm" autofocus>
							<?php if($errors->has('estimated_budget')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('estimated_budget')); ?></strong>
                                </span>
                            <?php endif; ?>
							</div>
						</div>
						<div class="col-md-6 form-group <?php echo e($errors->has('mode') ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label">Mode of Procurement:</label>
							<div class="col-sm-12">
							<input class="form-control input-sm" list="modes" name="mode">
							<datalist id="modes">
								<option>Public Bidding</option>
								<option>Limited Source Bidding</option>
								<option>Direct Contracting</option>
								<option>Repeat Order</option>
								<option>Shopping</option>
								<option>Negotiated Procurement</option>
								<option>Small Value</option>
                            	<option>Agency-To-Agency</option>
							</datalist>
							<?php if($errors->has('mode')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('mode')); ?></strong>
                                </span>
                            <?php endif; ?>
							</div>
						</div>
						<div class="col-md-12 text-right" style="margin-top: 10px;">
							<div class="col-md-12"><button type="submit" class="btn btn-sm btn-primary">Submit</button></div>	
						</div>
					</div>

					
					
					<div class="col-md-6 clearfix">
						<b>Schedule/Milestone of Activities</b>
                        <hr style="margin: 0px 0px 10px 0px;">

                        <?php for($s=1; $s<=12; $s++): ?>
                        <?php $month_num = $s-1; ?>
						<div class="col-md-4 form-group <?php echo e($errors->has('schedule.'.$month_num) ? ' has-error' : ''); ?>">
							<label class="col-md-12 input-sm control-label"><?php echo e(strtoupper(date('M', mktime(0, 0, 0, $s, 1)))); ?></label>
							<div class="col-md-12">
								<input value="<?php echo e(old('schedule.'.$month_num,0)); ?>" name="schedule[<?php echo e($month_num); ?>]" id="sched1" class="form-control input-sm" autofocus  >
								<?php if($errors->has('schedule.'.$month_num)): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('schedule.'.$month_num)); ?></strong>
                                </span>
                        		<?php endif; ?>
                            </div>
						</div>
						<?php endfor; ?>
						
					</div>
				</form>
				
					
				</div>
				<br>
				<?php echo $__env->make('PPMP.PpmpItemTable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div> 
			</div>
		</div>
	</div>
	<div class="row">
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>