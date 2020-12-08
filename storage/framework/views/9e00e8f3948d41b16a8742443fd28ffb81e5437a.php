<link rel="stylesheet" href="<?php echo e(asset('assets/css/print.css')); ?>">
<div style="   width: 210mm;margin:auto;font-size:10pt;line-height:1.3">




<table style="width: 100%">
<tr>
    <td style="font-size: 16pt">
    บริษัท เอ็มเจ สมาร์ทเทรด จำกัด
    </td>
   <td></td>

</tr>
<tr>
    <td>
เลขที่ 85/13 หมู่ที่ 2 ต.พันท้ายนรสิงห์ อ.เมืองสมุทรสาคร จ.สมุทรสาคร 74000<br>
Tel.08-1897-8959,034-440957-8 Fax.034-440916
    </td>
    <td style="font-size: 16pt;text-align:center">
ใบสั่งซื้อ (PO)
    </td>
</tr>
<tr>

    <td>
        เลขประจำตัวผู้เสียภาษี 0905551000569     	&nbsp;	&nbsp;	&nbsp;	&nbsp;สำนักงานใหญ่
    </td>
    <td></td>
</tr>
<tr>

    <td>
&nbsp;
    </td>
    <td></td>
</tr>
<tr>
    <td>
<table>
    <tr>
        <td style="width: 100px">ผู้จำหน่าย</td>
        <td><?php echo e($podt->supplier_code ?? ''); ?></td>
    </tr>
    <tr>
        <td colspan="2" ><?php echo e($podt->supplier_name ?? ''); ?><br><?php echo e($podt->supplier_address ?? ''); ?></td>
    </tr>
    <tr>
        <td  >โทร .</td>
        <td><?php echo e($podt->supplier_phone ?? ''); ?></td>
    </tr>
    <tr>
        <td  >หมายเหตุ</td>
        <td><?php echo e($podt->poremark ?? ''); ?></td>
    </tr>
</table>
    </td>
    <td>
        <table>
            <tr>
                <td style="width: 100px">เลขที่ใบสั่งซื้อ</td>
                <td><?php echo e($ponumber ??''); ?></td>
            </tr>
                      <tr>
                <td  >วันที่</td>
                
                <td>
                    <?php if(!empty(($podt->po_date))): ?>
                    <?php $yearthai =  \Carbon\Carbon::parse($podt->po_date)->format('Y')+543; ?><?php echo e((\Carbon\Carbon::parse($podt->po_date)->format('d/m/')).$yearthai ?? ''); ?>

                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td  >วันที่รับของ</td>
                <td>  <?php if(!empty(($podt->recieve_date))): ?>
                    <?php $yearthai =  \Carbon\Carbon::parse($podt->recieve_date)->format('Y')+543; ?><?php echo e((\Carbon\Carbon::parse($podt->recieve_date)->format('d/m/')).$yearthai ?? ''); ?>

                    <?php endif; ?></td>
            </tr>
            <tr>
                <td>เครดิต</td>
                <td><?php echo e($podt->supplier_credit??''); ?></td>
            </tr>
            <tr>
                <td>ขนส่งโดย</td>
                <td><?php if($podt->shipby): ?>
                    <?php echo e(__('file.'.$podt->shipby) ?? ''); ?>

                <?php endif; ?></td>
            </tr>
        </table>
    </td>
</tr>

</table>


<table class="po-table" style="width: 100%;border:1px solid #000; margin-top:5pt">

    <tr>
        <td class="po-border-right po-text-center po-border-bottom">No.</td>
        <td class="po-border-right po-text-center po-border-bottom">รหัสสินค้า/รายละเอียด</td>
        <td class="po-border-right po-text-center po-border-bottom">จำนวน</td>
        <td class="po-border-right po-text-center po-border-bottom">หน่วยละ</td>
        <td class="po-text-center po-border-bottom">จำนวนเงิน</td>
    </tr>
<?php $__currentLoopData = $poitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    

<?php if($key==24): ?>
<?php 
$clss1="po-border-right po-border-bottom ";
$clss11="po-border-right po-border-bottom po-text-center ";
$clss12="po-border-right po-text-right ";

$clss2="po-border-bottom po-text-right";
 ?>
<?php else: ?>
<?php 
$clss1="po-border-right";
$clss11="po-border-right po-text-center ";
$clss12="po-border-right po-text-right ";

$clss2="po-text-right";
 ?>
