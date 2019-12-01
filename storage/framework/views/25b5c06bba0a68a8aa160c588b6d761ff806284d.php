<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <!-- Your main wrapper -->
  <div class="panel panel-default">
    <div class="panel-title">
        <ul class="nav nav-tabs">
            <li <?php if(\Route::current()->getName() == 'rbd'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('rbd')); ?>"  aria-expanded="false" aria-haspopup="true" v-pre>Requestor by Department</a>
            </li>
            <li <?php if(\Route::current()->getName() == 'aa'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('aa')); ?>" aria-expanded="false" aria-haspopup="true" v-pre>Appropriation Available</a>
            </li>
            <li <?php if(\Route::current()->getName() == 'cash'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('cash')); ?>"  aria-expanded="false" aria-haspopup="true" v-pre>Cash Availability</a>
            </li>
            <li <?php if(\Route::current()->getName() == 'pra'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('pra')); ?>"  aria-expanded="false" aria-haspopup="true" v-pre>PR Approval</a>
            </li>
        </ul>
    </div>
    <div class="tab-content panel-body">
      <div class="panel-group">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
            <!-- registration form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Signatory</h3>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(url('/registersignatory')); ?>">
                <?php echo e(csrf_field()); ?>

                    <!-- hidden inputs -->
                    <input type="hidden" id="hidden-val" name="hidden-val" value="<?php echo e($hidden_val); ?>">
                    <input type="hidden" name="status" value='0'>
                        <!-- department -->
                        <div class="form-group<?php echo e($errors->has('department') ? ' has-error' : ''); ?>">
                            <label for="department" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label" >Department</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <select id="department" type="text" class="form-control" name="department" required autofocus>
                                    <option>Choose Department</option>
                                    <?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($dept->iso_code); ?>'><?php echo e($dept->office_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                                </select>
                            <?php if($errors->has('department')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('department')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>
                        </div>
                        <!-- name -->
                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label">Name</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- position -->
                        <div class="form-group<?php echo e($errors->has('position') ? ' has-error' : ''); ?>">
                            <label for="position" class="col-lg-3 col-md-3 col-sm-3 col-xs-6 control-label">Position</label>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                                <input id="position" type="text" class="form-control" name="position" value="<?php echo e(old('position')); ?>" required autofocus>
                                <?php if($errors->has('position')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('position')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-sm-offset-3"><button type="submit" class="btn btn-primary">Register</button></div>
                        </div>
                    </form>
                    </div>
            </div><!--panel-->
            </div><!-- col -->

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-16">
                <!-- table -->
                <?php echo $__env->make('signatory.signatories-table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
         ajax: {
            url: <?php if(\Route::current()->getName() == 'aa'): ?> "<?php echo e(route('data.aa')); ?>" <?php elseif(\Route::current()->getName() == 'cash'): ?>"<?php echo e(route('data.c')); ?>" <?php elseif(\Route::current()->getName() == 'pra'): ?> "<?php echo e(route('data.a')); ?>" <?php else: ?> "<?php echo e(route('data.r')); ?>" <?php endif; ?>,
        },

        columns: [
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {data: 'dept', name: 'dept'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>