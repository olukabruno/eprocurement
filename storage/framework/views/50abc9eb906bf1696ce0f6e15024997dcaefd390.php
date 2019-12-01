<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
  <style type="text/css">
    *{color:#262626;}

    /*[class^="col"] {border: 1px solid #fff;}*/

    /*#logosfc{margin-top: 5px;}*/

    .well{
      border:solid #262626;
      border-radius: 0 !important;
      margin-top: 15px;
      background: #262626 !important;
      color: #fff !important;
      padding: 5px;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
    }
    .header-pr div{font-size: 16px;font-weight: bold;}

    .header-pr .heading2{
      font-size: 18px !important;
      background: #262626 !important;
      color: #fff !important;
      text-align: center;
      font-weight: bold;
      border:1px solid #262626;
    }
    .heading-sm{
      background: #262626 !important;
      color: #fff !important;
      font-weight: bold;
    }
    .content thead  tr th, .content thead  tr td, .content tbody tr td, .content tfoot tr th {
      vertical-align: middle !important;
      text-align: center;
      border: #262626 solid 1px !important;
      font-size: 14px;
    }
    .content tbody tr td{
      padding: 1px 1px;
    }
    .content thead  tr th{
      background:#262626;
      color: #fff;
    }

    hr{margin:0px; border: 1px solid #262626;}

    .head-label{margin-top: 1px;padding: 0px;}

    .topped{margin-top:1px;}
    .topped-border{border:1px solid #262626;}
    .f-12-px{font-size: 12px;}

  </style>
</head>
<body>
<?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="container-fluid">
  <!-- start of header -->
  <div class="row">
    <div class="col-xs-3">
    </div>
    <div class="col-xs-6">
      <div class="col-xs-2 text-right">
        <img id="logosfc" src="<?php echo e(asset('images/sfclogo.png')); ?>" width="60px" height="60px">
      </div>
            <div class="col-xs-8 text-center">
              <div class="row header-pr">
                <div class="col-xs-12">REPUBLIC OF THE PHILIPPINES</div>
                <div class="col-xs-12">PROVINCE OF LA UNION</div>
                <div class="col-xs-12">CITY OF SAN FERNANDO</div>
              </div>
            </div>
            <div class="col-xs-2">
              <div class="well">PO</div>
            </div>
    </div>
    <div class="col-xs-3">
    </div>
  </div>

  <div class="row header-pr" style="border:1px solid #262626;">
    <div class="col-xs-12 heading2">PURCHASE ORDER</div>
  </div>

  <div class="row topped topped-border">
    <div class="col-xs-12 text-center">
      <span style="font-size: 18px;">LGU-CSF</span>
      <hr>
      <span style="font-size: 16px;">Agency</span>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 topped-border">
      <div class="col-xs-12">&nbsp;</div>
      <div class="col-xs-2">Supplier:</div>
      <div class="col-xs-10"><?php echo e($purchase_order->supplier); ?><hr></div>
      <div class="col-xs-2">Address:</div>
      <div class="col-xs-10"><?php if($purchase_order->tin == ""): ?>&nbsp;<?php endif; ?><?php echo e($purchase_order->supplier_address); ?><hr></div>
      <div class="col-xs-2">TIN:</div>
      <div class="col-xs-10"><?php if($purchase_order->tin == ""): ?>&nbsp;<?php endif; ?><?php echo e($purchase_order->tin); ?><hr></div>
      <div class="col-xs-12">&nbsp;</div>
    </div>
    <div class="col-xs-6 topped-border">
      <div class="col-xs-12">&nbsp;</div>
      <div class="col-xs-4">PO No:</div>
      <div class="col-xs-8"><?php echo e($purchase_order->id); ?><hr></div>
      <div class="col-xs-4">Date:</div>
      <div class="col-xs-8"><?php echo e($dt->Format('F j, Y')); ?><hr></div>
      <div class="col-xs-4">Mode of Procurement:</div>
      <div class="col-xs-8"><?php echo e($purchase_order->mode_of_procurement); ?><hr></div>
      <div class="col-xs-12">&nbsp;</div>
    </div>
  </div>
  <div class="row topped-border">
    <div class="col-xs-12">
      Gentlemen:<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please furnish this Office the following articles subject to the terms and conditions contained herein:
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 topped-border">
      <div class="col-xs-12">&nbsp;</div>
      <div class="col-xs-3">Place of Delivery</div>
      <div class="col-xs-9">:<?php echo e($purchase_order->place_of_delivery); ?></div><br>
      <div class="col-xs-3">Date of Delivery</div>
      <div class="col-xs-9">:<?php echo e($purchase_order->date_of_delivery); ?></div>
      <div class="col-xs-12">&nbsp;</div>
    </div>
    <div class="col-xs-6 topped-border">
      <div class="col-xs-12">&nbsp;</div>
     <div class="col-xs-3">Delivery Term</div>
      <div class="col-xs-9">:<?php echo e($purchase_order->delivery_term); ?></div><br>
      <div class="col-xs-3">Payment Term</div>
      <div class="col-xs-9">:<?php echo e($purchase_order->payment_term); ?></div>
      <div class="col-xs-12">&nbsp;</div>
    </div>
  </div>

  <!-- content -->
  <div class="row">
    <table class="table table-condensed table-bordered content">
      <thead>
        <tr>
          <th class="col-xs-1">STOCK NO.</th>
          <th class="col-xs-1">UNIT</th>
          <th class="col-xs-5">DESCRIPTION</th>
          <th class="col-xs-1">QTY</th>
          <th class="col-xs-2">UNIT COST</th>
          <th class="col-xs-3">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $dos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key01=>$items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($key01+1); ?></td>
          <td>
            <?php if($pr->supplier_type == "Government Agency"): ?>
              <?php echo e($items->pr_unit); ?>

            <?php else: ?>
              <?php echo e($items->unit); ?>

            <?php endif; ?>
            </td>
          <td style="text-align: left;">
            <?php if($pr->supplier_type == "Government Agency"): ?>
              &nbsp;<?php echo e($items->pr_description); ?>

            <?php else: ?>
              &nbsp;<?php echo e($items->particulars); ?>

            <?php endif; ?>
          </td>
          <td>
            <?php if($pr->supplier_type == "Government Agency"): ?>
              &nbsp;<?php echo e($items->pr_qty); ?>

            <?php else: ?>
              &nbsp;<?php echo e($items->qty); ?>

            <?php endif; ?>
          </td>
          <td style="text-align: right;"><?php echo e(number_format($items->unit_price,2)); ?></td>
          <td style="text-align: right;"><?php echo e(number_format($items->total_price,2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($dos->count() < 15): ?>
          <?php for($i=$dos->count();$i < 15;$i++): ?>
          <tr>
            <?php for($j = 0; $j < 6; $j++): ?>
            <td>&nbsp;</td>
            <?php endfor; ?>
          </tr>
          <?php endfor; ?>
        <?php endif; ?>
      </tbody>
      <tfoot>
        <th colspan="2" style="background: #262626; color:#fff;">Total Amount in Words</th>
        <th colspan="2" style="text-align: left;"><?php echo e(strtoUpper($f->format($grand_total))); ?></th>
        <th style="text-align: right;">GRAND TOTAL</th>
        <th style="text-align: right;">&#8369; <?php echo e(number_format($grand_total,2)); ?></th>
      </tfoot>
    </table>
  </div>
  <!-- footer -->
  <div class="row" style="border:1px solid #262626; font-size: 16px; margin-top: -20px;">
    <div class="col-xs-12 ">
      <br>
      <div class="col-xs-12">In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day shall be imposed.</div><br><br>
    </div>
    <div class="col-xs-7 text-center">
      <div class="col-xs-8">
        &nbsp;<hr>Signature Over Printed<br>Name of Supplier
      </div>
      <div class="col-xs-4">
        &nbsp;<hr>Date
      </div>
    </div>
    <div class="col-xs-5">
      <div class="col-xs-12 text-center">
        &nbsp;<hr><?php echo e(strtoUpper($approval->name)); ?><br><?php echo e($approval->position); ?>

      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<span style="page-break-after:avoid;"></span>

<!-- scripts -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<!-- end scripts -->
</body>
</html>