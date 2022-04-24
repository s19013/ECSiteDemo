<?php
    require_once("../common/DB.php");
    require_once("../common/common.php");
    require_once("../common/template.php");

    $DB = new DB();
    $myPageLinkOrSuggestLogin=null;
    $max=0;
    $cart=null;
    $pro_count=null;
    $html=null;
    $tableHtml=null;
    $nextButton=null;
    $sum = 0;
    $sumAll = 0;

    session_start();
    session_regenerate_id(true);
    $myPageLinkOrSuggestLogin=checkLoginSession();
    $max=countProduct();

    //cartセッションがあるかどうか確かめる
    if (isset($_SESSION['cart'])==true) {
        $cart=$_SESSION['cart'];
        $pro_count=$_SESSION['pro_count'];
        // dbからデータを取ってくる
        try {
            $DB->connectDB();
            foreach($cart as $key => $val){
                $sql = "select * from mst_product where code={$val}";
                $DB->actSql($sql,null);

                $rec = $DB->getResult();

                $pro_name[]  = $rec['name'];
                $pro_price[] = $rec['price'];
                if ($rec['img'] == '') {$pro_img[]='';}
                else {$pro_img[] = "<img src=../img/yasai/{$rec['img']}>";}
            }
            //切断
            $DB->disconnectDB();
        } catch (Exception $e) {
            echo $e;
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    }

    //$htmlの中身を決める
    if ($max !== 0) {
        $sumAll = 0;
        for ($i=0; $i <$max; $i++) {
            $sum = $pro_price[$i] * $pro_count[$i];
            $sumAll=$sum;
            $tableHtml.=<<<EOM
            <tr>
                <td>$pro_name[$i]</td>
                <td>$pro_img[$i]</td>
                <td>{$pro_price[$i]}円</td>
                <td><input type='number' name='pro_count{$i}'  min='1' max='10' step='1' value={$pro_count[$i]}></td>
                <td>{$sum}円</td>
                <td><input type='checkbox' name='delete{$i}'></td>
            </tr>
            EOM;
        }
    }
    $html=<<<EOM
    <input type='hidden' name='max' value=$max>
    <p>{$sumAll}円</p>
    <input type='submit' value='数量変更' >
    EOM;

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php oftenUseHeadInf();?>
</head>
<body>
    <?php headerTemp($myPageLinkOrSuggestLogin,countProduct()); ?>
    <form action="pro_count_change.php" method="post">
        <table border=1>
            <tr>
                <td>商品</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
            </tr>
            <?php echo $tableHtml?>
        </table>
        <?php echo $html;?>
    </form>
    <a href="shop_list.php">商品一覧へ戻る</a>
    <a href='clear_cart.php?name=true'>カートを空にする</a>
    <?php
        if (isset($_SESSION["member_login"])==true) {echo "<a href='shop_easy_check.php'>会員かんたん注文へ進む</a>";}
        else {echo "<a href='shop_form.php'>購入手続きへ</a>";}
    ?>
    
</body>
</html>
