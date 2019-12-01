
		<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
		        <strong><?php echo e($message); ?></strong>
		</div>
		<?php endif; ?>


		<?php if($message = Session::get('error')): ?>
		<div class="alert alert-danger alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
		        <strong><?php echo e($message); ?></strong>
		</div>
		<?php endif; ?>


		<?php if($message = Session::get('warning')): ?>
		<div class="alert alert-warning alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
			<strong><?php echo e($message); ?></strong>
		</div>
		<?php endif; ?>


		<?php if($message = Session::get('info')): ?>
		<div class="alert alert-info alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
			<strong><?php echo e($message); ?></strong>
		</div>
		<?php endif; ?>


		<?php if(auth()->guard()->guest()): ?>
		<?php else: ?>
			<?php if($errors->any()): ?>
			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
				Please check the form below for errors
			</div>
			<?php endif; ?>
		<?php endif; ?>

