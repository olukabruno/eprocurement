<!DOCTYPE html>
<html>
<head>
	<title>PPMP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<style type="text/css">
		*{
			font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif; 
			color:#262626;
		}
		[class^="col"] {
		    border: 1px solid #fff;
		}
		hr{margin:0px; border: 1px solid #262626;}
		.content thead  tr th, .content thead  tr td, .content tbody tr td, .content tbody tr th, .content tfoot tr th {
			vertical-align: middle !important;
			text-align: center;
			border: #262626 solid 1px !important;
		}
		.content tbody tr td{
			padding: 1px 1px;
		}
		.well{
			border: 1px solid #262626;
			border-radius: 0 !important;
			padding: 3px;
		}
		.header{
			font-size: 10pt;
			font-weight: bold;
		}
		.total-foot tr th{
			border: #FFF solid 1px !important;
		}
	
	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="row text-center header">
			<div class="col-xs-12">Republic of the Philippines</div>
			<div class="col-xs-12">Province of La Union</div>
			<div class="col-xs-12">City of San Fernando</div>
		</div>
		<div class="row text-center header">
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12">Project Procurement Management Plan</div>
			<div class="col-xs-12">&nbsp;</div>
		</div>

		<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
			<table class="table table-bordered table-condensed content" style="table-layout: fixed;">
				<thead>
					<tr>
						<th rowspan="2" style="width:4%; text-align: center;">CODE</th>
						<th rowspan="2" style="width:27%; text-align: center;">GENERAL DESCRIPITON</th>
						<th rowspan="2" style="word-wrap: break-word;width:5%;text-align: center;">QTY/SIZE</th>
						<th rowspan="2" style="width:5%;text-align: center;">UNIT</th>
						<th rowspan="2" style="width:13%;text-align: center;">ESTIMATED BUDGET</th>
						<th rowspan="2" style="width:10%;text-align: center;">MODE OF PROCUREMENT</th>
						<th colspan="12" style="text-align: center;">SCHEDULE / MILESTONE OF ACTIVITIES </th>
					</tr>
					<tr>
						<?php for($m=1; $m<=12; ++$m): ?>
						<th style="text-align: center;"> <?php echo e(strtoupper(date('M', mktime(0, 0, 0, $m, 1)))); ?> </th>
						<?php endfor; ?>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $collect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<th colspan="18" style="text-align: justify;"><?php echo e(strtoUpper($key)); ?></th>
					</tr>
						<?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemKey => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php $schedule = explode(",", $items['schedule']); ?>
						<tr>
							<td></td>
							<td style="word-wrap: break-word; text-align: left;"><?php echo e($items['description']); ?></td>
							<td style="word-wrap: break-word; text-align: center;"><?php echo e($items['qty']); ?></td>
							<td style="word-wrap: break-word; text-align: center;"><?php echo e($items['unit']); ?></td>
							<td style="text-align: right;"><?php echo e(number_format($items['estimated_budget'],2)); ?></td>
							<td style="text-align: left;"><?php echo e($items['procurement_mode']); ?></td>

							<?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<td>
								<?php if($milestones != 0): ?>
									<?php echo e($milestones); ?>

								<?php endif; ?>
							</td>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php
							$sub_total = $collect->map(function ($row) 
							{
								return $row->sum('estimated_budget');
							});
						?>
						<?php if($loop->last): ?>
						<?php else: ?>
						<tr>
							<td></td>
							<td colspan="3" style="text-align: right;">SUB-TOTAL</td>
							<td style="text-align: right;">
								&#8369;
								<?php if(isset($sub_total) == true): ?>
									<?php echo e(number_format($sub_total[$key], 2)); ?>

								<?php else: ?>
									0.00
								<?php endif; ?>
							</td>
							<?php for($th = 0; $th <= 12 ; $th++): ?>
							<th></th>
							<?php endfor; ?>
						</tr>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
				<tfoot>
					<tr>
						<th style="text-align: right;" colspan="4">TOTAL</th>
						<th style="text-align: right;">
							&#8369;
							<?php
								$st = $sub_total->toArray();
								$count = count($st);
								if(array_key_exists('OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES', $st)){
									$grand_total =  array_sum($st) - $st['OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES'];
								}else{
									$grand_total = array_sum($st);
								}
							?>
							<?php if(isset($sub_total) == true): ?>
								<?php echo e(number_format($grand_total, 2)); ?>

							<?php else: ?>
								0.00
							<?php endif; ?>
						</th>
						<td style="border:1px solid #FFF;" colspan="13"></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<span style="page-break-after:avoid;"></span>
		<div class="row">
			<div class="col-xs-12">
				Note: Technical Specifications for each Item/ Project being proposed shall be submitted as part of the PPMP
			</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-3">
				Prepared by: <br><br><br>
				<div class="col-xs-12 text-center">
					<b><?php echo e(strtoupper($officer->name)); ?></b><br>
					<?php echo e($officer->position); ?>

				</div>
			</div>
			<div class="col-xs-3">
				Noted by: <br><br><br>
				<div class="col-xs-12 text-center">
					<b>ERNESTO V. DATUIN</b><br>
					City Administrator
				</div>
			</div>
		</div>
	</div>
</body>
</html>