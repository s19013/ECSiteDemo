<?php
    session_start();
    session_regenerate_id(true); //あとでここの1文を抜いたphp文をstaff,productにすべて貼り付ける
    if (isset($_SESSION['menber_login'])==false) {
        echo "<p>ようこそゲスト様</p>";
        echo "<a href=../member/member_login.php> 会員ログイン </a><br>";
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
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT * FROM mst_product WHERE 1';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $dbh = null;

            echo "<p>商品一覧</p>";
            while (true) {
                $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {break;}
                echo <<< EOM
                <a href=shop_product.php?procode={$rec['code']}>
                {$rec['name']}:{$rec['price']}円
                </a><br/>
                EOM;
            }
            echo "<a href='shop_cartlook.php'>カートを見る</a>";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

    ?>
    <!-- <a href="../staff_login/staff_top.php">トップメニューへ</a><br> -->

</body>
</html>