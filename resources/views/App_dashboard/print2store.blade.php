<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>พิมพ์ Order ส่งคลัง</title>
    <style>
        html,body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
        <?php $num = 1; ?>

    @foreach ( $ordertokenlist as $tokenrow )
        <div style=" height:13.5cm">
            <?php print file_get_contents(url('order_view').'/'.$tokenrow.'?showprice=1&forwho=Admin'); ?>
        </div>

        @if($num%2 == 0 && $num < count($ordertokenlist) )
            <div style="page-break-after: always;"></div>
        @endif
        <?php $num++ ?>
    @endforeach
    <div style="page-break-after: always;"></div>

    <?php $num = 1; ?>

    @foreach ( $ordertokenlist as $tokenrow )
        <div style=" height:13.7cm">
            <?php print file_get_contents(url('order_view').'/'.$tokenrow.'?forwho=แผนกคลังสินค้า'); ?>
        </div>

        @if($num%2 == 0 && $num < count($ordertokenlist) )
            <div style="page-break-after: always;"></div>
        @endif
        <?php $num++ ?>
    @endforeach
    <script type="text/javascript">
        window.print();
        window.onfocus=function(){ window.close();}
    </script>
</body>
</html>
