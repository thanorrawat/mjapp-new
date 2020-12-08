<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($orderdt->ordernumberfull); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        @font-face{
 font-family:  'Prompt';
 font-style: normal;
 font-weight: normal;
 src: url("<?php echo e(asset('public/fonts/Prompt-Regular.ttf')); ?>") format('truetype');
}
        body,td,th{
            font-family: 'Prompt', sans-serif; 
font-size: 12px;
        }
        h3{
            font-size: 20px;    
        }
        .border1,.border1 th, .border1 td{
            border: 1px solid #000;
            border-collapse: collapse;
        }
        .border1 td{
            padding: 2px;
        }
        @page  {
      size: A4;
      padding: 15px;
    }
    @media  print {
      html, body {
        width: 210mm;
        height: 297mm;
        /*font-size : 16px;*/
      }
    }
</style
    </style>
</head>
<body>

    <div style="width:750px;margin:auto">
    <table style="width:100%">

        <tr>
            <td><img src="<?php echo e(asset('public/logo/mj-new.png')); ?>"  height="50"></td>
            <td align="center"><h3>ใบ Order สินค้า</h3></td>
            <td style="font-size: 13px;line-height: 1; text-align:right"> FM-SL-13<br>
            <span style="font-size: 10px">Rev.01</span> </td>
        </tr>
    </table>
    <br>
    <table style="width:100%">

        <tr>
    
            <td width="100"><strong>ชื่อลูกค้า</strong> </td>
            <td><?php echo e($orderdt->customer_name); ?></td>
            <td width="100"><strong>เลขที่ Order</strong></td>
            <td width="150"><?php echo e($orderdt->ordernumberfull); ?></td>

        </tr>
        <tr>
    
   
            <td><strong>วันที่</strong></td>
            <td><?php echo e(\Carbon\Carbon::parse($orderdt->created_at )->format('d/m/Y')); ?></td>
         
          
            <td><strong>กำหนดส่ง</strong></td>
            <td><?php echo e(\Carbon\Carbon::parse($orderdt->deliverydate )->format('d/m/Y')); ?></td>
        </tr>
  

    </table>

    

</div>
<br>
<table  class="border1" style="width:750px; margin: auto; border:1px solid #000">
    <thead>
        																							
<th  style="text-align: center">ที่</th>
<th style="text-align: center">รหัส</th>
<th style="text-align: center">รายละเอียดสินค้า</th>
<th style="text-align: center">จำนวน</th>
<th style="text-align: center">หมายเหตุ</th>
    </thead>
    <tbody>
        <?php $number=1;?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        
<tr>
<td align="center"><?php echo e($number); ?></td>
<td><?php echo e($product->productscode); ?></td>
<td><?php echo e($product->name); ?></td>
<td align="center"><?php echo e($product->orderqty); ?></td>
<td ></td>

</tr>
<?php $number++;?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($number<=6): ?>
<?php for($i=$number;$i<=6;$i++): ?>
<tr>
    <td align="center">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="center"></td>
    <td ></td>
    
    </tr>
<?php endfor; ?>
<?php endif; ?>
    </tbody>
</table>
    
<br>
<br>
<table  style="width:750px; margin: auto;">

    <tr>
<td><strong>ผู้ทำรายการ</strong></td>
<td style="border-bottom: 1px dotted #000"><?php echo e($orderdt->createby_name); ?></td>
<td align="right"><strong>ผู้รับ Order</strong></td>
<td style="border-bottom: 1px dotted #000"></td>

<td align="right"><strong>ผู้อนุมัติ </strong></td>
<td style="border-bottom: 1px dotted #000"></td>

</tr>
<tr><td></td>
    <td align="center"><strong>(เจ้าหน้าที่ฝ่ายขาย)					</strong></td>
    <td></td>
    <td align="center"><strong>(เจ้าหน้าที่ประสานงานขาย)				</strong></td>
    <td></td>
    
    <td align="center" style="width: 200px"><strong>( ) GM ( ) MD</strong></td>
  
    
    </tr>
</table>
</body>
</html>