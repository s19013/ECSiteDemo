<?php
    session_start();
    session_regenerate_id(true); //あとでここの1文を抜いたphp文をstaff,productにすべて貼り付ける
    if (isset($_SESSION['login'])==false) {
        echo "ログインされてない <br>";
        echo "<a href=../staff_login/staff_login.php>ログイン画面へ</a>";
        exit();
    } else {
        echo "{$_SESSION['staff_name']}さんログイン中 <br>";
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

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'select * from mst_product where code=?';
            $stmt = $dbh ->prepare($sql);
            $data[] = $pro_code;
            $stmt -> execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_img_name = $rec['img'];

            $dbh = null;

            if ($pro_img_name == '') {$disp_img='';}
            else { $disp_img = "<img src=../img/yasai/{$pro_img_name}>"; }
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

        echo <<<EOM
        <p>商品削除</p>
        <p>商品コード</p>
        <p>{$pro_code}</p>
        <p>商品名</p>
        <p>{$pro_name}</p>
        $disp_img
        <form method="post" action="pro_delete_done.php">
            <input type="hidden" name="code" value="{$pro_code}" >
            <input type="hidden" name="img_name" value="{$pro_img_name}" >
            <p>この商品を削除しますか</p>
            <input type="button" onclick="history.back()" value = "戻る">
            <input type="submit" value="ok">
        </form>
        EOM;

    ?>
</body>
</html>