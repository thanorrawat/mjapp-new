<?php  
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();


$pdftitle = "ใบเสนอราคา เลขที่ ";
$mpdf->SetTitle($pdftitle);
$pdffile =$pdftitle.".pdf";
//$html = '<bookmark content="Start of the Document" /><div>Section 1 text</div>';
ob_start();
$urlquo ="https://mjfapp.com/order_view/q4JskK2dStGWPBwvbpjAuoUKRv5lPv2GKEGULDjvYntDaTmievlSKBiM1Q5MnwQ9nl4rho";

 $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
echo $output = file_get_contents($urlquo, false, stream_context_create($arrContextOptions));
$html = ob_get_contents();
$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output($pdffile, 'I');


