<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="AdminLTE-3/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="AdminLTE-3/plugins/font-awesome/css/font-awesome.min.css"> 

 
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-3/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="AdminLTE-3/dist/css/custom.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

<style>
 body, .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{
  font-family: 'Sarabun', sans-serif;
  }
</style>
</head>
<body>
  


<?php if(empty($_GET["json"])){ ?>

<div class="container">
<form method="post" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12">
        <label for="exampleInputFile">Upload File csv</label>
        <input  type="file" name="file" class="form-control" id="exampleInputFile" required>
    </div>

</div>
    
<div class="row">
<div class="col-md-3">
    <input type="radio" name="exceltype"  value="1" required>ข้อมูลการขายรายเดือน   
    </div><div class="col-md-3">
    <input type="radio" name="exceltype"  value="2" required> Stock
    </div><div class="col-md-3">

     <input type="radio" name="exceltype"  value="3" required>3 days sale

     </div><div class="col-md-3">

<input type="radio" name="exceltype"  value="4" required>delivery days 
    </div><div class="col-md-3">
    <input type="radio" name="exceltype"  value="5" required>Will Order
    </div><div class="col-md-3">
     <input type="radio" name="exceltype"  value="9" required>อื่นๆ
     </div>
     </div>
     <div class="text-center">
    <button type="submit" class="btn btn-default ">Upload</button>
    </div>
</form>
</div>

<?php
}

          require './importdata/vendor/autoload.php';



         use PhpOffice\PhpSpreadsheet\Spreadsheet;

         use PhpOffice\PhpSpreadsheet\Reader\Csv;

         use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

         $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');



          if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {


///echo $_FILES['file']['name'];


             $arr_file = explode('.', $_FILES['file']['name']);

             $extension = end($arr_file);



             if('csv' == $extension) {

                 $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

             } else if('xls' == $extension){

                 $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

             }

             else {

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            }





             $spreadsheet = $reader->load($_FILES['file']['tmp_name']);



             $sheetData = $spreadsheet->getActiveSheet()->toArray();

           //  print_r($sheetData);



           $sheetDatajson=  json_encode($sheetData);

         //  print_r($sheetDatajson);

         $jsonfile=date('Ymdhis').".json";

         $jsonfilepath = "importdata/jsondata/".$jsonfile;

           file_put_contents($jsonfilepath, $sheetDatajson);
if($_POST['exceltype'] == 1){
  echo '<script type="text/javascript">
  window.location.replace("json_import_selling?json='.$jsonfile.'");
</script>';
}elseif($_POST['exceltype'] == 2){
  echo '<script type="text/javascript">
  window.location.replace("json_import_stock?json='.$jsonfile.'");
</script>';
}elseif($_POST['exceltype'] == 3){
  echo '<script type="text/javascript">
  window.location.replace("json_import_selling3days?json='.$jsonfile.'");
</script>';
}elseif($_POST['exceltype'] == 4){
  echo '<script type="text/javascript">
  window.location.replace("json_import_deliverydays?json='.$jsonfile.'");
</script>';
}elseif($_POST['exceltype'] == 5){
  echo '<script type="text/javascript">
  window.location.replace("json_import_willorder?json='.$jsonfile.'");
</script>';
}else{
  echo '<script type="text/javascript">
  window.location.replace("?json='.$jsonfile.'");
</script>';
}
          

         //  header('Location: table.php?json='.$jsonfile);

         //  exit;

         }


         if(!empty($_GET["json"])){
          $filejson = "importdata/jsondata/".$_GET["json"];
        
        $handle = fopen($filejson, "rb");
        $result = stream_get_contents($handle);
        fclose($handle);
   $data = json_decode($result, true);

   foreach ( $data  as $dt)
   {
     if(!empty($dt[1]) && $dt[0]!="NO"){
     for($i=0;$i<count($dt);$i++){
      echo $dt[$i];
      echo "/";
     }
     echo "<br>";
    }
   }

         }
         ?>

</body>
</html>