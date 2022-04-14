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

            echo "<p>カート</p>";
            echo "<form method='post' action=pro_count_change.php>";
            for ($i=0; $i <$max; $i++) {
                $sum = $pro_price[$i] * $pro_count[$i];
                echo <<<EOM
                <input type='checkbox' name='delete{$i}'>
                <p>商品名:{$pro_name[$i]}</p>
                $pro_img[$i]
                <p>価格:{$pro_price[$i]}円</p>
                <input type='number' name='pro_count{$i}'  min='0' step='1' value={$pro_count[$i]}>
                <p>合計価格:{$sum}円</p>
                EOM;
            }
            
            echo "<input type='hidden' name='max' value=$max>";
            echo "<br><input type='submit' value='数量変更' ><br>";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    ?>
    <a href="shop_list.php">商品一覧へ戻る</a>
    </form>
</body>
</html>