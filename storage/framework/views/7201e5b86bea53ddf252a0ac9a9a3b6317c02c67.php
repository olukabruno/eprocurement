<div class="row">
					
					<div class="col-md-12">
						<div class="table-responsive">
						<table class="table table-bordered table-hover table-condensed" style="table-layout: fixed;">
							<thead>
								<tr>
									<th rowspan="2" style="word-wrap: break-word; width: 6%;text-align: center;">Code</th>
									<th rowspan="2" style="word-wrap: break-word;width: 40%;text-align: center;">General Description</th>
									<th rowspan="2" style="word-wrap: break-word;width: 5%;text-align: center;">Qty/Size</th>
									<th rowspan="2" style="word-wrap: break-word;width: 10%;text-align: center;">Unit</th>
									<th rowspan="2" style="word-wrap: break-word;width: 15%;text-align: center;">Estimated Budget</th>
									<th rowspan="2"  style="word-wrap: break-word;width: 10%;text-align: center;">Stock</th>
									<th rowspan="2" style="word-wrap: break-word;width: 15%;text-align: center;">Mode Of Procurement</th>
									<th colspan="12" style="word-wrap: break-word;width: 50%;text-align: center;">Schedule/Milestone of Activities</th>
									
									<th style="width: 10%;text-align: center;">
										<?php if($grouped->count() > 0): ?>
										<a href="<?php echo e(route('ppmp.print',$ppmp_id)); ?>" target="_blank" class="btn btn-success btn-xs glyphicon glyphicon-print"></a>
										<?php endif; ?>
									</th>
									
								</tr>
								<tr>
									<?php for($m=1; $m<=12; ++$m): ?>
									   <th style="width: 1%;text-align: center;"> <?php echo e(strtoupper(date('M', mktime(0, 0, 0, $m, 1)))); ?> </th>
									<?php endfor; ?>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($grouped->count() < 1): ?>
									<tr>
										<td colspan = "20" style="text-align: center;">No data available in table</td>
									</tr>
								<?php endif; ?>
								<?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<th colspan="20" class="info"><?php echo e(strtoUpper($key)); ?></th>
								</tr>
									<?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php $schedule = explode(",", $items['schedule']); ?>
										<tr>
											<td></td>
											<td style="word-wrap: break-word; text-align: left;"><?php echo e($items['description']); ?></td>
											<td style="word-wrap: break-word; text-align: center;"><?php echo e($items['qty']); ?></td>
											<td style="word-wrap: break-word; text-align: center;"><?php echo e($items['unit']); ?></td>
											
											<td style="text-align: right;"><?php echo e(number_format($items['estimated_budget'],2)); ?></td>
											<td style="word-wrap: break-word; text-align: center;"><?php echo e($items['inventory']); ?></td>
											<td style="text-align: left;"><?php echo e($items['procurement_mode']); ?></td>
											<?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td style="text-align: center;">
												<?php if($milestones != 0): ?>
													<?php echo e($milestones); ?>

												<?php endif; ?>
											</td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
											<td style="text-align: center;"><a title="edit" href="<?php echo e(route('ppmpi.edit', [$ppmp_id , $items['id']])); ?>" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>&nbsp;<a href="<?php echo e(route('ppmpi.delete', [$ppmp_id , $items['id']])); ?>" title="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus"></a></td>
								
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php
									$sub_total = $grouped->map(function ($row) 
									{
										return $row->sum('estimated_budget');
									});
									
									
								?>
								<?php if($loop->last): ?>
								<?php else: ?>
								<tr class="warning">
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
										<?php for($th = 0; $th <= 13 ; $th++): ?>
										<th></th>
										<?php endfor; ?>
									</tr>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
							<?php if($grouped->count() > 0): ?>
							<tfoot>
								<tr class="success">
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
									<?php for($ftr = 0; $ftr <= 13 ; $ftr++): ?>
									<th></th>
									<?php endfor; ?>
								</tr>
							</tfoot>
							<?php endif; ?>
						</table>
						</div>
					</div>
				</div>