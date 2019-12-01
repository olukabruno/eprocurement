<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <!-- Your main wrapper -->


      <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            <!-- registration form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b class="panel-title">Add New Purchase Request</b>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(url('/pr/submit')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" id="pr_status" name="pr_status" value="Pending">
                <input type="hidden" id="pr_created" name="pr_created_by" value="<?php echo e(Auth::User()->id); ?>">
                        <!-- pr_no -->
                        <div class="form-group <?php echo e($errors->has('pr_number') ? ' has-error' : ''); ?>">
                            <label for="pr_number" class="col-md-4 col-xs-8 control-label" >PR Number</label>
                            <div class="col-md-8 col-xs-16">
                            <input type="hidden" name="pr_unique" value=<?php echo e($pr_unique); ?>>
                            <input id="pr_number" type="text" class="form-control" name="pr_number" value="<?php echo e($pr_number); ?>" readonly autofocus>
                                    <?php if($errors->has('pr_number')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_number')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <!-- department -->
                        <div class="form-group <?php echo e($errors->has('pr_department') ? ' has-error' : ''); ?> <?php echo e($errors->has('pr_section') ? ' has-error' : ''); ?>">
                            <label for="pr_department" class="col-md-4 col-xs-8 control-label" >Department</label>
                            <div class="col-md-4 col-xs-8">
                            <input id="pr_department" type="text" class="form-control" name="pr_department" <?php if($user->department == 'ICT'): ?> value="ADM" <?php else: ?> value="<?php echo e($user->department); ?>" <?php endif; ?> readonly required autofocus>
                                    <?php if($errors->has('pr_department')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_department')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-xs-8">
                            <input id="pr_section" type="text" class="form-control" name="pr_section" placeholder="Section" <?php if($user->department == 'ICT'): ?> value="<?php echo e($user->department); ?>" <?php else: ?> value="" <?php endif; ?> readonly required autofocus>
                                    <?php if($errors->has('pr_section')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_section')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <!-- Purpose -->
                        <div class="row form-group <?php echo e($errors->has('pr_purpose') ? ' has-error' : ''); ?>">
                                <label for="pr_purpose" class="col-md-4 col-xs-8 control-label">Purpose</label>
                                <div class="col-md-8 col-xs-16">
                                    <textarea style="resize: none; height: 65px;" id="pr_purpose" class="form-control" name="pr_purpose" value="<?php echo e(old('pr_purpose')); ?>" autofocus></textarea>
                                    <?php if($errors->has('pr_purpose')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_purpose')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                        </div>
                        <!-- Requestor Name -->
                        <div class="row form-group <?php echo e($errors->has('pr_requestor_name') ? ' has-error' : ''); ?>">
                                <label for="pr_requestor_name" class="col-md-4 col-xs-8 control-label">Requestor</label>
                                <div class="col-md-8">
                                    <input id="pr_requestor_name" type="text" class="form-control" placeholder="Name" name="pr_requestor_name" <?php if(empty($requestor)): ?> value="" <?php else: ?> value="<?php echo e($requestor->name); ?>" readonly <?php endif; ?> autofocus>
                                    <?php if($errors->has('pr_requestor_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_requestor_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                        </div>
                        <!-- Requestor Position -->
                        <div class="row form-group <?php echo e($errors->has('pr_requestor_position') ? ' has-error' : ''); ?>">
                                <label for="pr_requestor_position" class="col-md-4 col-xs-8 control-label"></label>
                                <div class="col-md-8">
                                    <input id="pr_requestor_position" type="text" class="form-control" placeholder="Position" name="pr_requestor_position"  <?php if(empty($requestor)): ?> value="" <?php else: ?> value="<?php echo e($requestor->position); ?>" readonly <?php endif; ?> autofocus>
                                    <?php if($errors->has('pr_requestor_position')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_requestor_position')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                        </div>
                        <!-- Supplier/Dist Type -->
                        <div class="row form-group <?php echo e($errors->has('pr_supplier_type') ? ' has-error' : ''); ?>">
                                <label for="pr_supplier_type" class="col-md-4 col-xs-8 control-label">Supplier Type</label>
                                <div class="col-md-8">
                                    <select id="disttype" class="form-control" name="pr_supplier_type" required>
                                        <option value="Canvass">Canvass</option>
                                        <option value="Government Agency">Government Agency</option>
                                        <option value="Sole Distributor">Sole Distributor</option>
                                    </select>
                                    <?php if($errors->has('pr_supplier_type')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_supplier_type')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                        </div>
                        <!-- supplier details -->
                        <div  class="dist row form-group <?php echo e($errors->has('pr_supplier_name') ? ' has-error' : ''); ?>">
                                <label for="pr_supplier_name" id="label-comp" class="col-md-4 col-xs-8 control-label">Supplier Name</label>
                                <div id="supplier_details" class="col-md-8">
                                    <input id="dist-name" type="text" class="form-control" name="pr_supplier_name" autofocus readonly>
                                   
                                    <?php if($errors->has('pr_supplier_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_supplier_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                
                        </div>

                        <div class="row form-group <?php echo e($errors->has('pr_budget_alloc') ? ' has-error' : ''); ?>">
                                <label for="pr_budget_alloc" class="col-md-4 col-xs-8 control-label">PPMP Budget</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                    <input id="pr_budget_alloc" type="text" class="form-control" name="pr_budget_alloc" value="<?php echo e(old('pr_budget_alloc',number_format($ppmp->remaining_budget, 2))); ?>" readonly autofocus>
                                    <span class="input-group-addon">Pesos</span>
                                    </div>
                                    <h5><strong>*Attatch PPMP as proof</strong></h5>
                                    <?php if($errors->has('pr_budget_alloc')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('pr_budget_alloc')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                        </div>


                        <div class="form-group">
                            <div class="col-md-3 col-sm-offset-4"><button type="submit" class="btn btn-primary"
                                <?php if($ppmp->remaining_budget < 1 ): ?>
                                disabled
                                <?php endif; ?>
                                >Register</button></div>
                        </div>
                    </form>
                    </div>
            </div><!--panel-->
            </div><!-- col -->

            <div class="col-md-8">
                <!-- table -->
                        <!-- update edit edelete-->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <b class="panel-title">View Purchase Request</b>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                <?php echo $dataTable->table(['class' => 'table table-condensed table-bordered table-hover'],false); ?>

                        </div>
                    </div>
                </div>
                
            </div>

        </div>
      </div>
    </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<?php echo $dataTable->scripts(); ?>


<script type="text/javascript">
    
    $(document).ready(function() {
      //PR Supplier
         $('#disttype').change(
            function () {
                var method = $('option:selected', this).text();
                if (method == "Canvass")
                {
                    $("#dist-name").prop('readonly', true);
                    $("#dist-name").prop('required', true);
                }else
                {
                    $("#dist-name").prop('readonly', false);
                    $("#dist-name").prop('required', false);
                }
        });

     
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>