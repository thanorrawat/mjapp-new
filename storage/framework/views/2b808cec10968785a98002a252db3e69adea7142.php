<?php   $urlquo ="https://mjfapp.com/order_view/Krszps13m2mO6HwTTXI3FPIXtJfDE93vHqQTGyKnvGSb600M71NNNP2OvP2kDjtd50CL7R";
//exit();
// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$context = stream_context_create($opts);
//exit();
// Open the file using the HTTP headers set above
$output = file_get_contents($urlquo, false, $context); //อ่านหน้าเว็บ
$output   = preg_replace('/\\\\/','', $output); //Strip backslashes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OD20060006</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body,td,th,*{
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
    </style>
</head>
<body>

    <div style="width:750px;margin:auto">
    <table style="width:100%">

        <tr>
            <td><img src="https://mjfapp.com/public/logo/mj-new.png"  height="50"></td>
            <td align="center"><h3>ใบ Order สินค้า</h3></td>
            <td style="font-size: 13px;line-height: 1; text-align:right"> FM-SL-13<br>
            <span style="font-size: 10px">Rev.01</span> </td>
        </tr>
    </table>
    <br>
    <table style="width:100%">

        <tr>
    
            <td width="100"><strong>ชื่อลูกค้า</strong> </td>
            <td>ตัวอย่างลูกค้า 2</td>
            <td width="100"><strong>เลขที่ Order</strong></td>
            <td width="150">OD20060006</td>

        </tr>
        <tr>
    
   
            <td><strong>วันที่</strong></td>
            <td>22/06/2020</td>
         
          
            <td><strong>กำหนดส่ง</strong></td>
            <td>12/06/2020</td>
        </tr>
  

    </table>

    

</div>
<br>
<table  class="border1" style="width:750px; margin: auto; border:1px solid #000">
    <thead>
        																							
<th>ที่</th>
<th>รหัส</th>
<th>รายละเอียดสินค้า</th>
<th>จำนวน</th>
<th>หมายเหตุ</th>
    </thead>
    <tbody>
                            
        
<tr>
<td align="center">1</td>
<td>0-CPPB-W1111-1</td>
<td>0-CPPB-W1111-1</td>
<td align="center">1</td>
<td ></td>

</tr>
            
        
<tr>
<td align="center">2</td>
<td>0-CP-H302-4</td>
<td>0-CP-H302-4</td>
<td align="center">1</td>
<td ></td>

</tr>
            
        
<tr>
<td align="center">3</td>
<td>0-CP-8244</td>
<td>0-CP-8244</td>
<td align="center">1</td>
<td ></td>

</tr>
            
        
<tr>
<td align="center">4</td>
<td>0-CP-170-3</td>
<td>0-CP-170-3</td>
<td align="center">1</td>
<td ></td>

</tr>
            
        
<tr>
<td align="center">5</td>
<td>0-BK-006 ไม่ใช้</td>
<td>0-BK-006 ไม่ใช้</td>
<td align="center">1</td>
<td ></td>

</tr>
            
        
<tr>
<td align="center">6</td>
<td>0-BK-082 ไม่ใช้</td>
<td>0-BK-082 ไม่ใช้</td>
<td align="center">1</td>
<td ></td>

</tr>
    </tbody>
</table>
    
<br>
<br>
<table  style="width:750px; margin: auto;">

    <tr>
<td><strong>ผู้ทำรายการ</strong></td>
<td style="border-bottom: 1px dotted #000">Best</td>
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