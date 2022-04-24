<?php
    require_once("../common/DB.php");
    require_once("../common/common.php");
    require_once("../common/template.php");
    $myPageLinkOrSuggestLogin=null;
    $pro_code = $_GET['procode'];
    $DB = new DB();
    $nextURl=null;
    $hiddenInputValue=null;
    $html=null;

    session_start();
    session_regenerate_id(true);

    $myPageLinkOrSuggestLogin=checkLoginSession();

    try {
        //データベースからデータを取って来る
        $DB->connectDB();
        $sql = "select * from mst_product where code={$pro_code}";
        $DB->actSql($sql,null);
        //切断
        $DB->disconnectDB();
    } catch (Exception $e) {
        echo $e;
        echo 'ただいま障害によりご迷惑をおかけしています｡';
        exit();
    }

    function setDetail()
    {
        $rec = $GLOBALS['DB']->getResult();
        $pro_name  = $rec['name'];
        $pro_price = $rec['price'];
        $pro_img_name= $rec['img'];

        if ($pro_img_name == '') {$disp_img ="<img src='https://placehold.jp/150x150.png'>";}
        else {$disp_img = "<img src=../img/yasai/{$pro_img_name} >";}
        // $GLOBALS['nextURl'] ="location.href='shop_cartin.php?procode={$GLOBALS['pro_code']}&img={$pro_img_name}'";

        $GLOBALS['hiddenInputValue']=<<<EOM
        <input type="hidden" name="procode" value="{$pro_name}">
        <input type="hidden" name="img" value="{$pro_img_name}">
        EOM;


        $GLOBALS['html']=<<<EOM
        <p class="name">{$pro_name}</p>
        <p class="price">価格(税抜き):{$pro_price}円</p>
        $disp_img
        EOM;
    }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../scss/shop_css/shop_product.css">
    <?php oftenUseHeadInf();?>
</head>
<body>
    <?php headerTemp($myPageLinkOrSuggestLogin,countProduct())?>
    <?php setDetail();?>
    <h1>商品情報</h1>
    <div class="product">
        <?php echo $html?>
        <form action="./shop_cartin.php" method="post">
            <?php echo $hiddenInputValue?>
            <input type="number" name="count" min=1 max=10 value=1>
            <button type="submit">カートに入れる</button>
        </form>
        <!-- <button  type="button" onclick=<?php echo $nextURl?> class="cartIn">
        カートに入れる
        </button> -->
    </div>

    <button onclick="history.back()" class="back">戻る</button>

</body>
</html>