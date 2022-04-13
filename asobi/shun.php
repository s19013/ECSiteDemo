<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $month=$_POST['month'];

        $yasai[]='';
        $yasai[]='ブロッコリー';
        $yasai[]='カリフラワー';
        $yasai[]='レタス';
        $yasai[]='みつば';
        $yasai[]='アスパラガス';
        $yasai[]='セロリ';
        $yasai[]='ナス';
        $yasai[]='ピーマン';
        $yasai[]='オクラ';
        $yasai[]='さつまいも';
        $yasai[]='大根';
        $yasai[]='ほうれん草';

        echo $month;
        echo "月は$yasai[$month]が旬です";

        ?>
</body>
</html>