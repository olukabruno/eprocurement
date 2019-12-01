<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <!-- Your main wrapper -->
 

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
            <!-- registration form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Unit</h3>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('unit.add')); ?>">
                <?php echo e(csrf_field()); ?>


                        <!-- iso_code -->
                        <div class="form-group<?php echo e($errors->has('iso_code') ? ' has-error' : ''); ?>">
                            <label for="iso_code" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 control-label">ISO Code</label>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-14">
                                <input id="iso_code" type="text" class="form-control" name="iso_code" value="<?php echo e(old('iso_code')); ?>" autofocus>
                                <?php if($errors->has('iso_code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('iso_code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
        
                        <!-- iso_name -->
                        <div class="form-group<?php echo e($errors->has('iso_name') ? ' has-error' : ''); ?>">
                            <label for="iso_name" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label">Unit Name</label>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-14">
                                <input id="iso_name" type="text" class="form-control" name="iso_name" value="<?php echo e(old('iso_name')); ?>" autofocus>
                                <?php if($errors->has('iso_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('iso_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- iso_description -->
                        <div class="form-group<?php echo e($errors->has('iso_description') ? ' has-error' : ''); ?>">
                            <label for="iso_description" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 control-label">Description</label>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-14">
                                <input id="iso_description" type="text" class="form-control" name="iso_description" value="<?php echo e(old('iso_description')); ?>" autofocus>
                                <?php if($errors->has('iso_description')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('iso_description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-sm-offset-5"><button type="submit" class="btn btn-primary">Register</button></div>
                        </div>
                    </form>
                    </div>
            </div><!--panel-->
            </div><!-- col -->

                    <!--table-->
        <div class="container-fluid col-xs-8 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Units</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                         <?php echo $dataTable->table(['class' => 'table table-condensed table-bordered table-hover table-responsive'],false); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- end table -->

        

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $dataTable->scripts(); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>