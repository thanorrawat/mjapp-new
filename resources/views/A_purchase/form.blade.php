<link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
<div style="   width: 210mm;margin:auto;font-size:10pt;line-height:1.3">


{{-- ส่วนหัว --}}

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
        <td>{{ $podt->supplier_code ?? '' }}</td>
    </tr>
    <tr>
        <td colspan="2" >{{ $podt->supplier_name ?? '' }}<br>{{ $podt->supplier_address ?? '' }}</td>
    </tr>
    <tr>
        <td  >โทร .</td>
        <td>{{ $podt->supplier_phone ?? '' }}</td>
    </tr>
    <tr>
        <td  >หมายเหตุ</td>
        <td>{{ $podt->poremark ?? '' }}</td>
    </tr>
</table>
    </td>
    <td>
        <table>
            <tr>
                <td style="width: 100px">เลขที่ใบสั่งซื้อ</td>
                <td>{{ $ponumber ??'' }}</td>
            </tr>
                      <tr>
                <td  >วันที่</td>
                
                <td>
                    @if(!empty(($podt->po_date)))
                    <?php $yearthai =  \Carbon\Carbon::parse($podt->po_date)->format('Y')+543; ?>{{ (\Carbon\Carbon::parse($podt->po_date)->format('d/m/')).$yearthai ?? '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td  >วันที่รับของ</td>
                <td>  @if(!empty(($podt->recieve_date)))
                    <?php $yearthai =  \Carbon\Carbon::parse($podt->recieve_date)->format('Y')+543; ?>{{ (\Carbon\Carbon::parse($podt->recieve_date)->format('d/m/')).$yearthai ?? '' }}
                    @endif</td>
            </tr>
            <tr>
                <td>เครดิต</td>
                <td>{{ $podt->supplier_credit??'' }}</td>
            </tr>
            <tr>
                <td>ขนส่งโดย</td>
                <td>@if($podt->shipby)
                    {{ __('file.'.$podt->shipby) ?? '' }}
                @endif</td>
            </tr>
        </table>
    </td>
</tr>

</table>
{{-- ตาราง --}}

<table class="po-table" style="width: 100%;border:1px solid #000; margin-top:5pt">

    <tr>
        <td class="po-border-right po-text-center po-border-bottom">No.</td>
        <td class="po-border-right po-text-center po-border-bottom">รหัสสินค้า/รายละเอียด</td>
        <td class="po-border-right po-text-center po-border-bottom">จำนวน</td>
        <td class="po-border-right po-text-center po-border-bottom">หน่วยละ</td>
        <td class="po-text-center po-border-bottom">จำนวนเงิน</td>
    </tr>
@foreach ($poitems as $key =>$item)
    

@if($key==24)
<?php 
$clss1="po-border-right po-border-bottom ";
$clss11="po-border-right po-border-bottom po-text-center ";
$clss12="po-border-right po-text-right ";

$clss2="po-border-bottom po-text-right";
 ?>
@else
<?php 
$clss1="po-border-right";
$clss11="po-border-right po-text-center ";
$clss12="po-border-right po-text-right ";

$clss2="po-text-right";
 ?>
@endif
<tr>
    <?php $items_qty=0;$items_price=0;$items_amount=0;?>
    <td class="{{ $clss11 }}">{{ $key+1 }}</td>
    <td class="{{ $clss1 }}">{{ $item->poitems_productscode ?? '' }} {{ $item->poitems_productsname ?? '' }}</td>
    <td class="{{ $clss12 }}">@if(!empty($item->poitems_qty)){{ number_format($item->poitems_qty,1)}}<?php $items_qty=$item->poitems_qty;?>@endif{{ $item->poitems_unit??''}}</td>

    <td class="{{ $clss12 }}">@if(!empty($item->poitems_price)){{ number_format($item->poitems_price,2)}}<?php $items_price= $item->poitems_price;?>@endif</td>
    <td class="{{ $clss2 }}"><?php $items_amount=$items_qty*$items_price;?>@if(!empty($items_amount)){{ number_format($items_amount,2)}}@else 0.00 @endif</td>
</tr>


@endforeach

@if($key<25)
@for($i = $key; $i < 25; $i++)
    

@if($i==24)
<?php 
$clss1="po-border-right po-border-bottom";
$clss2="po-border-bottom";
 ?>
@else
<?php 
$clss1="po-border-right";
$clss2="";
 ?>
@endif
<tr>
    <td class="{{ $clss1 }}">&nbsp;</td>
    <td class="{{ $clss1 }}"></td>
    <td class="{{ $clss1 }}"></td>

    <td class="{{ $clss1 }}"></td>
    <td class="{{ $clss2 }}"></td>
</tr>


@endfor
@endif

    <tr>
        <td colspan="2" class="">
หมายเหตุ

        </td>

        <td colspan="2" class="po-border-right">รวมเป็นเงิน</td>

        <td class="po-text-right">@if(!empty($podt->po_total)){{ number_format($podt->po_total,2)}}@else 0.00 @endif</td>
    </tr>
    <tr>
        <td rowspan="3" colspan="2"  class="">


        </td>

        <td colspan="2" class="po-border-right">หักส่วนลด</td>

        <td class="po-text-right">@if(!empty($podt->po_discount)){{ number_format($podt->po_discount,2)}}@else 0.00 @endif</td>
    </tr>
    <tr>

        <td colspan="2" class="po-border-right">จำนวนเงินหลังหักส่วนลด</td>

        <td class="po-text-right">@if(!empty($podt->po_afterdiscount)){{ number_format($podt->po_afterdiscount,2)}}@else 0.00 @endif</td>
    </tr>

    <tr>

        <td colspan="2" class="po-border-right">จำนวนภาษีมูลค่าเพิ่ม &nbsp;	&nbsp;	&nbsp;@if(!empty($podt->po_vat)) 7.00% @else 0.00% @endif </td>
        <td class="po-text-right">@if(!empty($podt->po_vat)){{ number_format($podt->po_vat,2)}}@else 0.00 @endif</td>
    </tr>
    <tr>
        <td colspan="2" class="po-border-bottom">
(--).

        </td>

        <td colspan="2" class="po-border-right po-text-center po-border-bottom">จำนวนเงินรวมทั้งสิ้น</td>

        <td class="po-text-right po-border-bottom">@if(!empty($podt->po_grand_total)){{ number_format($podt->po_grand_total,2)}}@else 0.00 @endif</td>
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