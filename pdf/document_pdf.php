<?php  
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();


$pdftitle = "ใบเสนอราคา เลขที่ ";
$mpdf->SetTitle($pdftitle);
$pdffile =$pdftitle.".pdf";
$html = '<bookmark content="Start of the Document" /><div>Section 1 text</div>';


$mpdf->WriteHTML($html);

$mpdf->Output($pdffile, 'I');


