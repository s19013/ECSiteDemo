<?php
    session_start();
    session_regenerate_id(true); //あとでここの1文を抜いたphp文をstaff,productにすべて貼り付ける
    if (isset($_SESSION['menber_login'])==false) {
        echo "<p>ようこそゲスト様</p>";
        echo "<a href=member_login.html> 会員ログイン </a><br>";
    } else {
        echo "<p>ようこそ{$_SESSION['menber_name']}様</p>";
        echo "<a href='member_logout.php'>ログアウト</a>";
    }
    
?>
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
        try {
            $pro_code = $_GET['procode'];

            if (isset($_SESSION['cart']) ==true) {$cart=$_SESSION['cart'];}
            $cart[]=$pro_code;
            $_SESSION['cart']=$cart;
            
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

    ?>
    <p>カートに追加しました</p>
    <a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>