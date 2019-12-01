<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- registration form -->
        <div class="col-xs-5 col-md-5">
            
            <div class="panel panel-default">
                <div class="panel-heading">Distributor Details</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo e(route('soledistreg')); ?>">
                        <?php echo e(csrf_field()); ?>

                        
                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name/Company</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>" required autofocus>

                                <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('certificate') ? ' has-error' : ''); ?>">
                            <label for="certificate" class="col-md-4 control-label">Certificate of Sole Distributor</label>

                            <div class="col-md-6">
                                <input id="certificate" type="file" class="form-control" name="certificate"  accept="application/pdf" required autofocus>

                                <?php if($errors->has('certificate')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('certificate')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>

        <!--table-->
        <div class="container-fluid col-xs-7 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Distributors</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                                <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="col-xs-3"><?php echo e($record->name); ?></td>
                                    <td class="col-xs-3"><?php echo e($record->address); ?></td>
                                    <td class="col-xs-1">
                                       
                                        <a class="btn btn-info btn-xs" href="<?php echo e(asset('storage/'.$record->file_name)); ?>" target="_blank" title="View Certificate"><span class="glyphicon glyphicon-file"></span></a>
                                        <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('soledist/delete/'.$record->id)); ?>" title="Delete" onclick="return confirm('WARNING.'+'\n'+'Deleting sole distributor. Continue?');"><span class="glyphicon glyphicon-minus"></span></a>
                                    </td>
                                       
                                    </td> 
                                </tr>
                             
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                 <tr >
                                    <td colspan="2">
                                    NO RESULTS FOUND
                                    <td>
                                 </tr>
                                <?php endif; ?>
                                 

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end table -->

    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>