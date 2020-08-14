<?php
$text = 'a=1&b=8&c=5';
$textarr = explode("&", $text);
// $aarr= explode("=", $textarr[0]);
// echo $a = $aarr[1];

// $barr= explode("=", $textarr[1]);
// echo $b = $barr[1];

// $carr= explode("=", $textarr[2]);
// echo $c = $carr[1];



foreach ($textarr as $textt){
$var = explode("=", $textt);
echo $var[1];
}

?>