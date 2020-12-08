<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
</head>
<body>
    <div id="showcodeimg"></div>
    <img src="" id="imgshow" alt="">
<div id="html-content-holder" style="background-color: #F0F0F1; color: #00cc65; width: 500px;
        padding-left: 25px; padding-top: 10px;">
<?php  $urlquo = "http://ev02.fablab-store.com/cashier-sales-report.php";
$arrContextOptions=array(
   "ssl"=>array(
       "verify_peer"=>false,
       "verify_peer_name"=>false,
   ),
);
echo $output = file_get_contents($urlquo, false, stream_context_create($arrContextOptions));
?>
    </div>
    <input id="btn-Preview-Image" type="button" value="Preview"/>
    <a id="btn-Convert-Html2Image" href="#">Download</a>
    <br/>
    <h3>Preview :</h3>
    <div id="previewImage">
    </div>


<script>
$(document).ready(function(){

	
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
 
    $("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });

	$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    $("#showcodeimg").text(imgageData)
alert(imgageData);
    // Now browser starts downloading it instead of just showing it
   /* var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
    */
	});

});

</script>
</body>
</html>
