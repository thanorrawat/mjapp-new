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
    <title>{{ $orderdt->ordernumberfull }}</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
 
   <style>
  
  .oderview,.oderview *,.oderview table,.oderview td,.oderview th{
       /*     font-family: 'Prompt', sans-serif; */
       font-family: 'sarabun','Sarabun', sans-serif;
font-size: 12px;
line-height: 1.8
        }
  
        .oderview h3{
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
<body >
<div class="oderview">
    <div  style="width:750px;margin:auto;">
    <table style="width:100%">

        <tr>
            <td><img src="{{ asset('public/logo/mj-new.png') }}"  height="50"></td>
            <td align="center"><h3>ใบ Order สินค้า</h3></td>
            <td style="font-size: 13px;line-height: 1; text-align:right"> FM-SL-13<br>
            <span style="font-size: 10px">Rev.01</span> </td>
        </tr>
    </table>
    <br>
    <table style="width:100%">

        <tr>
    
            <td width="100"><strong>ชื่อลูกค้า</strong> </td>
            <td>{{ $orderdt->customer_name }}</td>
            <td width="100"><strong>เลขที่ Order</strong></td>
            <td width="150">{{ $orderdt->ordernumberfull }}</td>

        </tr>
        <tr>
    
   
            <td><strong>วันที่</strong></td>
            <td>{{ \Carbon\Carbon::parse($orderdt->created_at )->format('d/m/Y')}}</td>
         
          
            <td><strong>กำหนดส่ง</strong></td>
            <td>{{ \Carbon\Carbon::parse($orderdt->deliverydate )->format('d/m/Y')}}</td>
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
<th style="text-align: center">{{ __('file.Unit') }}</th>
<th style="text-align: center">หมายเหตุ</th>
    </tr>
    <tbody>
        <?php $number=1;?>
        @foreach ( $products as $product )
            
        
<tr>
<td align="center">{{ $number }}</td>
<td>{{ $product->productscode }}</td>
<td>{{ $product->name }}</td>
<td align="center">{{ $product->orderqty }}</td>
<td align="center">{{ $product->unit_name_th }} 
    @if($product->unit_name_en)
    / {{ $product->unit_name_en }}
    @endif
</td>
<td >{{ $product->remarkrow }}</td>

</tr>
<?php $number++;?>
@endforeach
@if($number<=6)
@for($i=$number;$i<=6;$i++)
<tr>
    <td align="center">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="center"></td>
    <td ></td>
    <td ></td>
    
    </tr>
@endfor
@endif
    </tbody>
</table>
 
<br>
@if(!empty($orderdt->remark))
<table  style="width:750px; margin: auto;">
    <tr><td><strong><u>หมายเหตุ</u></strong>
        <br>
        {{ $orderdt->remark }}
        
        <br></td></tr>
</table>
@endif
<br>

<table  style="width:750px; margin: auto;">

    <tr>
<td style="width: 70px"><strong>ผู้ทำรายการ</strong></td>
<td style="border-bottom: 1px dotted #000">{{ $orderdt->createby_name }}</td>
<td align="right" style="width: 80px"><strong>ผู้รับ Order</strong></td>
<td style="border-bottom: 1px dotted #000"> @if(!empty($user_sign2->sign ))
    <img src="{{ $user_sign2->sign }}"  width="180px">
        @else
        {{ $user_sign2->fullname ?? ''  }}@endif</td>

<td align="right" style="width: 80px"><strong>ผู้อนุมัติ </strong></td>
<td style="border-bottom: 1px dotted #000">
    @if(!empty($user_sign3->sign ))
<img src="{{ $user_sign3->sign }}"  width="180px">
    @else
    {{ $user_sign3->fullname ?? ''  }}</td>
@endif
</tr>
<tr><td></td>
    <td align="center"><strong>(เจ้าหน้าที่ฝ่ายขาย)					</strong></td>
    <td></td>
    <td align="center"><strong>(เจ้าหน้าที่ประสานงานขาย)				</strong></td>
    <td></td>
    
    <td align="center" style="width: 180px"><strong>(@if(!empty($user_sign3->role_id) &&$user_sign3->role_id==2)<img style="width: 12px" src="{{ asset('assets/images/checkmark.png') }}">@else<img style="width: 12px" src="{{ asset('assets/images/transparent.png') }}">@endif) GM<img style="width: 12px" src="{{ asset('assets/images/transparent.png') }}"></span>(@if(!empty($user_sign3->role_id) &&$user_sign3->role_id==7)<img style="width: 12px" src="{{ asset('assets/images/checkmark.png') }}">@else<img style="width: 12px" src="{{ asset('assets/images/transparent.png') }}">@endif) MD</strong></td>
  
    
    </tr>
</table>
</div>
</body>
</html>