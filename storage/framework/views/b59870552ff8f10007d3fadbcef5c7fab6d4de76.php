<?php date_default_timezone_set("Asia/Bangkok"); 
require_once __DIR__ . '/../../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();