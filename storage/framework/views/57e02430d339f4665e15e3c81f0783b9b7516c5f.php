<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center"><img src="<?php echo e(asset('images/sfclogo.png')); ?>" alt="img"></div>
                    <div class="text-center"><h4>Planning-Procurement System</h4></div>
                </div>
                <div class="panel-body">
                    <form  method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="col-md-12 form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-12 input-sm control-label">Username</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="input-sm form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12 form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-12 input-sm control-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="input-sm form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="col-md-6 checkbox">
                                <label>
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                </label>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                

                                <a class="btn btn-link" href="<?php echo e(route('resetpword')); ?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            &copy; 2018 City of San Fernando, La Union<br>
                            ICT Section<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>