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
            if (isset($_SESSION['cart'])==true) {
                $cart=$_SESSION['cart'];
                $pro_count=$_SESSION['pro_count'];
                $max=count($cart);
            } else { $max=0;}

            if ($max == 0) {
                echo <<<EOM
                <p>カートの中は空です</p>
                <a href="shop_list.php">商品一覧へ戻る</a>
                EOM;
                exit();
            }

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            foreach($cart as $key => $val){
                $sql = 'select * from mst_product where code=?';
                $stmt = $dbh ->prepare($sql);
                $data[0] = $val; //<-そのままだと､配列の後ろにどんどん追加する形になるからdata[0]で強制的に上書き
                $stmt -> execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $pro_name[]  = $rec['name'];
                $pro_price[] = $rec['price'];
                if ($rec['img'] == '') {$pro_img[]='';}
                else {$pro_img[] = "<img src=../img/yasai/{$rec['img']}>";}
            }

            $dbh = null;

            echo <<<EOM
            <p>カート</p>
            <form method='post' action=pro_count_change.php>
                <table border=1>
                <tr>
                    <td>商品</td>
                    <td>商品画像</td>
                    <td>価格</td>
                    <td>数量</td>
                    <td>小計</td>
                    <td>削除</td>
                </tr>
            EOM;

            $sumAll = 0;
            for ($i=0; $i <$max; $i++) {
                $sum = $pro_price[$i] * $pro_count[$i];
                $sumAll=$sum;
                echo <<<EOM
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
            echo "</table>";
            echo "<input type='hidden' name='max' value=$max>";
            echo "<p>{$sumAll}円</p>";
            echo "<br><input type='submit' value='数量変更' ><br>";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    ?>
    </form>
    <a href="shop_list.php">商品一覧へ戻る</a>
    <a href="shop_form.php">購入手続きへ</a>
    <a href='clear_cart.php?name=true'>カートを空にする</a>

</body>
</html>
