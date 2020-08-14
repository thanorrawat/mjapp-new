<?php if(empty($orderdt) && !empty($data)){
$orderd = $data['orderdt'];
}
if(empty($products) && !empty($data)){
    $products = $data['products'];
}
if(empty($user_sign2) && !empty($data['user_sign2'])){
    $user_sign2 = $data['user_sign2'];
}
if(empty($user_sign3) && !empty($data['user_sign3'])){
    $user_sign3 = $data['user_sign3'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($orderdt->ordernumberfull); ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
 
   <style>
         <?php if(empty($_GET['include'])): ?>
        body,td,th{
       /*     font-family: 'Prompt', sans-serif; */
       font-family: 'sarabun','Sarabun', sans-serif;
font-size: 12px;
line-height: 1.8
        }
        <?php endif; ?>
        h3{
            font-size: 20px;    
        }
        .border1{
            border-collapse: collapse;  
        }
      .border1 th, .border1 td{
            border: 0.5px solid #000;
            border-collapse: collapse;
        }
        .border1 td{
            padding: 3px;
        }

</style>

</head>
<body>

    <div style="width:750px;margin:auto;">
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
    <tr>
        																							
<th  style="text-align: center">ที่</th>
<th style="text-align: center">รหัส</th>
<th style="text-align: center">รายละเอียดสินค้า</th>
<th style="text-align: center">จำนวน</th>
<th style="text-align: center">หมายเหตุ</th>
    </tr>
    <tbody>
        <?php $number=1;?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        
<tr>
<td align="center"><?php echo e($number); ?></td>
<td><?php echo e($product->productscode); ?></td>
<td><?php echo e($product->name); ?></td>
<td align="center"><?php echo e($product->orderqty); ?> </td>
<td ><?php echo e($product->remarkrow); ?></td>

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
<?php if(!empty($orderdt->remark)): ?>
<table  style="width:750px; margin: auto;">
    <tr><td><strong><u>หมายเหตุ</u></strong>
        <br>
        <?php echo e($orderdt->remark); ?>

        
        <br></td></tr>
</table>
<?php endif; ?>
<br>

<table  style="width:750px; margin: auto;">

    <tr>
<td style="width: 70px"><strong>ผู้ทำรายการ</strong></td>
<td style="border-bottom: 1px dotted #000"><?php echo e($orderdt->createby_name); ?></td>
<td align="right" style="width: 80px"><strong>ผู้รับ Order</strong></td>
<td style="border-bottom: 1px dotted #000"> <?php if(!empty($user_sign2->sign )): ?>
    <img src="<?php echo e($user_sign2->sign); ?>"  width="180px">
        <?php else: ?>
        <?php echo e($user_sign2->fullname ?? ''); ?><?php endif; ?></td>

<td align="right" style="width: 80px"><strong>ผู้อนุมัติ </strong></td>
<td style="border-bottom: 1px dotted #000">
    <?php if(!empty($user_sign3->sign )): ?>
<img src="<?php echo e($user_sign3->sign); ?>"  width="180px">
    <?php else: ?>
    <?php echo e($user_sign3->fullname ?? ''); ?></td>
<?php endif; ?>
</tr>
<tr><td></td>
    <td align="center"><strong>(เจ้าหน้าที่ฝ่ายขาย)					</strong></td>
    <td></td>
    <td align="center"><strong>(เจ้าหน้าที่ประสานงานขาย)				</strong></td>
    <td></td>
    
    <td align="center" style="width: 180px"><strong>(<?php if(!empty($user_sign3->role_id) &&$user_sign3->role_id==2): ?><img style="width: 12px" src="<?php echo e(asset('assets/images/checkmark.png')); ?>"><?php else: ?><img style="width: 12px" src="<?php echo e(asset('assets/images/transparent.png')); ?>"><?php endif; ?>) GM<img style="width: 12px" src="<?php echo e(asset('assets/images/transparent.png')); ?>"></span>(<?php if(!empty($user_sign3->role_id) &&$user_sign3->role_id==7): ?><img style="width: 12px" src="<?php echo e(asset('assets/images/checkmark.png')); ?>"><?php else: ?><img style="width: 12px" src="<?php echo e(asset('assets/images/transparent.png')); ?>"><?php endif; ?>) MD</strong></td>
  
    
    </tr>
</table>
</body>
</html>