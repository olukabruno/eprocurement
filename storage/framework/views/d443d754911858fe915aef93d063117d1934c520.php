<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="row">
		 <div class="col-md-12">
                <!-- table -->
                        <!-- update edit edelete-->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <b class="panel-title">Archived Purchase Requests</b>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-condensed" id="datatable">
                                <thead>
                                    <tr>
                                        <th>PR Form Number</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $prDT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($pr->pr_form_no); ?></td>
                                        <td><?php echo e($pr->purpose); ?></td>
                                        <td><?php echo e($pr->status); ?></td>
                                        <td><?php echo e(Carbon\Carbon::parse($pr->created_at)->format('m-d-y')); ?></td>
                                        <td>
                                            <a href='<?php echo e(route("pr.closeitems", $pr->id)); ?>' id="items" class="btn btn-primary btn-xs" title="Items"><span class="glyphicon glyphicon-th-list"></span></a>
                                           <?php if($pr->status != 'Cancelled'): ?>
                                           <a href='<?php echo e(route("pr.delete", $pr->id)); ?>' id="cancel_pr" class="btn btn-danger btn-xs" title="Cancel Form"><span class="glyphicon glyphicon-remove"></span></a>
                                           <?php endif; ?>
                                           <?php if(Auth::user()->role == 1): ?>
                                           <a href='<?php echo e(route("pr.revert", $pr->id)); ?>' id="reset_pr" class="btn btn-info btn-xs" title="Master Reset Purchase Request Status"><span class="glyphicon glyphicon glyphicon-repeat"></span></a>  
                                           <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
       
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>