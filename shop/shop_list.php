<?php
    require_once("../common/DB.php");
    require_once("../common/common.php");
    require_once("../common/template.php");

    $myPageLinkOrSuggestLogin=null;
    $DB = new DB();

    session_start();
    session_regenerate_id(true);
    $myPageLinkOrSuggestLogin=checkLoginSession();

    try {
        //データベースからデータを取って来る
        $DB->connectDB();
        $sql = 'SELECT * FROM mst_product WHERE 1';
        $DB->actSql($sql,null);
        //切断
        $DB->disconnectDB();
    } catch (Exception $e) {
        echo $e;
        echo 'ただいま障害によりご迷惑をおかけしています｡';
        exit();
    }

    function showProduct(){
        while (true) {
            $rec = $GLOBALS['DB']->getResult(); //こうしないと関数の外の変数を使えないらしい
            if ($rec == false) {break;}
            $pro_img_name= $rec['img'];
            echo <<< EOM
            <div class="product" onclick=location.href='shop_product.php?procode={$rec['code']}'>
                <p>{$rec['name']}</p>
                <img src=../img/yasai/{$pro_img_name}>
                <p>{$rec['price']}円</p>
            </div>
            EOM;
        }
    }
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <link rel="stylesheet" href="../scss/shop_css/shop_list.css">
    <?php oftenUseHeadInf();?>
</head>
<body>
    <?php headerTemp($myPageLinkOrSuggestLogin,countProduct()); ?>
    <h1>商品一覧</h1>
    <div class="proList">
        <?php showProduct();?>
    </div>
</body>
</html>