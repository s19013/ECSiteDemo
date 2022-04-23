<?php
    require_once("../common/DB.php");
    $myPageLinkOrSuggestLogin=null;
    $DB = new DB();
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['member_login'])==false) {
        $myPageLinkOrSuggestLogin="<a href=../member/member_login.php>ログイン or 会員登録</a>";
    } else {
        $myPageLinkOrSuggestLogin="<p onclick=location.href='../member/member_page.php'>マイページ</p>";
    }

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
    <link rel="stylesheet" href="../scss/shop_css/shop_header.css">

    <!-- google webフォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- mochipopFont -->
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <p>ろくまる農園</p>
    <?php echo $myPageLinkOrSuggestLogin; ?>
    <button onclick="location.href='./shop_cartlook.php'"><?php?>カート</button>
    </header>
    <h1>商品一覧</h1>
    <div class="proList">
        <?php showProduct()?>
    </div>
    

    
</body>
</html>