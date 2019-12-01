<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- registration form -->
        <div class="col-xs-5 col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>

                <div class="panel-body">

                    <form class="form-horizontal px-3" method="POST" action="<?php echo e(url('/info')); ?>">

                        <?php echo e(csrf_field()); ?>


                          <div class="row">

                            <div class="col-md-6 <?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control mb-3" name="first_name" value="<?php echo e(old('first_name')); ?>" autofocus>
                            <?php if($errors->has('first_name')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('first_name')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                            <div class="col-md-6 <?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control mb-3" name="last_name" value="<?php echo e(old('last_name')); ?>">
                            <?php if($errors->has('last_name')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('last_name')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control mb-3" name="email" value="<?php echo e(old('email')); ?>">
                            <?php if($errors->has('email')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                            <div class="col-md-6 <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                            <label for="email">Phone</label>
                            <input id="phone" type="text" class="form-control mb-3" name="phone" value="<?php echo e(old('phone')); ?>">
                            <?php if($errors->has('phone')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('phone')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                            <div class="col-md-6 <?php echo e($errors->has('department') ? ' has-error' : ''); ?>">
                            <label for="department">Department</label>
                            <select name="department" value="<?php echo e(old('department')); ?>" onchange="showDiv(this)" class="form-control mb-3" required autofocus>
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

                          <div class="row">

                            <div class="col-md-6 <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control mb-3" name="username" value="<?php echo e(old('username')); ?>">
                            <?php if($errors->has('username')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('username')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password">Password</label>
                            <input id="password" type="text" class="form-control mb-3" name="password" value="<?php echo e(old('password')); ?>">
                            <?php if($errors->has('password')): ?>
                            <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                            <?php endif; ?>
                            </div>

                            <div class="col-md-6 <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="password-password-confirmation">Password Comfirmation</label>
                                <input id="password_confirmation" type="password" class="form-control mb-3" name="password_confirmation" required>
                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-6 <?php echo e($errors->has('userlvl') ? ' has-error' : ''); ?>">
                              <label for="role">User Level</label>
                              <select id="role" type="text" class="form-control" name="role" required autofocus>
                              <option value="0">Select role</option>
                              <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value='<?php echo e($role->id); ?>'><?php echo e($role->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <?php if($errors->has('role')): ?>
                              <span class="help-block">
                              <strong><?php echo e($errors->first('role')); ?></strong>
                              </span>
                              <?php endif; ?>
                            </div>

                          </div>



                        <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>


        <!-- update edit edelete-->
        <div class="container-fluid col-xs-7 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Records </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <?php echo $dataTable->table(['class' => 'table table-striped table-condensed table-bordered table-hover'],false); ?>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<!-- view all records -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<?php echo $dataTable->scripts(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>