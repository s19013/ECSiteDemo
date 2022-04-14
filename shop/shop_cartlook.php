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
            $cart=$_SESSION['cart'];
            $max=count($cart);
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
            for ($i=0; $i <$max ; $i++) {
                echo <<<EOM
                <p>商品名:{$pro_name[$i]}</p>
                $pro_img[$i]
                <p>価格:{$pro_price[$i]}</p>
                EOM;
            }
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    ?>
    <input type="button" onclick="history.back()" value = "戻る">
</body>
</html>