<?php endif; ?>
<tr>
    <?php $items_qty=0;$items_price=0;$items_amount=0;?>
    <td class="<?php echo e($clss11); ?>"><?php echo e($key+1); ?></td>
    <td class="<?php echo e($clss1); ?>"><?php echo e($item->poitems_productscode ?? ''); ?> <?php echo e($item->poitems_productsname ?? ''); ?></td>
    <td class="<?php echo e($clss12); ?>"><?php if(!empty($item->poitems_qty)): ?><?php echo e(number_format($item->poitems_qty,1)); ?><?php $items_qty=$item->poitems_qty;?><?php endif; ?><?php echo e($item->poitems_unit??''); ?></td>

    <td class="<?php echo e($clss12); ?>"><?php if(!empty($item->poitems_price)): ?><?php echo e(number_format($item->poitems_price,2)); ?><?php $items_price= $item->poitems_price;?><?php endif; ?></td>
    <td class="<?php echo e($clss2); ?>"><?php $items_amount=$items_qty*$items_price;?><?php if(!empty($items_amount)): ?><?php echo e(number_format($items_amount,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
</tr>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($key<25): ?>
<?php for($i = $key; $i < 25; $i++): ?>
    

<?php if($i==24): ?>
<?php 
$clss1="po-border-right po-border-bottom";
$clss2="po-border-bottom";
 ?>
<?php else: ?>
<?php 
$clss1="po-border-right";
$clss2="";
 ?>
<?php endif; ?>
<tr>
    <td class="<?php echo e($clss1); ?>">&nbsp;</td>
    <td class="<?php echo e($clss1); ?>"></td>
    <td class="<?php echo e($clss1); ?>"></td>

    <td class="<?php echo e($clss1); ?>"></td>
    <td class="<?php echo e($clss2); ?>"></td>
</tr>


<?php endfor; ?>
<?php endif; ?>

    <tr>
        <td colspan="2" class="">
หมายเหตุ

        </td>

        <td colspan="2" class="po-border-right">รวมเป็นเงิน</td>

        <td class="po-text-right"><?php if(!empty($podt->po_total)): ?><?php echo e(number_format($podt->po_total,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
    </tr>
    <tr>
        <td rowspan="3" colspan="2"  class="">


        </td>

        <td colspan="2" class="po-border-right">หักส่วนลด</td>

        <td class="po-text-right"><?php if(!empty($podt->po_discount)): ?><?php echo e(number_format($podt->po_discount,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
    </tr>
    <tr>

        <td colspan="2" class="po-border-right">จำนวนเงินหลังหักส่วนลด</td>

        <td class="po-text-right"><?php if(!empty($podt->po_afterdiscount)): ?><?php echo e(number_format($podt->po_afterdiscount,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
    </tr>

    <tr>

        <td colspan="2" class="po-border-right">จำนวนภาษีมูลค่าเพิ่ม &nbsp;	&nbsp;	&nbsp;<?php if(!empty($podt->po_vat)): ?> 7.00% <?php else: ?> 0.00% <?php endif; ?> </td>
        <td class="po-text-right"><?php if(!empty($podt->po_vat)): ?><?php echo e(number_format($podt->po_vat,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="po-border-bottom">
(--).

        </td>

        <td colspan="2" class="po-border-right po-text-center po-border-bottom">จำนวนเงินรวมทั้งสิ้น</td>

        <td class="po-text-right po-border-bottom"><?php if(!empty($podt->po_grand_total)): ?><?php echo e(number_format($podt->po_grand_total,2)); ?><?php else: ?> 0.00 <?php endif; ?></td>
    </tr>
    <tr>
        <td colspan="5">

            <table style="width: 100%">
                <tr>
                    <td colspan="3" style="line-height: 1.4">
กรุณาแนบใบสั่งซื้อมาวางบิลและเซ็นต์รับทราบการสั่งซื้อทุกครั้งเพื่อประโยชน์ของท่าน<br>
บริษัทฯ รับวางบิล,จ่ายเช็ค ทุกวันที่ 10 ของเดือน (13.00 น. -16.00 น.)
                    </td>
                </tr>

                <tr>

                    <td style="width: 220px" class="po-text-center">
                   <br>
                    ________________________________________<br><br>
                    ผู้สั่งซื้อ
                    </td>
                    <td style="width: 200px"></td>
                    <td class="po-text-center">
                        <br>
                        ________________________________________<br><br>
                        ผู้อนุมัติ
                </tr>
            </table>
        </td>
    </tr>
</table>


</div>