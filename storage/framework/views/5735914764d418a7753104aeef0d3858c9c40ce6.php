<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading"><b class="panel-title">Edit Inspection Report</b></div>
        <div class="panel-body">
          <form class="form-horizontal" action="<?php echo e(route('ir.update', $ir->id)); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('put')); ?>

            <input type="hidden" name="date" value="<?php echo e($ir->po_date); ?>">
            <input type="hidden" name="pr_number" value="<?php echo e($ir->pr_number); ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('supplier') ? ' has-error' : ''); ?>">
                    <label for="supplier" class="col-md-5 control-label">Supplier</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="supplier" value="<?php echo e(old('supplier', $ir->supplier)); ?>" readonly="" required="">
                        <?php if($errors->has('supplier')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('supplier')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('po_no') ? ' has-error' : ''); ?>">
                    <label for="po_no" class="col-md-5 control-label">PO Number</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="po_no" value="<?php echo e(old('po_no', $ir->po_no)); ?>" readonly="" required="">
                        <?php if($errors->has('po_no')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('po_no')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>               
              <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('requisitioning_office') ? ' has-error' : ''); ?>">
                    <label for="requisitioning_office" class="col-md-5 control-label">Requisitioning Office</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="requisitioning_office" value="<?php echo e(old('requisitioning_office', $ir->requisitioning_office)); ?>" required="">
                        <?php if($errors->has('requisitioning_office')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('requisitioning_office')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('invoice_no') ? ' has-error' : ''); ?>">
                    <label for="invoice_no" class="col-md-5 control-label">Invoice Number</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="invoice_no" value="<?php echo e(old('invoice_no', $ir->invoice_no)); ?>" required="">
                        <?php if($errors->has('invoice_no')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('invoice_no')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                                <div class="form-group <?php echo e($errors->has('property_officer') ? ' has-error' : ''); ?>">
                    <label for="property_officer" class="col-md-5 control-label">Property Officer</label>
                    <div class="col-md-7">
                        <input class="form-control" list="propertyOfficer" name="property_officer" required="" value="<?php echo e($ir->property_officer); ?>">
                          <datalist id="propertyOfficer">
                            <option>Alexander G. Flores</option>
                          </datalist>
                        <?php if($errors->has('property_officer')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('property_officer')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group <?php echo e($errors->has('inspection_officer') ? ' has-error' : ''); ?>">
                    <label for="inspection_officer" class="col-md-5 control-label">Inspection Officer</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="inspection_officer" value="<?php echo e($ir->inspection_officer); ?>" required="">
                        <?php if($errors->has('inspection_officer')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('inspection_officer')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group text-center">
                  <button class="btn btn-warning" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading"><b class="panel-title">Inspection Report</b></div>
        <div class="panel-body">
             <?php echo $dt1->html()->table(['id' => 'dt1','class' => 'table table-condensed table-bordered table-hover'],false); ?>

        </div>
      </div>
    </div>
  </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php echo $dt1->html()->scripts(); ?>


<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>