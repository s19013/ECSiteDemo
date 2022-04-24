<?php
    require_once("../common/DB.php");
    require_once("../common/common.php");
    require_once("../common/template.php");
    $myPageLinkOrSuggestLogin=null;
    $pro_code = $_POST['procode'];
    $pro_img_name = $_POST['img'];
    $amount=$_POST['count'];
    $pro_count = null;
    $cart = null;
    $DB   = new DB();
    $html =null;

    session_start();
    session_regenerate_id(true);

    $myPageLinkOrSuggestLogin=checkLoginSession();

    //すでにセッションがある場合
    if (isset($_SESSION['cart']) ==true) {
        $cart=$_SESSION['cart'];
        $pro_count=$_SESSION['pro_count'];
        // カートの中に同じ商品があった場合
        if (in_array($pro_code,$cart)==true) {
            $html=<<<EOM
            <img src=../img/yasai/{$pro_img_name}>
            <p>その商品はすでにカートに入たので個数を増やしました</p>
            EOM;
            //商品の個数を増やす
            $index = array_search($pro_code,$cart);
            $pro_count[$index]+=$amount;
            if ($pro_count[$index]>10) {
                $pro_count[$index]=10;
            }
            //カウントのセッションだけを更新
            $_SESSION['pro_count']=$pro_count;
        } else{
            //新規追加
            $html=<<<EOM
            <img src=../img/yasai/{$pro_img_name}>
            <p>商品をカートに追加しました</p>
            EOM;
            //カートもカウントも更新する
            $cart[]=$pro_code;
            $index = array_search($pro_code,$cart);
            $pro_count[]=$amount;
            if ($pro_count[$index]>10) {
                $pro_count[$index]=10;
            }
            $_SESSION['cart']=$cart;
            $_SESSION['pro_count']=$pro_count;
        }
    }

    //セッションがない場合は新規作成する
    if ($cart == null ) {
        $html=<<<EOM
        <img src=../img/yasai/{$pro_img_name}>
        <p>商品をカートに追加しました</p>
        EOM;
        $cart[]=$pro_code;
        $index = array_search($pro_code,$cart);
        $pro_count[]=$amount;
            if ($pro_count[$index]>10) {
                $pro_count[$index]=10;
            }
        $_SESSION['cart']=$cart;
        $_SESSION['pro_count']=$pro_count;
    }

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../scss/shop_css/shop_cartin.css">
    <?php oftenUseHeadInf();?>
</head>
<body>
    <?php headerTemp($myPageLinkOrSuggestLogin,countProduct());?>
    <div class="contaner">
        <?php echo $html;?>
    </div>
    <a href='shop_list.php'>商品一覧に戻る</a>
</body>
</html>